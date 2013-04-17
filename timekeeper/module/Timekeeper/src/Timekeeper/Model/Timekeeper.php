<?php
	namespace Timekeeper\Model;
	
	use Zend\InputFilter\Factory as InputFactory;
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
	
	class Timekeeper implements InputFilterAwareInterface {
		public $id;
		public $user;
		public $pass;
		public $currentTime;
		protected $inputFilter;
		
		public function exchangeArray($data) {
			$this->id 		= (isset($data['id']))		?	$data['id']		: null;
			$this->user		= (isset($data['user']))	?	$data['user']	: null;
			$this->pass		= (isset($data['pass']))	?	$data['pass']	: null;
			$this->currentTime = (isset($data['currentTime'])) ? $data['currentTime'] : null; 					
		}
		
		public function getArrayCopy() {
			return get_object_vars($this);
		}
		
		public function setInputFilter(InputFilterInterface $inputFilter) {
			throw new \Exception('Not used.');
		}
		
		public function getInputFilter() {
			if (!$this-InputFilter) {
				$inputFilter = new InputFilter();
				$factory = new InputFactory();
				
				$inputFilter->add($factory->createInput(array(
					'name'		=> 'id',
					'required'	=>	true,
					'filters'	=> 	array(
						array('name' => 'Int'),
					),
				)));
				
				$inputFilter->add($factory->createInput(array(
					'name'		=> 'user',
					'required'	=> true,
					'filters'	=> array(
						array('name'=>'StripTags'),
						array('name'=>'StringTrim'),
					),
					'validators' => array(
						array(
							'name'		=> 'StringLength',
							'options' 	=> array(
								'encoding'		=> 'UTF-8',
								'min'			=> 6,
								'max'			=> 12,								
							),
						),
					),
				)));				
				
				$inputFilter->add($factory->createInput(array(
					'name'		=> 'pass',
					'required'	=> true,
					'filters'	=> array(
						array('name'=>'StripTags'),
						array('name'=>'StringTrim'),
					),
					'validators' => array(
						array(
							'name'		=> 'StringLength',
							'options' 	=> array(
								'encoding'		=> 'UTF-8',
								'min'			=> 6,
								'max'			=> 12,								
							),
						),
					),
				)));
				
				$inputFilter->add($factory->createInput(array(
					'name'		=> 'currentTime',
					'required'	=> true,
					'filters'	=> array(
						array('name'=>'Int'),
					),
				)));
				
				$this->InputFilter = $inputFilter; 
			}

			return $this->InputFilter;
		}
		
	} // end of Timekeeper class
?>