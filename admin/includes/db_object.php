<?php


class Db_object{



public static function findAllUsers()
{
	
	return static::find_this_query("select * from ".static::$table);
}

public static function findById($id){
	global $db;
	$user_find_data = static::find_this_query("select * from ".static::$table." where id=".$id." LIMIT 1");
	
	return !empty($user_find_data) ? array_shift($user_find_data) : false;
}

public static function find_this_query($sql){
	global $db;
	$result_set = $db->query($sql);
	$obj_arr = [];
	while($row = mysqli_fetch_array($result_set)){
		
		$obj_arr[] =static::intantiation($row);
	}
	return $obj_arr;
}  

public static function intantiation($the_field){
	
	$user_obj = new static;

	foreach ($the_field as $the_attr => $value) {
		
		if($user_obj->has_the_attribute($the_attr)){
			
			 $user_obj->$the_attr = $value;
		}
	}
	return $user_obj;
} 

private function has_the_attribute($the_attr){ // for checking users table column and properties are same

 $attr_show = get_object_vars($this);

 return array_key_exists($the_attr, $attr_show);
}

public static function old($value){
	if(isset($_REQUEST[$value])){
		return $_REQUEST[$value];
	}
	return '';
}

public function properties(){
	
	$property =[];
	foreach (static::$class_properties as $key=>$value) {
		
		if(property_exists($this, $value)){
			$property[$value] =$this->$value;
		}
	}

	return $property;
}

public function cleanProperties(){
	global $db;
	$clean_properties = [];
	foreach ($this->properties as $key => $value) {
		$clean_properties[$key]=$db->escape_string($value);
	}
	return $clean_properties;
}


public  function create(){
	global $db;

	$properties = $this->properties();
	$sql ="insert into ".static::$table.' ('.implode(",", array_keys($properties));
	$sql .=") VALUES('".implode("','",array_values($properties))."')";
	

	if($db->query($sql)){
		$this->id = $db->lastInsertId();
		return true;
	}
	return false;
}

public function update(){

	global $db;

		$properties = $this->properties();
		$update_pair =[];
		foreach ($properties as $key => $value) {
			$update_pair[] = "{$key}='{$value}'";
		}
	$sql ="update ".static::$table." set ";
	$sql .=implode(", ", $update_pair);
	$sql .= " where id=".$db->escape_string($this->id);
	
	$db->query($sql);
	if(mysqli_affected_rows($db->connection())==1){
		
		return true;
	}
	return false;

}

public function save(){
	return isset($this->id) ? $this->update() : $this->create();
}

public function delete(){
	global $db;
	$sql ="DELETE from ".static::$table." where id=".$db->escape_string($this->id)." Limit 1";
	$db->query($sql);
	return mysqli_affected_rows($db->connection()) ==1 ? true : false;
}


}