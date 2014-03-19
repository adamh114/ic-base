<?php

namespace IcBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Renderer\RendererInterface as Renderer;

class HorizontalForm extends AbstractHelper implements ServiceLocatorAwareInterface
{
	use ServiceLocatorAwareTrait;

	protected $view;

	protected $elementStr = '';
	protected $options;
	protected $labelColumn;
	protected $offsetStr;

    public function setView( Renderer $view)
    {
        $this->view = $view;
    }

    public function getView( )
    {
        return $this->view;
    }

	public function __invoke($form, $labelColumn)
	{
		$this->labelColumn = $labelColumn;
		$offsetCalcArr = explode('-', $this->labelColumn);
		$offsetSpace = 12 - $offsetCalcArr[count($offsetCalcArr)-1];

		$offsetArr = array();
		$elementArr = array();

		foreach($offsetCalcArr as $key => $val) {
			$offsetArr[$key] = $val;
		}

		foreach($offsetCalcArr as $key => $val) {
			$elementArr[$key] = $val;
		}

		$elementArr[count($elementArr)-1] = $offsetSpace;
		if($elementArr[0] == 'col') {
			unset($elementArr[0]);
		}

		$this->elementStr = implode('-', $elementArr);

		$offsetArr[count($offsetCalcArr)-1] = 'offset';
		$offsetArr[count($offsetCalcArr)] = $offsetCalcArr[count($offsetCalcArr)-1];
		$this->offsetStr = implode('-', $offsetArr);

		foreach($form as $element) {
			$this->setElementColumns($element);
		}
	}

	public function setElementColumns($element) 
	{
		if(($element instanceof \Zend\Form\Fieldset) || ($element instanceof \Zend\Form\Element\Collection)) {
			
			foreach($element as $multi) {
				$this->setElementColumns($multi);
			}

			if($element instanceof \Zend\Form\Element\Collection) {
                $templateElement = $element->getTemplateElement();
                foreach($templateElement as $innerElement) {
					$this->setElementColumns($innerElement);
                }
			}

		} else {

			$options = $element->getOptions();

			if(in_array($element->getAttribute('type'), array( 'checkbox', 'submit' ))) {
				$options['column-size'] = $this->elementStr . ' ' . $this->offsetStr;	
			} else {

				if(!in_array($element->getAttribute('type'), array('radio', 'multi_checkbox' ))) {

					$options['label_attributes'] = array( 'class' => $this->labelColumn);
					$options['column-size'] = $this->elementStr;	
					//$options['inline'] = true;
					
				} else if( $element->getAttribute('type') == 'radio' ) {
					$options['column-size'] = $this->elementStr;						
				} else {
					$options['label_attributes'] = array( 'class' => $this->labelColumn);
					$options['column-size'] = $this->elementStr;
				}
			}

			$options['twb-layout'] = 'horizontal';
			$element->setOptions($options);
		}
	}

}