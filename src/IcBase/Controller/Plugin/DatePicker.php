<?php

namespace IcBase\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class DatePicker extends AbstractPlugin
{
	public function __construct()
	{

	}

	public function __invoke()
	{
		return $this;
	}

	public function getDate($elementName='datePicker')
	{
		$posted = $this->getController()->params()->fromPost($elementName);
        if( null === ( $value = $this->getController()->params()->fromQuery($elementName, $posted) ) ) {
        	$date = new \DateTime('now');
        } else {
        	$date = new \DateTime($elementName);
        }

        return $date;
	}

	public function getRange($elementName='datePicker')
	{
		$posted = $this->getController()->params()->fromPost($elementName);		
        if( null === ( $value = $this->getController()->params()->fromQuery($elementName, $posted) ) ) {
			$startDate = new \DateTime('now');
            $startDate->sub(new \DateInterval('P1D'));
			$endDate = new \DateTime('now');
            return array ('start' => $startDate, 'end' => $endDate);
        } else {
        	$arr = explode('-', $value);
        	$startDate = (isset($arr[0])) ? new \DateTime(trim($arr[0])) : new \DateTime();
        	$endDate = (isset($arr[1])) ? new \DateTime(trim($arr[1])) : new \DateTime();
            return array ('start' => $startDate, 'end' => $endDate);
        }
	}
}