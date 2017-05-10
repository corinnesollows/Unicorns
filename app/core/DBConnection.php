<?php
class DBConnection{
	public $connection;

	private $_DBUser = 'root';
	private $_DBPass = '';
	private $_DBName = 'pocket_unicorns';

	public function __construct(){
        $this->connection = new PDO('mysql:host=localhost;dbname=' . $this->_DBName, $this->_DBUser, $this->_DBPass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}

?>