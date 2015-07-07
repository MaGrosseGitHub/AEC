<?php 
class UsersController extends Controller{
	
	/**
	* Login
	**/
	function login(){

		$encryptData = new Encrypt();
		if(isset($this->request->data)) {
			$data = $this->request->data;
		} 

		if(isset($_COOKIE['userInfo']) && !empty($_COOKIE['userInfo'])) {
			$userInfo = Cookies::read("userInfo");
			$userInfo = Encrypt::DecryptData($userInfo,true);
			$data = new stdClass(); 
			$data->login = $userInfo["un"];
			$data->password = $userInfo["pw"];
		}

		if(isset($data) && !empty($data)){
			if(!isset($_COOKIE['userInfo'])) {
				$data->password = md5(hash("sha256", $data->password));
			}
			$this->loadModel('User'); 
			$user = $this->User->findFirst(array(
				'conditions' => array('login' => $data->login,'password' => $data->password)
				));
			if(!empty($user)){
				$this->Session->write('User',$user); 
				if(isset($data->saveLogin)) {
					if(!isset($_COOKIE['userInfo'])) {
						$userInfo = array("un" => $data->login, "pw" => $data->password);
						$userInfo = $encryptData->encryptData($userInfo,true);
						Cookies::write('userInfo',$userInfo);
					}
				}
			}
			else{
				if(Cookies::CheckCookie('userInfo')) {
					Cookies::delete('userInfo');
				}
				$this->Notification->setFlash("Nom d'utilisateur ou mot de passe incorrect.", "error", false, array("title" => "Connection")); 
			}

			if(isset($this->request->data->password)) {
				$this->request->data->password = '';				
			} 
		}
		if($this->Session->isLogged()){
			if($this->Session->user('role') == 'admin'){
				$this->redirect('cockpit');
			}else{
				$this->redirect('');
			}
		}
	}

	/**
	* Logout
	**/
	function logout(){
		unset($_SESSION['User']);
		Cookies::delete('userInfo');
		if(isset($_GET['ajax'])) {
			$this->Notification->setFlash('Vous ête mainenant déconnecté', 'success', true); 
		} else {
			$this->Notification->setFlash('Vous ête mainenant déconnecté', 'success'); 
			$this->redirect('/'); 
		}
	}

}