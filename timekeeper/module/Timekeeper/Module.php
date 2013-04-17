<?php

namespace Timekeeper;

class Module {

	public function getAutoloaderConfig() {
		return array('Zend\Loader\ClassMapAutoloader' => array(__DIR__ . '/autoload_classmap.php', ), 'Zend\Loader\StandardAutoloader' => array('namespaces' => array(__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__, ), ), );
	}

	public function getConfig() {
		return
		include __DIR__ . '/config/module.config.php';
	}

	/**
	 * This function will create a factory that creates an TimekeeperTable
	 * whenever it is called by the ServiceManager.
	 */
	public function getServiceConfig() {
        return array(
            'factories' => array(
                'Timekeeper\Model\TimekeeperTable' => function($sm) {
                    $tableGateway = $sm -> get('TimekeeperTableGateway');
                    $table = new TimekeeperTable($tableGateway);
                    return $table;
                }, 
                'TimekeeperUserTableGateway' => function($sm) {
                    $dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype -> setArrayObjectPrototype(new Timekeeper());
                    return new TableGateway('user_credentials', $dbAdapter, null, $resultSetPrototype);
                },
                'TimekeeperClockTableGateway' => function($sm) {
                    $dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();					
                    $resultSetPrototype -> setArrayObjectPrototype(new Timekeeper());
                    return new TableGateway('user_clocks', $dbAdapter, null, $resultSetPrototype);
                },  
            ),
        );
    }


}
?>