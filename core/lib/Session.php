<?php 
class Session{

	public $controller; 
	
	public function __construct(){		
		if(!isset($_SESSION)){
			session_start(); 
		}
	}

	public function write($key,$value){
		$_SESSION[$key] = $value;
	}

	public function delete($key = null){
		if(isset($key)) {
			if(isset($_SESSION[$key])) {
				unset($_SESSION[$key]);
			}
		} else {
			session_destroy();
		}
		
	}

	public function read($key = null){
		if($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key]; 
			}else{
				return false; 
			}
		}else{
			return $_SESSION; 
		}
	}

	public function isLogged(){
		return isset($_SESSION['User']->role);
	}

	public function user($key){
		if($this->read('User')){
			if(isset($this->read('User')->$key)){
				return $this->read('User')->$key; 
			} else{
				return false;
			}
		}
		return false;
	}

}