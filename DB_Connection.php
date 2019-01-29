<?php
/**
* Database Connection Class
*/
class Database {

	public static $DB_CONN;
	private $DB_USER = 'root';
	private $DB_PASS = '';
	private $DB_NAME = 'hants';
	private $DB_HOST = 'localhost';
	private $DB_PORT = '3306';
	private $DB_CONN_STATUS = false;

	public function __construct() {
		if(!isset(self::$DB_CONN)) {
			self::$DB_CONN = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME, $this->DB_PORT);
			if(self::$DB_CONN->connect_error) {
				die("Database connection error: " . self::$DB_CONN->connect_error);
			} else {
				$this->DB_CONN_STATUS = true;
			}
			$this->DB_CONN_STATUS = true;
		}
	}

	public function db_conn_status() {
		return $this->DB_CONN_STATUS;
	}
}

?>