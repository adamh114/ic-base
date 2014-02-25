<?php

namespace IcBase\Form;


class ShippingAddress extends Address
{
	public function init()
	{
		parent::init();

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Name',
            ),
            'attributes' => array(
                'type'  => 'text',
            )
        ));

        $this->add(array(
            'name' => 'careOf',
            'options' => array(
                'label' => 'Care Of',
            ),
            'attributes' => array(
                'type'  => 'text',
            )
        ));
	}

    public function getInputFilterSpecification()
    {
        return array_merge(parent::getInputFilterSpecification(), array(
            'name'  => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'careOf'  => array(
                'required' => false,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            )
    	));
    }	
}