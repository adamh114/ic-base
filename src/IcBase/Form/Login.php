<?php


namespace IcBase\Form;

use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\InputFilter\InputFilterProviderInterface;

class Login extends Form implements ServiceLocatorAwareInterface, InputFilterProviderInterface
{
	use ServiceLocatorAwareTrait;

	public function init()
	{
        $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'Username'
            ),
            'attributes' => array(
                'type'  => 'text'
            )
            
        ));

        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Password'
            ),
            'attributes' => array(
                'type'  => 'password',
            )
            
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'username'  => array(
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim')
                ),
                'validators' => array(
                     /* new \Zend\Validator\Regex('/^#[0-9a-fA-F]{6}$/') */
                )
            ),
            'password'  => array(
                'required' => false,
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