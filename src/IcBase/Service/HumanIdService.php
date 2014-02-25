<?php

namespace IcBase\Service;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class HumanIdService implements ServiceLocatorAwareInterface
{
	use ServiceLocatorAwareTrait;

	const SEQUENCE_START = 10000;
	const COUNTER_REPOSITORY = '\IcBase\Entity\HumanIdCounter';

	public function getNextId($repositoryName, $documentManangerKey='doctrine.documentmanager.odm_default')
	{
		$documentManager = $this->getServiceLocator()->get($documentManangerKey);

		$counter = $documentManager->createQueryBuilder(self::COUNTER_REPOSITORY)
					->findAndUpdate()
					->returnNew()
					->field('entity')->equals($repositoryName)							
					->field('sequence')->inc(1)
					->getQuery()
					->execute();

		if( $counter === null ) {
			$counter = $documentManager->createQueryBuilder(self::COUNTER_REPOSITORY)
						->insert()
						->returnNew()
						->field('entity')->set($repositoryName)								
						->field('sequence')->set(self::SEQUENCE_START)
						->getQuery()
						->execute();
			return self::SEQUENCE_START;
		} else {
			return $counter->getSequence();
		}
	}	
}