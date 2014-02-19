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
		$offsetCalcArr = explode('-', $labelColumn);
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

		$elementStr = implode('-', $elementArr);

		$offsetArr[count($offsetCalcArr)-1] = 'offset';
		$offsetArr[count($offsetCalcArr)] = $offsetCalcArr[count($offsetCalcArr)-1];
		$offsetStr = implode('-', $offsetArr);

		foreach($form as $element) {
			$options = $element->getOptions();

			if(in_array($element->getAttribute('type'), array('checkbox', 'submit' ))) {
				$options['column-size'] = $elementStr . ' ' . $offsetStr;	
			} else {

				if(!in_array($element->getAttribute('type'), array('radio' ))) {

					$options['label_attributes'] = array( 'class' => $labelColumn);
					$options['column-size'] = $elementStr;	
					//$options['inline'] = true;
					
				} else {
					$options['label_attributes'] = array( 'class' => $labelColumn);
					$options['column-size'] = $elementStr;

					//dd($element);
					//$options['column-size'] = $elementStr;						
				}
			}

			$element->setOptions($options);

		}

	}
}