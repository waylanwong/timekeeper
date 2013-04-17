<?php

namespace Timekeeper\Model;

use Zend\Db\TableGateway\TableGateway;

class TimekeeperClockTable {
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll() {
		$resultSet = $this->tableGateway->select();
		
		return $resultSet;
	}
	
	public function getLatest($id) {
		
	}
	
	public function getPassword($id) {
		
	}
	
	public function saveNewUser($username, $password) {
		
	}
	
	public function saveTime(Timekeeper $timekeeper) {
		$data = array(
			'username' => $timekeeper->user,
			'password' => $timekeeper->pass,
			'currentTime' => $timekeeper->currentTime,
		);
	}
	
} 
?>