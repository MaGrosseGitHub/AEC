<?php 
class Notification{

	public function setFlash($message, $type = 'general', $return = false, $options = array()){
		$options['content'] = $message;
		$options['type'] = $type;
		$existingOptions = ['title', 'content', 'type', 'img', 'fill', 'encTypo', 'color', 'timeout'];
		foreach ($existingOptions as $key => $option) {
			if(!isset($options[$option])) {
				$options[$option] = "";
				if($option == "fill"){
					$options[$option] = false;
				}
			}
		}
		$_SESSION['flash'][] = $options;

		if($return) {
			$this->flash();
		}
	}

	public function flash(){
		if(isset($_SESSION['flash']) && count($_SESSION['flash']) != 0){
			$html = array();
			foreach ($_SESSION['flash'] as $notifId => $notification) {
				echo "<notif>".json_encode($notification)."</notif>";
				$notif = "<notif>".json_encode($notification)."</notif>";
				array_push($html, $notif);
				unset($_SESSION["flash"][$notifId]);
			}
			// $html = '<div class="alert-message '.$_SESSION['flash']['type'].'"><p>'.$_SESSION['flash']['message'].'</p></div>'; 
			// return $html; 
		}
	}

}