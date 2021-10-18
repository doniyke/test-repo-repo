<?php
class DbConnection {
	private $host = "localhost";
	
	private $dbname = "anny";
	private $username = "root";
	private $password = "";

	// private $dbname = "nacojohn_annyikebudu";
	// private $username = "nacojohn_annyike";
	// private $password = "Y7vYHa&[BM*x";
	
	public $connection;

	

	public function __construct() {
		try {
			$this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
		} catch(PDOException $ex) {
			echo $ex->getMessage();
		}
	}
}
?>