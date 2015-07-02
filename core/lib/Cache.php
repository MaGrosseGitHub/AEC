<?php
class Cache{

	public $dirname;	// Dossier de cache
	public $duration;   // Durée de vie du cache EN MINUTES
	public $buffer;		// Buffer (utilisé pour les méthodes start/end)

	const POST = "tmp/Post";
	const CONTACT = "tmp/Contact";
	const DUMP = "tmp/Dumps";
	const AUTHOR = "tmp/Author";
	const ORGANIZATION = "tmp/Organization";
	const EVENT = "tmp/Event";
	const WEATHER = "tmp/Weather";

	/**
	* Initialise le cache
	* @param string $dirname Dossier contenant le cache
	* @param int $duration Durée de vie du cache
	**/
	public function __construct($dirname = null, $duration = null){
		$this->dirname = isset($dirname) ? $dirname : "";
		$this->duration = isset($duration) ? $duration : "";
	}

	/**
	* Ecrit une chaine de caractère dans le cache
	* @param string $cachename Nom du fichier de cache
	* @param string $content Chaine de caractère à stocker
	**/
	public function write($cachename, $content, $dirname = null, $serialize = false){
		// debug($content);
		if($serialize){
			$content = serialize($content);
		}
		// debug($content);

		if(!isset($dirname)){
			if($this->dirname != null && $this->dirname != ""){
				$dirname = $this->dirname;
			}else{
				$dirname = self::POST;
			}
		}

  		MakePath($dirname.'/'.$cachename, true);
		file_put_contents($dirname.'/'.$cachename, $content);
		return touch($dirname.'/'.$cachename);
	}

	/**
	* Permet de lire une variable dans le cache
	* @param string $cachename Nom du fichier de cache
	**/
	public function read($cachename,$unserialize = false, $useClassDirectory = false, $directory = null){
		$readDirectory = isset($directory) ? $directory : ($this->dirname == "") ? self::POST : $this->dirname;
		if($useClassDirectory)
			$file = $this->readDirectory.'/'.$cachename;
		else
			$file = $cachename;

		if(!file_exists($file)){
			return false;
		} 
		
		$contents = file_get_contents($file);

		if($unserialize)
			$contents = unserialize($contents);

		// $lifetime = (time() - filemtime($file)) / 60;
		// if($lifetime > $this->duration){
		// 	return false;
		// }
		return $contents;
	}

	/**
	* Permet de supprimer un fichier de cache
	* @param string $cachename Nom du fichier de cache
	**/
	public function delete($cachename){
		$file = $this->dirname.'/'.$cachename;
		if(file_exists($file)){
			unlink($file);
		}
	}

	/**
	* Permet de nettoyer le cache, Vider tous les fichiers en cache
	**/
	public function clear(){
		$files = glob($this->dirname.'/*');
		foreach( $files as $file ) {
			unlink($file);
		}
	}

	/**
	* Inclue un fichier en utilisant le cache
	* @param string $file Fichier à inclure (chemin absolu)
	* @param string $cachename Nom du fichier de cache
	**/
	public function inc($file, $cachename = null){
		if(!$cachename){
			$cachename = basename($file);
		}
		if($content = $this->read($cachename)){
			echo $content;
			return true;
		}
		ob_start();
		require $file;
		$content = ob_get_clean();
		$this->write($cachename, $content);
		echo $content;
		return true;
	}

	/**
	* Démarre un buffer qui permettra de mettre en cache tout le contenu jusqu'au prochain Cache::end()
	* @param string $cachename Nom du fichier de cache
	**/
	public function start($cachename){
		if($content = $this->read($cachename)){
			echo $content;
			$this->buffer = false;
			return true;
		}
		ob_start();
		$this->buffer = $cachename;
	}


	public function end(){
		if(!$this->buffer){
			return false;
		}
		$content = ob_get_clean();
		echo $content;
		$this->write($this->buffer, $content);
	}

}