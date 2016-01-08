<?php

/**
* 
*/
class DBConnection
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "root";
	private $dbName = "dhvtsu_student_app";
	private $conn = false;

	public function connect()
	{
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
		} catch (Exception $e) {
			echo json_encode(array(
					'status' => 'error',
					'message' => 'Connection Failed!'."\r\n".'Server is unavailable'
				)
			);
			die;
		}
		
		return $this->conn;
	}

}