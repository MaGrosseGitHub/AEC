<?php
class Dump{

	public $conf = "default";
	public $compress = true;

	public $excludeFromDump = array(); //user defined exclude
	public $includeOnlyInDump = array(); //user defined include

	const ALL = 0;
	const IMG = 1;
	const BASIC = 2;
	const FILTERED = 3;
	const CUSTOM = 5;

	private $host;
	private $dbb;
	private $login;
	private $password;

	private $dumpDirectory;
	private $dumpfile;
	private $dumpDirectories = array();

	private $dumpController = NULL;
	private $dumpModel = false;

	private $dumpInstance;
	private $dumpSettings;
	private $exclude = ['imgdumps', 'events', 'mapinfos', 'maps', 'participates', 'sites'];
	private $excludeOrigin = array();
	private $include = array();
	private $dumpZipType; //Mysqldump::GZIP, Mysqldump::BZIP2 or Mysqldump::NONE
	private $availableZipTypes = [Mysqldump::GZIP, Mysqldump::BZIP2, Mysqldump::NONE];

	private $tableList;
	private $filteredTableList;
	private $excludedTableList;

	//if !checkPrecise then the check for last time the BDD was modified for "all" "custom" "filtered" and "basic" tasks 
	//will be done by checking the lastmodbdd file in the unpreciseDir variable
	public $checkPrecise = false; 
	public $unpreciseDir = "tmp/Dumps/BDD";


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
		// if(!isset($params['noExcludes']) || !$params['noExcludes'])
		// 	$this->dumpSettings['exclude-tables'] = $this->excludedTableList; 
		if(isset($params['noExcludes']) && $params['noExcludes']) // exclude-tables : Exclude these tables (array of table names)
			if(isset($this->dumpSettings['exclude-tables']))
				unset($this->dumpSettings['exclude-tables']);
		if(isset($params['includes']) && $params['includes'])
			$this->dumpSettings['include-tables'] = $this->include; // include-tables : Only include these tables (array of table names)

		if(isset($params['zipType']) && !empty($params['zipType']) && in_array($params['zipType'], $this->availableZipTypes))
			$this->dumpZipType = $params['zipType'];
		else
			$this->dumpZipType = Mysqldump::GZIP;
		if(!isset($params['compress']) || (isset($params['compress']) && $params['compress']))
			$this->dumpSettings['compress'] = $this->dumpZipType;

		$unpreciseDir = Cache::DUMP."/BDD/";

		$this->dumpDirectory = Cache::DUMP."/";
		MakePath($this->dumpDirectory);
		$this->dumpfile = $this->dbb;
		$this->AssignDumpDirectories();
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
		$this->tableList = $this->GetListOfALLTables();
		$this->include =  array_unique(array_merge($this->include,$this->includeOnlyInDump), SORT_REGULAR);
		$filterResult = $this->GetFilteredLists();
		$this->filteredTableList = $filterResult[0];
		$this->excludedTableList = $filterResult[1];
	}

	private function GetListOfALLTables(){
		$this->LaunchController();
		$alltables = $this->dumpController->ImgDump->db->query("SHOW TABLES",PDO::FETCH_NUM);

		$tableList = array();
		while($result=$alltables->fetch()){
			array_push($tableList, $result[0]);
		}
		return $tableList;
	}

	private function GetFilteredLists(){
		$this->LaunchController();
		$alltables = $this->dumpController->ImgDump->db->query("SHOW TABLES",PDO::FETCH_NUM);

		$filters = array_unique(array_merge($this->exclude,$this->excludeFromDump), SORT_REGULAR);

		$tableListFiltered = array();
		$tableListExcluded = array();
		while($result =$alltables->fetch()){
			if(!in_array($result[0], $filters))
				array_push($tableListFiltered, $result[0]);
			else
				array_push($tableListExcluded, $result[0]);
		}
		return array($tableListFiltered,$tableListExcluded);
	}

	private function FormatFileName($name){
		$date = date("Y-m-d__h-i-s");
		return $date.'_'.$name.'.sql';
	}

	private function GetFileModTime($file, $create = false){
		if (file_exists($file)) {
		    return filemtime($file);
		} else {
			if($create){
				$this->CreateFileMod($file);
				$this->GetFileModTime($file);
			} else
				return false;
		}
	}

	private function CreateFileMod($file){
		if (!file_exists($file)) {
			$fileInfo = pathinfo($file);
      		$this->dumpController->Cache->write($fileInfo['basename'], time(), $fileInfo['dirname'], true);
		    return true;
		} else {
			return true;
		}
	}

	private function AssignDumpDirectories(){
		$this->dumpDirectories[Dump::ALL] = $this->dumpDirectory."All".DS;
		$this->dumpDirectories[Dump::IMG] = $this->dumpDirectory."ImgDump".DS;
		$this->dumpDirectories[Dump::FILTERED] = $this->dumpDirectory."Regular".DS;
		$this->dumpDirectories[Dump::BASIC] = $this->dumpDirectory."Regular".DS;
		$this->dumpDirectories[Dump::CUSTOM] = $this->dumpDirectory."Custom".DS;
	}

	private function DumpBDDInternal($dumpSettings, $dumpDir, $file = ""){

        $this->dumpInstance = new Mysqldump($this->dbb, $this->login, $this->password, $this->host, 'mysql', $dumpSettings);
        $fileInfo = pathinfo($dumpDir);
        if(!file_exists($fileInfo['dirname']))
        	MakePath($fileInfo['dirname']);

        try {
			if($file != "")
				$dumpDir = $file;
			MakePath($dumpDir, true);
			$this->dumpInstance->start($dumpDir);   
			return true;     	
        } catch (Exception $e){
			$this->dumpController->Notification->setFlash($e, 'error'); 
			return false;
        }
	}

	public function DumpBDD($type, $file = "", $settings = array()){
		switch ($type) {
			case Dump::ALL:
				$addeName = "_ALL";
				$settingsBDD = array('compress' => $this->dumpZipType);
				break;

			case Dump::IMG:
				$addeName = "_IMG";
				$settingsBDD = array('include-tables' => ['imgdumps'], 'compress' => $this->dumpZipType);
				break;

			case Dump::FILTERED:
				$addeName = "_FILTERED";
				$settingsBDD = array('exclude-tables' => $this->excludeOrigin, 'compress' => $this->dumpZipType);
				break;

			case Dump::BASIC:
				$addeName = "_BASIC";
				$settingsBDD = $this->dumpSettings;
				break;

			case Dump::CUSTOM:
				$addeName = "_CUSTOM";
				if(isset($settings) && empty($settings))
					$settingsBDD = $settings;
				else
					$settingsBDD = $this->dumpSettings;
				break;
			
			default:
				return false;
				break;
		}
		$fileName = $this->FormatFileName($this->dumpfile.$addeName);
		if($this->DumpBDDInternal($settingsBDD, $this->dumpDirectories[$type].$fileName, $file)){
      		$this->dumpController->Cache->write("LastModDump", time(), $this->dumpDirectories[$type], true);
      		return true;
		} else 
			return false;
	}	
	
	public function DumpLastModified($type, $file = "", $settings = array()){
		if($this->checkPrecise || $type == Dump::IMG)
			$lastMoBDD = $this->GetFileModTime($this->dumpDirectories[$type]."LastModBDD", true);
		else {
			$lastMoBDD = $this->GetFileModTime($this->unpreciseDir.DS."LastModBDD", true);
			MakePath($this->dumpDirectories[$type]);
			copy($this->unpreciseDir.DS."LastModBDD", $this->dumpDirectories[$type]."LastModBDD");
		}
		$lastMoDump = $this->GetFileModTime($this->dumpDirectories[$type]."LastModDump", true);

		if((!$lastMoBDD && !$lastMoDump)){
			return $this->DumpBDD($type, $file, $settings);
		} else if($lastMoBDD && $lastMoDump){
			if($lastMoBDD > $lastMoDump)
				return $this->DumpBDD($type, $file, $settings);
			else 
				return true;
		} else {
			return $this->DumpBDD($type, $file, $settings);
		}
	}

	public function DumpListBasic($list = array(), $function){
		foreach ($list as $task => $taskInfo) {
			$type = $taskInfo['type'];
			if(isset($taskInfo['file']))
				$file = $taskInfo['file'];
			else
				$file = "";
			if(isset($taskInfo['settings']))
				$settings = $taskInfo['settings'];
			else
				$settings = array();

			$result = $this->$function($type, $file, $settings);
			$notifText = "Dump ".$type.' ';
			$notifText .= ($result)?'réussi':'échoué';
			$this->dumpController->Notification->setFlash($notifText, ($result)?'success':'error');
		}
	}
	
	public function DumpList($list = array()){
		$function = 'DumpBDD';
		$this->DumpListBasic($list, $function);
	}

	public function DumpLastModifiedList($list = array()){
		$function = 'DumpLastModified';
		$this->DumpListBasic($list, $function);
	}

} ?>