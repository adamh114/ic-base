<?php

namespace IcBase\Entity;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="human_id_counter")  */
class HumanIdCounter
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field */
    private $entity;

    /** @ODM\Int */
    private $sequence;

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
     * Getter for entity
     *
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Setter for entity
     *
     * @param mixed $entity Value to set
     *
     * @return self
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Getter for sequence
     *
     * @return mixed
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Setter for sequence
     *
     * @param mixed $sequence Value to set
     *
     * @return self
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;

        return $this;
    }

}
