<?php

namespace IcBase\Form;

class CreditCard extends Address
{
	public function init()
	{
		parent::init();

        $this->add(array(
                'name' => 'cardNumber',
                'options' => array(
                    'label' => 'Card Number',
                    'twb' => array(
                    )
                ),
                'attributes' => array(
                    'type'  => 'text',
                )
        ), array('priority' => 100));

        $this->add(array(
            'name' => 'expirationMonth',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label'         => 'Exp Month',
                'value_options' => \IcBase\Util\Util::getExpMonths(true),
                'twb'           => array(
                )
            ),
            'attributes' => array(
            )
        ), array('priority' => 100));

        $this->add(array(
            'name' => 'expirationYear',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label'         => 'Exp Year',
                'value_options' => \IcBase\Util\Util::getExpYears(true),
                'twb'           => array(
                )
            ),
            'attributes' => array(
            )
        ), array('priority' => 100));

        $this->add(array(
                'name' => 'securityCode',
                'options' => array(
                    'label' => 'Security Code',
                    'twb' => array(
                    )
                ),
                'attributes' => array(
                    'type'  => 'text',
                )
        ), array('priority' => 100));
	}

    public function getInputFilterSpecification()
    {
        return array_merge(parent::getInputFilterSpecification(), array(
            'cardNumber'  => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'expirationMonth'  => array(
                'required' => false,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'expirationYear'  => array(
                'required' => false,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'securityCode'  => array(
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