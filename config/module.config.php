<?php

use DoctrineModule\Service as CommonService;
use DoctrineMongoODMModule\Service as ODMService;

return array(
    'doctrine' => array(
        'driver' => array(
            'ic_base' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',                
                'paths' => array(
                    __DIR__ . '/../src/IcBase/Entity'
                ),
                'drivers' => array(
                    'IcBase\Entity'    => 'ic_base'
                )
            )
        ),            	
	),
    'view_helpers'  => array(
      'invokables'  => array(
            'twbHorizontalForm'             => 'IcBase\View\Helper\HorizontalForm'
        )
    ),    
);