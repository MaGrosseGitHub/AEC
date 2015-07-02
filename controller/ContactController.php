<?php 
class ContactController extends Controller{
	
	/**
	* Blog, liste les articles
	**/
	function index(){
		if($this->request->data && !empty($this->request->data))
		{
			// $this->loadModel('Contact'); 		
			// $contact = $this->Contact->findFirst();
			$contact = new StdClass;
			$contact->email = "rad.l@live.fr";

			$valid = true;
			if($this->request->data->adresse != ""){
				$this->redirect('contact/index'); 
			}else {
				if(empty($this->request->data->object)) {
					$valid=false;
					$this->Notification->setFlash("Vous n'avez pas rempli la partie objet",'error');
				}
				if(empty($this->request->data->name)) {
					$valid=false;
					$this->Notification->setFlash("Vous n'avez pas rempli la partie nom et prénom",'error');
				}
				if(empty($this->request->data->content)){
					$valid=false;
					$this->Notification->setFlash("Vous n'avez pas rempli votre message",'error');
				}
				if(empty($this->request->data->email)){
					$valid=false;
					$this->Notification->setFlash("Vous n'avez pas renseigné votre email",'error');
				}
				if(!filter_var($this->request->data->email, FILTER_VALIDATE_EMAIL)){
					$valid=false;
					$this->Notification->setFlash("Votre email n'est pas valide",'error');
				}

				if($valid)
				{
					$to = "$contact->email";
					$subject = "{$this->request->data->object}";
					// $header = "From: radouane.lahmidi@etud.univ-paris8.fr \n";
					$header = "From: {$this->request->data->name} \n";
					// $header .= "CC: somebodyelse@example.com". "\r\n";
					$header .= "Reply-To: {$this->request->data->email}". "\r\n";
		     		$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					
					$message = stripslashes($this->request->data->content);
					
					if(mail($to,$subject,$message,$header))	{
						$this->Notification->setFlash("Votre message a bien été envoyé",'success');
					} else {
						$this->Notification->setFlash("du à une errreur votre mail n'a pas été envoyé",'error');
					}
				}
			}
		}
	}

	function admin_index($id = null){
		$this->loadModel('Contact'); 
		if($id === null)
			$contact = $this->Contact->findFirst();
		if(!empty($contact)){
			$id = $contact->id;
		}else 
			$id = 12;

		$d['id'] = $id;
		if($this->request->data){
			debug($this->request->data);
			if($this->Contact->validates($this->request->data)){
				$this->request->data->contact = "admin";
				$this->Contact->save($this->request->data);

				$cacheDir = Cache::CONTACT.DS;
				$this->Cache->write("contactData", $this->request->data, $cacheDir, true);
				$this->Notification->setFlash('Le contenu a bien été modifié', 'success');
				// $this->redirect('admin/contact/index'); 
			} else {				
				$this->Notification->setFlash('Merci de corriger vos informations','error'); 
			}
		} else {
			$this->request->data = $this->Contact->findFirst();
			debug($this->request->data);
			debug($id);
		}
		$this->set($d);
	}

}