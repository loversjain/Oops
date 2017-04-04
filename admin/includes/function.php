<?php 

 function __autoload($class)
{
	$class =strtolower($class);

	 $path = "includes/{$class}.php";

	if(file_exists($path)){
		require_once $path;
	}
	else{
		die ("error not found {$class}.php");
	}
}
function redirect($location){
	header("Location: {$location}");
  
}
?>