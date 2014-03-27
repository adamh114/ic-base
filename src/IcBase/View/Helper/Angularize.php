<?php

namespace IcBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\Form\FormInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\RendererInterface as Renderer;

class Angularize extends AbstractHelper implements ServiceLocatorAwareInterface
{
	use ServiceLocatorAwareTrait;

	protected $view;

	/**
	 * Getter for view
	 *
	 * @return mixed
	 */
	public function getView()
	{
	    return $this->view;
	}
	
	/**
	 * Setter for view
	 *
	 * @param mixed $view Value to set
	 *
	 * @return self
	 */
	public function setView(Renderer $view)
	{
	    $this->view = $view;
	    return $this;
	}
	
	public function __invoke(FormInterface $form, $scope=null)
	{
        if ($scope !== null) {
            $scope = $scope . '.';
        }

        foreach ($form as $oElement) {
            if ($oElement instanceof \Zend\Form\FieldsetInterface) {
                // do nothing
            } else {
                $sType = $oElement->getAttribute('type');
                //echo $sType;die;
                if (in_array($sType,array('multicheckbox','radio'))) {
                    $oElement->setAttribute('data-ng-model', $scope . $oElement->getAttribute('name'));
                } elseif (in_array($sType,array('text','password'))) {
                    $oElement->setAttribute('data-ng-model', $scope . $oElement->getAttribute('name'));
                } elseif (in_array($sType,array('select'))) {
                    $oElement->setAttribute('data-ng-model', $scope . $oElement->getAttribute('name'));
                } elseif (in_array($sType,array('submit','button'))) {
                    // do nothing
                }
            }
        }
	}
}