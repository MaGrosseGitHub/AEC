<?php 
class Cookies{

	public static function write($key,$value,$duration = null){
		if(self::CookieChange($key,$value)) {
			if(!isset($duration) || empty($duration)) {
				$duration = 365*24*3600;
			}
			$duration = time()+$duration;
			// setcookie($key, $value, $duration "/", ".".$_SERVER['SERVER_NAME']);
			try {
				setcookie($key, $value, $duration, "/", null);
			} catch (Exception $e) {				
				$this->Notification->setFlash("Un probléme inconnu s'est produit", "error", false, array("title" => "Cookies")); 
			}
		} else {
			return false;
		}

	}

	public static function read($key = null){
		if($key){
			if(isset($_COOKIE[$key])){
				return $_COOKIE[$key]; 
			}else{
				return false; 
			}
		}else{
			return $_COOKIE; 
		}
	}

	public static function delete($key, $path = "/"){
		if(self::CheckCookie($key)) {
			if(isset($_COOKIE[$key])) {
				setcookie($key, "", time() - 36000,$path);
			}
		}		
	}

	public static function CheckCookie($name){
		if(isset($_COOKIE[$name]) && !empty($_COOKIE[$name])) {
			return true;
		} else {
			return false;
		}		
	}

	//check if the old value and the new value are the same, returns true if the values are different
	public static function CookieChange($name,$newValue){
		if(self::CheckCookie($name)) {
			if($_COOKIE[$name] != $newValue)
				return true;
			else
				return false;
		} else {
			return true;
		}		
	}

}