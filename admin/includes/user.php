<?php 
class User extends Db_object{
	
	protected static $table ='users';
	protected static $class_properties =['username','password','first_name','last_name'];
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	



public static function verify_user($user, $pass){
	global $db;
	$user = $db->escape_string($user);
	$pass = $db->escape_string($pass);

	$sql= "select * from ".self::$table." where ";
	$sql .= "username ='{$user}' and ";
	$sql .="password ='{$pass}'";

	$user_find_data = self::find_this_query($sql);
	return !empty($user_find_data) ? array_shift($user_find_data) : false;
} 




}



?>