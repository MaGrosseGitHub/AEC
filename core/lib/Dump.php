<?php
class Dump{

	public $conf = "default";
	public $compress = true;

	public $excludeFromDump = array(); //user defined exclude
	public $includeOnlyInDump = array(); //user defined include

	private $host;
	private $dbb;
	private $login;
	private $password;

	private $dumpDirectory;
	private $dumpfile;

	private $dumpController = NULL;
	private $dumpModel = false;

	private $dumpInstance;
	private $dumpSettings;
	private $exclude = ['imgdumps', 'events', 'mapinfos', 'maps', 'participates', 'posts', 'sites'];
	private $excludeOrigin = array();
	private $include = array();
	private $dumpZipType; //Mysqldump::GZIP, Mysqldump::BZIP2 or Mysqldump::NONE
	private $availableZipTypes = [Mysqldump::GZIP, Mysqldump::BZIP2, Mysqldump::NONE];

	private $tableList;
	private $filteredTableList;


	function __construct($controller, $params = array()){
		$this->dumpController = $controller;

		$conf = Conf::$databases[$this->conf];
		if(!empty($params['confInfo'])){
			foreach ($params['confInfo'] as $confKey => $confVal) {
				if(!empty($confVal) && isset($conf[$confKey])){
					$conf[$confKey] = $confVal;
				}
			}
		}
		$this->host = $conf['host'];
		$this->dbb = $conf['database'];
		$this->login = $conf['login'];
		$this->password = $conf['password'];	
		
		$this->GetTableLists();
		$this->excludeOrigin = $this->exclude;
		if(!isset($params['noExcludes']) || !$params['noExcludes'])
			$this->dumpSettings = array('exclude-tables' => array()); // exclude-tables : Exclude these tables (array of table names)
		if(isset($params['includes']) && $params['includes'])
			$this->dumpSettings['include-tables'] = $this->include; //// include-tables : Only include these tables (array of table names)

		if(isset($params['zipType']) && !empty($params['zipType']) && in_array($params['zipType'], $this->availableZipTypes))
			$this->dumpZipType = $params['zipType'];
		else
			$this->dumpZipType = Mysqldump::GZIP;
		if(!isset($params['compress']) || !$params['compress'])
			$this->dumpSettings['compress'] = $this->dumpZipType;

		$this->dumpDirectory = Cache::DUMP."/"; //date + database name file/then dbb
		MakePath($this->dumpDirectory);
		$this->dumpfile = $this->dbb;
		$this->dumpfile = $this->FormatFileName($this->dumpfile);

		// $this->dumpInstance = new Mysqldump($dbb, $login, $password, $host, $dumpSettings);
	}

	private function LaunchController(){
		if($this->dumpController == NULL){
			$this->dumpController = new Controller();
		}
		if(!$this->dumpModel){
			$this->dumpController->loadModel('ImgDump');	
			$this->dumpModel = true;		
		}
	}

	private function GetTableLists(){
		$this->tableList = $this->GetListOfTables();
		$this->include =  array_unique(array_merge($this->include,$this->includeOnlyInDump), SORT_REGULAR);
		$this->filteredTableList = $this->GetFilteredList();
	}

	private function GetListOfTables(){
		$this->LaunchController();
		$alltables = $this->dumpController->ImgDump->db->query("SHOW TABLES",PDO::FETCH_NUM);

		$tableList = array();
		while($result=$alltables->fetch()){
			array_push($tableList, $result[0]);
		}
		return $tableList;
	}

	private function GetFilteredList(){
		$this->LaunchController();
		$alltables = $this->dumpController->ImgDump->db->query("SHOW TABLES",PDO::FETCH_NUM);

		$filters = array_unique(array_merge($this->exclude,$this->excludeFromDump), SORT_REGULAR);

		$tableList = array();
		while($result =$alltables->fetch()){
			if(!in_array($result[0], $filters))
				array_push($tableList, $result[0]);
		}
		return $tableList;
	}

	private function FormatFileName($name){
		$date = date("Y-m-d__h-i-s");
		return $date.'_'.$name.'.sql';
	}

	private function GetFileModTime($file){
		if (file_exists($file)) {
		    return filemtime($file);
		} else {
			return false;
		}
	}

	private function DumpBDD($dumpSettings, $dumpDir, $file = ""){

        $this->dumpInstance = new Mysqldump($this->dbb, $this->login, $this->password, $this->host, 'mysql', $dumpSettings);

        try {
			if($file != "")
				$dumpDir = $file;
			MakePath($dumpDir, true);
			$this->dumpInstance->start($dumpDir);   
			return true;     	
        } catch (Exception $e){
        	debug($e);
			$this->dumpController->Notification->setFlash($e, 'error'); 
			return false;
        }
	}

	public function DumpDBBAll($file = ""){
		$settings = array('compress' => $this->dumpZipType);
		$dir = $this->dumpDirectory."All".DS;
		if($this->DumpBDD($settings, $dir.$this->dumpfile, $file)){
      		$this->dumpController->Cache->write("LastModDump", time(), $dir, true);
      		return true;
		} else 
			return false;
	}

	public function DumpImgDBB($file = ""){
		$settings = array('include-tables' => ['imgdumps'], 'compress' => $this->dumpZipType);
		$dir = $this->dumpDirectory."ImgDump".DS;
		if($this->DumpBDD($settings, $dir.$this->dumpfile, $file)){
      		$this->dumpController->Cache->write("LastModDump", time(), $dir, true);
      		return true;
		} else 
			return false;
	}

	public function DumpFiltered($file = ""){
		$settings = array('exclude-tables' => $this->excludeOrigin, 'compress' => $this->dumpZipType);
		$dir = $this->dumpDirectory."Regular".DS;
		if($this->DumpBDD($settings, $dir.$this->dumpfile, $file)){
      		$this->dumpController->Cache->write("LastModDump", time(), $dir, true);
      		return true;
		} else 
			return false;
	}

	public function DumpDefault($file = ""){
		$settings = $this->dumpSettings;
		$dir = $this->dumpDirectory."Regular".DS;
		if($this->DumpBDD($settings, $dir.$this->dumpfile, $file)){
      		$this->dumpController->Cache->write("LastModDump", time(), $dir, true);
      		return true;
		} else 
			return false;
	}

	public function DumpCustom($file = "", $settings){
		$dir = $this->dumpDirectory."Custom".DS;
		if($this->DumpBDD($settings, $dir.$this->dumpfile, $file)){
      		$this->dumpController->Cache->write("LastModDump", time(), $dir, true);
      		return true;
		} else 
			return false;
	}

	public function DumpLastModified($file = ""){
		// $lastMoImgBDD = $this->GetFileModTime($this->dumpDirectory."ImgDump".DS."LastModBDD");
		// $lastMoImgDump = $this->GetFileModTime($this->dumpDirectory."ImgDump".DS."LastModDump");

		// if((!$lastMoImgBDD && !$lastMoImgDump)){
		// 	return $this->DumpImgDBB($file);
		// } else if($lastMoImgBDD && $lastMoImgDump){
		// 	if($lastMoImgBDD > $lastMoImgDump)
		// 		return $this->DumpImgDBB($file);
		// 	else 
		// 		return false;
		// } else {
		// 	return $this->DumpImgDBB($file);
		// }

		$lastMoImgBDD = $this->GetFileModTime($this->dumpDirectory."Regular/LastModBDD");
		$lastMoImgDump = $this->GetFileModTime($this->dumpDirectory."Regular/LastModDump");

		debug($lastMoImgBDD, $this->dumpDirectory."Regular".DS."LastModBDD");
		debug($lastMoImgDump, $this->dumpDirectory."Regular".DS."LastModDump");

		if((!$lastMoImgBDD && !$lastMoImgDump)){
			return $this->DumpDefault($file);
		} else if($lastMoImgBDD && $lastMoImgDump){
			if($lastMoImgBDD > $lastMoImgDump)
				return $this->DumpDefault($file);
			else 
				return false;
		} else {
			return $this->DumpDefault($file);
		}
	}

} ?>