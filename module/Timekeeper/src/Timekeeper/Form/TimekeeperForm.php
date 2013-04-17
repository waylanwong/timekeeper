<?php

namespace Timekeeper\Form;

use Zend\Form\Form;

class TimekeeperForm extends Form {
	public function _construct($name = null){
		// ignore the passed in $name
		parent::__construct('album');
		$this->setAttribute('method', 'post');
		
		$this->add(array(
			'name'	=> 'id',
			'attribute' => array('type' => 'hidden'),
		));
		
		$this->add(array(
			'name' => 'currentTime',
			'attribute' => array('type' => 'hidden'),
		));
		
		$this->add(array(
			'name' => 'user',
			'attributes' => array('type' => 'text'),
			'options' => array('label' => 'Username'),
		));
		
		$this->add(array(
			'name' => 'pass',
			'attributes' => array('type' => 'password'),
			'options' => array('label' => 'Password'),
		));
		
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type' => 'submit', 
				'value' => 'Go',
				'id' => 'submitbutton',
			),
		));
	}
}

?>