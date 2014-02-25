<?php

namespace IcBase\Service;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

abstract class AbstractService implements ServiceLocatorAwareInterface
{
	use ServiceLocatorAwareTrait;

	protected $errorMessage;

	abstract public function getRepositoryName();

	public function getNextHumanIdSequence()
	{ 
		return $this->getServiceLocator()->get('IcBase\Service\HumanIdService')->getNextId($this->getRepositoryName());
	}

	public function getDocumentManager()
	{
		return $this->getServiceLocator()->get('ic_billing_dm');
	}

	public function find($id)
	{
		return $this->getDocumentManager()
			->getRepository($this->getRepositoryName())->find($id);
	}


	public function findAll()
	{
		return $this->getDocumentManager()
			->getRepository($this->getRepositoryName())
			->createQueryBuilder()
			->sort('createdAt', 'desc')
			->getQuery()
			->execute();
	}

	public function add(\Zend\Stdlib\Parameters $params)
	{
		$className = $this->getRepositoryName();
		$entity = new $className();
		$this->hydrate($entity, $params);

		$entity->setHumanId($this->getNextHumanIdSequence());

		$documentManager = $this->getDocumentManager();
		$documentManager->persist($entity);
		$documentManager->flush();

		return $entity;
	}

	public function edit($id, \Zend\Stdlib\Parameters $params)
	{
		$documentManager = $this->getDocumentManager();
		$entity = $documentManager->getRepository($this->getRepositoryName())->find($id);
		$this->hydrate($entity, $params);
		$documentManager->persist($entity);
		$documentManager->flush();		

		return $entity;		
	}
	
	public function hardDelete($id)
	{
		if(!is_array($id)) {
			$id = array($id);
		}

		foreach($id as $deleteId) {
			$entity = $this->getDocumentManager()->getRepository($this->getRepositoryName())->find($deleteId);
			$this->getDocumentManager()->remove($entity);
		}

		$this->getDocumentManager()->flush();		
	}

	public function softDelete($id)
	{
		if(!is_array($id)) {
			$id = array($id);
		}

		foreach($id as $deleteId) {
			if(method_exists($this->getRepositoryName(), 'setIsDeleted')) {

				$className = $this->getRepositoryName();
				if(!($deleteId  instanceof $className)) {
					$entity = $this->getDocumentManager()->getRepository($this->getRepositoryName())->find($deleteId);
				} else {
					$entity = $deleteId;
				}
				
				$entity->setIsDeleted(true);
				$this->getDocumentManager()->persist($entity);				
			}
		}

		if(method_exists($this->getRepositoryName(), 'setIsDeleted')) {
			$this->getDocumentManager()->flush();	
		}
	}	

	/**
	 * Getter for errorMessage
	 *
	 * @return mixed
	 */
	public function getErrorMessage()
	{
	    return $this->errorMessage;
	}
	
	/**
	 * Setter for errorMessage
	 *
	 * @param mixed $errorMessage Value to set
	 *
	 * @return self
	 */
	public function setErrorMessage($errorMessage)
	{
	    $this->errorMessage = $errorMessage;
	    return $this;
	}
					
}