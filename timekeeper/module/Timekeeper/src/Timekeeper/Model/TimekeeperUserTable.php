<?php

namespace Timekeeper\Model;

use Zend\Db\TableGateway\TableGateway;

class TimekeeperUserTable {
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll() {
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}
	
	public function getUsername($id) {
		$id = (int)$id;
		$rowset = $this->tableGateway->select(array('id'=>$id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception('Could not find username by $id');
		}
		
		return $row->username;
	}
	
	public function getPassword($id) {
		$id = (int)$id;
		$rowset = $this->tableGateway->select(array('id'=>$id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception('Could not find password by $id');
		}
		return $row->password;
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