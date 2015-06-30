<?php
class FTP{

	public $conf = "default";
	private $host;
	private $login;
	private $password;

	private $connexion;

	protected $_data = array(
        'connected' => false
    );

    public function __get($name) {
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        } else {
            // non-existant property
            // => up to you to decide what to do
        }
    }

    public function __set($name, $value) {
        if (array_key_exists($name, $this->_data)) {
            throw new Exception("not allowed : $name");
        } else {
            $name = $value;
        }
    }

	function __construct($controller, $params = array()){
		$this->dumpController = $controller;

		$conf = Conf::$FTPs[$this->conf];
		if(!empty($params['confInfo'])){
			foreach ($params['confInfo'] as $confKey => $confVal) {
				if(!empty($confVal) && isset($conf[$confKey])){
					$conf[$confKey] = $confVal;
				}
			}
		}
		$this->host = $conf['host'];
		$this->login = $conf['login'];
		$this->password = $conf['password'];

		$this->connect();
	}

	private function connect(){
		$this->connexion = ftp_connect($this->host);
		$login = ftp_login($this->connexion,$this->login,$this->password);	
		if ((!$this->connexion) || (!$login)) {
			$this->dumpController->Notification->setFlash( 'FTP connection has failed! Attempted to connect to '. $this->host. ' for user '.$this->login.'.', 'error'); 
			$this->_data['connected'] = false;
		}else{
			$this->_data['connected'] = true;
		}
	}

	public function GetFilesList($dir = ""){
		if($this->_data['connected'])
			return ftp_nlist($this->connexion,$dir);
		else
			return false;
	}

	public function UploadFile($localfile, $remotefile, $mode = FTP_BINARY){
		if($this->_data['connected'])
			return ftp_put($this->connexion, $remotefile, $localfile, $mode);
		else
			return false;
	}

	public function DownloadFile($localfile, $remotefile, $mode = FTP_BINARY){	
		$fp = fopen($localfile,"w");	
		if($this->_data['connected'])
			return ftp_fget($this->connexion, $fp, $remotefile, $mode, 0);
		else
			return false;
	}

	public function Close(){
		if($this->_data['connected'])
			ftp_close($this->connexion);
	}
}
?>