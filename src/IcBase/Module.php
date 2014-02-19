<?php

namespace IcBase;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputOption;
use Zend\EventManager\EventInterface;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getTarget();
        $sharedManager = $app->getEventManager()->getSharedManager();
        // Attach to helper set event and load the document manager helper.
        $sharedManager->attach('doctrine', 'loadCli.post', array($this, 'loadCli')); 


        $odmEntityManager = $e->getApplication()->getServiceManager()->get('doctrine.documentmanager.odm_default');
        $odmEntityManager->getEventManager()
            ->addEventListener(array(
                \Doctrine\ODM\MongoDB\Events::prePersist,
                \Doctrine\ODM\MongoDB\Events::preUpdate,
            ), new \IcBase\Entity\Event\Timestamp() );

    }

    public function loadCli(EventInterface $event)
    {
        $cli = $event->getTarget();

        $commands = $cli->all();

        foreach ($commands as $command) {
            $command->getDefinition()->addOption(
                new InputOption(
                    'documentmanager', null, InputOption::VALUE_OPTIONAL,
                    'The name of the documentmanager to use. If none is provided, it will use odm_default.'
                )
            );
        }

        $arguments = new ArgvInput();
        $documentManagerName = $arguments->getParameterOption('--documentmanager');
        $documentManagerName = !empty($documentManagerName) ? $documentManagerName : 'odm_default';

        $documentManager = $event->getParam('ServiceManager')->get('doctrine.documentmanager.' . $documentManagerName);
        $documentHelper  = new \Doctrine\ODM\MongoDB\Tools\Console\Helper\DocumentManagerHelper($documentManager);
        $cli->getHelperSet()->set($documentHelper, 'dm');
    }


    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ ,
                ),
            ),
        );
    }	
}
