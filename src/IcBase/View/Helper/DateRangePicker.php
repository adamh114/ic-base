<?php

namespace IcBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\RendererInterface as Renderer;

class DateRangePicker extends AbstractHelper implements ServiceLocatorAwareInterface
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
	
	public function __invoke($elementPrefix = 'ic-base-')
	{
		$elementName = $elementPrefix . 'datePicker';
		$viewModel = new ViewModel();
        $viewModel->setVariables(array(
        	'elementName'		=> $elementName
    	));
        $viewModel->setTemplate( 'ic-base/daterange-picker');

        return $this->getView()->render($viewModel);
	}
}