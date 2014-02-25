<?php


namespace IcBase\Form;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\InputFilter\InputFilterProviderInterface;

class Address extends Form implements ServiceLocatorAwareInterface, InputFilterProviderInterface
{
	use ServiceLocatorAwareTrait;

	public function init()
	{
        $this->add(array(
            'name' => 'address1',
            'options' => array(
                'label' => 'Address 1',
            ),
            'attributes' => array(
                'type'  => 'text',
            )
        ));

        $this->add(array(
            'name' => 'address2',
            'options' => array(
                'label' => 'Address 2',
            ),
            'attributes' => array(
                'type'  => 'text',
            )
        ));

        $this->add(array(
            'name' => 'city',
            'options' => array(
                'label' => 'City',
            ),
            'attributes' => array(
                'type'  => 'text',
            )
        ));

        $this->add(array(
            'name' => 'stateProvince',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label'         => \Factory\Util\Util::getLocaliedStateLabel(),
                'value_options' => \Factory\Util\Util::getLocalizedStateProvinces(true),
                'twb'           => array(
                )
            ),
            'attributes' => array(
            )
        ));

        $this->add(array(
            'name' => 'postalCode',
            'options' => array(
                'label' => \Factory\Util\Util::getLocaliedPostalCodeLabel(),
            ),
            'attributes' => array(
                'type'  => 'text',
            )
        ));		
	}

    public function getInputFilterSpecification()
    {
        return array(
            'address1'  => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'address2'  => array(
                'required' => false,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'city'  => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'stateProvince'  => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'postalCode'  => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            )        	
    	);
    }
}