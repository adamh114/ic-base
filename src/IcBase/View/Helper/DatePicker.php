<?php

namespace IcBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\RendererInterface as Renderer;

class DatePicker extends \Zend\Form\View\Helper\AbstractHelper implements ServiceLocatorAwareInterface
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

	public function __invoke($type = 'date', $element = 'datePicker')
	{
		$elementName = $element;

		if ( $type == 'date') {
			$value = $this->getDatePickerPlugin()->getDate($elementName);
		    $value = $value->format('m/d/Y');
		} else {
			$value = $this->getDatePickerPlugin()->getRange($elementName);	
			$value = $value['start']->format('m/d/Y') . ' - ' . $value['end']->format('m/d/Y');
		}

		$viewModel = new ViewModel(array(
			'type'				=> $type,
        	'elementName'		=> $elementName,
        	'value'				=> $value
    	));

        $viewModel->setTemplate( 'ic-base/date-picker');
        return $this->getView()->render($viewModel);
	}

	public function render()
	{

	}

    public function getDatePickerPlugin()
    {
        $controllerPluginManager = $this->getServiceLocator()->getServiceLocator()->get('ControllerPluginManager');
        return $controllerPluginManager->get('icBaseDatePicker');
    }


}