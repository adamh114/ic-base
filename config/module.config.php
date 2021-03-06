<?php

use DoctrineModule\Service as CommonService;
use DoctrineMongoODMModule\Service as ODMService;

return array(
    'doctrine' => array(
        'driver' => array(
            'odm_default' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',                
                'paths' => array(
                    __DIR__ . '/../src/IcBase/Entity'
                ),
                'drivers' => array(
                    'IcBase\Entity'    => 'odm_default'
                )
            )
        ),            	
	),
    'controller_plugins'  => array(
      'invokables'  => array(
        'icBaseDatePicker'        => 'IcBase\Controller\Plugin\DatePicker',
      )
    ),    
    'form_elements'     => array(
        'invokables'        => array(
        )
    ),
    'service_manager' => array(
        'invokables' => array(
            'IcBase\Service\HumanIdService'         => 'IcBase\Service\HumanIdService'
        )
    ),
    'view_helpers'  => array(
      'invokables'  => array(
            'twbHorizontalForm'             => 'IcBase\View\Helper\HorizontalForm',
            'dateRangePicker'               => 'IcBase\View\Helper\DateRangePicker',
            'angularize'                    => 'IcBase\View\Helper\Angularize',
            'icBaseDatePicker'              => 'IcBase\View\Helper\DatePicker'
        )
    ),
    'view_manager'  => array(
        'template_map' => array(
            'ic-base/daterange-picker'  => __DIR__ . '/../view/ic-base/daterange-picker.phtml',
            'ic-base/date-picker'  => __DIR__ . '/../view/ic-base/date-picker.phtml'

        )
    )            
);