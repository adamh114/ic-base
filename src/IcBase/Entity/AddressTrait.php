<?php

namespace IcBase\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

trait AddressTrait
{
    /** @ODM\Field */
    protected $address1;

    /** @ODM\Field */
    protected $address2;

    /** @ODM\Field */
    protected $city;

    /** @ODM\Field */
    protected $stateProvince;

    /** @ODM\Field */
    protected $postalCode;

    /** @ODM\Field */
    protected $countryCode;

    /**
     * Getter for address1
     *
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }
    
    /**
     * Setter for address1
     *
     * @param mixed $address1 Value to set
     *
     * @return self
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        return $this;
    }

	/**
     * Getter for address2
     *
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }
    
    /**
     * Setter for address2
     *
     * @param mixed $address2 Value to set
     *
     * @return self
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

	/**
     * Getter for city
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }
    
    /**
     * Setter for city
     *
     * @param mixed $city Value to set
     *
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

	/**
     * Getter for stateProvince
     *
     * @return mixed
     */
    public function getStateProvince()
    {
        return $this->stateProvince;
    }
    
    /**
     * Setter for stateProvince
     *
     * @param mixed $stateProvince Value to set
     *
     * @return self
     */
    public function setStateProvince($stateProvince)
    {
        $this->stateProvince = $stateProvince;
        return $this;
    }

	/**
     * Getter for postalCode
     *
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }
    
    /**
     * Setter for postalCode
     *
     * @param mixed $postalCode Value to set
     *
     * @return self
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

	/**
     * Getter for countryCode
     *
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
    
    /**
     * Setter for countryCode
     *
     * @param mixed $countryCode Value to set
     *
     * @return self
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }
	                                                                                                                                
}