<?php
class Request{
	

	public $url; 				// URL appellé par l'utilisateur
	public $page = 1; 			// pour la pagination 
	public $prefix = false; 	// Prefixage des urls /prefix/url
	public $data = false; 		// Données envoyé dans le formulaire
	public $replaceInUrl;

	function __construct(){
		if(Conf::$debug>0){
		    // fixes weird bug with autoloader
	  	}
		$this->url = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/'; 
		$this->url = str_replace($this->replaceInUrl, "", $this->url);
		$this->url = str_replace("webroot", "", $this->url);

		// Si on a une page dans l'url on la rentre dans $this->page
		if(isset($_GET['page'])){
			if(is_numeric($_GET['page'])){
				if($_GET['page'] > 0){
					$this->page = round($_GET['page']); 
				}
			}
		}
		// Si des données ont été postées ont les entre dans data
		if(!empty($_POST)){

			$this->data = new stdClass(); 
			foreach($_POST as $k=>$v){
				$this->data->$k=$v;
			}
		}
	}


}