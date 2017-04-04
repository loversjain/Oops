<?php 
class session{

	public $user_id;
	private $signedIn;

	public function __construct()
	{
		session_start();
		$this->check_the_login();
	}

	public function is_sign_in(){
		return $this->signedIn;
	}

	public function login($user){
		if($user){
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->signedIn = true;
		}
	}

	public function logout(){
		unset($_SESSION['user_id']);
		unset($this->signedIn);
		$this->signedIn = false;
	}

	private function check_the_login(){
		if(isset($_SESSION['user_id'])){
			$this->user_id = $_SESSION['user_id'];
			$this->signedIn = true;
		}else{
			unset($_SESSION['user_id']);
			$this->signedIn =false;
		}
	}
}

$session = new session;
?>