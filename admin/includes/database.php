<?php

class Database
{
	private $conn;

 	function __construct()
	{
		$this->gal_connect();
	}

	public function gal_connect(){
		
		$this->conn = new mysqli(HOST,DB_USER,DB_PASS,DB_NAME);
		if($this->conn->connect_errno){
			echo "error in connection";
		}
	}

	public function connection(){
		$db =  new Database;
		return $db->conn;
	}

	public function query($sql){
		$result = mysqli_query($this->conn, $sql);
		if(!$result){
			echo ("error: ". mysqli_error($this->conn));
		}
		return $result;
	}

	 function fetchAll($result){
		$result = mysqli_fetch_all($result,MYSQLI_ASSOC);
		if(!$result){
			echo ("error: ". mysqli_error($this->conn));
		}
		return $result;
	}

	public function escape_string($string){
		$escaped = mysqli_real_escape_string($this->conn,$string);
		return $escaped;
	}
	public function lastInsertId(){
		return mysqli_insert_id($this->conn);
	}
}

$db = new Database;

