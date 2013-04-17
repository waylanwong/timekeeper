<?php

namespace Timekeeper\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Timekeeper\Model\Timekeeper;
use Timekeeper\Form\TimekeeperForm; 

class TimeKeeperController extends AbstractActionController {
	
	protected $timekeeperuserTable;
	protected $timekeeperclockTable;
	
	public function indexAction() {
				
		// make the login form here.
		$form = new TimekeeperForm();
		$form->get('submit')->setValue('Login');
		
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			//echo "DEBUG: Post data is present <br />";
			
			$timekeeper = new Timekeeper();
			$form->setInputFilter($timekeeper->getInputFilter());
			$form->setData($request->getPost());
			
			if ($form->isValid()) {
				//echo "DEBUG: form data is valid <br />;"
				
				$timekeeper->exchangeArray($form->getData());
				$this->getTimekeeperClockTable()->saveClockPunch($timekeeper);
				
				// Redirect to the list of albums
				return $this->redirect()->toRoute('timekeeper');
			
			}			
		}		
		
	}
	
	public function getTimekeeperClockTable() {
		if (!$this->timekeeperclockTable) {
			$sm = $this->getServiceLocator();
			$this->timekeeperclockTable = $sm->get('Timekeeper\Model\TimekeeperTable');
		}
		return $this->timekeeperclockTable;
	}
	
}

?>