<?php
/**
* Dispatcher
* Permet de charger le controller en fonction de la requête utilisateur
**/
class Dispatcher{
	
	var $request;	// Object Reques

	/**
	* Fonction principale du dispatcher
	* Charge le controller en fonction du routing
	**/
	function __construct($replaceInUrl){
		$this->request = new Request(); 
		$this->request->replaceInUrl = $replaceInUrl;
		Router::parse($this->request->url,$this->request); 
		$controller = $this->loadController();
		$action = $this->request->action;
		if($this->request->prefix){
			if($this->request->prefix != "include")
				$action = $this->request->prefix.'_'.$action;
			if($this->request->prefix == "cockpitInc")
				$action = str_replace("cockpitInc", "admin", $action);
		}
		if(!in_array($action , array_diff(get_class_methods($controller),get_class_methods('Controller')))){
			$this->error('Le controller '.$this->request->controller.' n\'a pas de méthode '.$action); 
		}
		call_user_func_array(array($controller,$action),$this->request->params); 

		if($this->request->prefix != "include" && $this->request->prefix != "cockpitInc")
			$controller->render($action);
		else 
			$controller->render($this->request->prefix.'_'.$action);
	}

	/**
	* Permet de générer une page d'erreur en cas de problème au niveau du routing (page inexistante)
	**/
	function error($message){
		$controller = new Controller($this->request);
		$controller->e404($message); 
	}

	/**
	* Permet de charger le controller en fonction de la requête utilisateur
	**/
	function loadController(){
		$name = ucfirst($this->request->controller).'Controller'; 
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		if(!file_exists($file)){
			$this->error('Le controller '.$this->request->controller.' n\'existe pas'); 
		} 
		require $file; 
		$controller = new $name($this->request); 
		return $controller;  
	}


}