<?php

namespace IcBase\Form;

/**
 * extends Address form and adds name and careOf
 */
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
        ), array('priority' => 100));

        $this->add(array(
            'name' => 'careOf',
            'options' => array(
                'label' => 'Care Of',
            ),
            'attributes' => array(
                'type'  => 'text',
            )
        ), array('priority' => 99));
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
            ),
            'address1'  => [
                'required' => false,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators'        => [
                    ['name'      => 'Callback',
                    'options'   => [
                        'callback'  => function ($value) {
                            if (preg_match("/^p\\.?o\\.? box/uis", $value) === 0) {
                                return true;
                            } else {
                                return false;
                            }
                        },
                        'message'   => 'Our shipping carrier does not ship to PO Boxes'
                    ]
                    ]
                ]
            ]
    	));
    }	
}