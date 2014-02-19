<?php

namespace IcBase\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

trait IdentificationTrait
{
    /** @ODM\Id */
	protected $id;

    /** @ODM\Date */
	protected $createdAt;

    /** @ODM\Date */
	protected $updatedAt;

    /** @ODM\Int */
	protected $humanId;

    /** @ODM\Boolean */
	protected $isDeleted;

	public function toArray()
	{
		return get_object_vars($this);
	}
	
	/**
	 * Getter for id
	 *
	 * @return mixed
	 */
	public function getId()
	{
	    return $this->id;
	}
	
	/**
	 * Setter for id
	 *
	 * @param mixed $id Value to set
	 *
	 * @return self
	 */
	public function setId($id)
	{
	    $this->id = $id;
	    return $this;
	}

	/**
	 * Getter for createdAt
	 *
	 * @return mixed
	 */
	public function getCreatedAt()
	{
	    return $this->createdAt;
	}
	
	/**
	 * Setter for createdAt
	 *
	 * @param mixed $createdAt Value to set
	 *
	 * @return self
	 */
	public function setCreatedAt($createdAt)
	{
	    $this->createdAt = $createdAt;
	    return $this;
	}

	/**
	 * Getter for updatedAt
	 *
	 * @return mixed
	 */
	public function getUpdatedAt()
	{
	    return $this->updatedAt;
	}
	
	/**
	 * Setter for updatedAt
	 *
	 * @param mixed $updatedAt Value to set
	 *
	 * @return self
	 */
	public function setUpdatedAt($updatedAt)
	{
	    $this->updatedAt = $updatedAt;
	    return $this;
	}

	/**
	 * Getter for humanId
	 *
	 * @return mixed
	 */
	public function getHumanId()
	{
	    return $this->humanId;
	}
	
	/**
	 * Setter for humanId
	 *
	 * @param mixed $humanId Value to set
	 *
	 * @return self
	 */
	public function setHumanId($humanId)
	{
	    $this->humanId = $humanId;
	    return $this;
	}
	

	/**
	 * Getter for isDeleted
	 *
	 * @return mixed
	 */
	public function getIsDeleted()
	{
	    return $this->isDeleted;
	}
	
	/**
	 * Setter for isDeleted
	 *
	 * @param mixed $isDeleted Value to set
	 *
	 * @return self
	 */
	public function setIsDeleted($isDeleted)
	{
	    $this->isDeleted = $isDeleted;
	    return $this;
	}
							
}
