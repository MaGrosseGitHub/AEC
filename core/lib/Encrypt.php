<?php 
class Encrypt{

	protected $encryptionKey;
	protected $ivKey;
	protected $data = array();

	function __construct() {
		$this->encryptKey();
		$this->encryptIv();
	}

	protected function encryptKey() {
		$key_size = mcrypt_get_key_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CFB);
		$encryption_key = openssl_random_pseudo_bytes($key_size, $strong);

		$this->encryptionKey = $encryption_key;
	}

	protected function encryptIv() {
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CFB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM); // 16 bytes output

		$this->ivKey = $iv;
	}

	public function encryptData($data,$serialize = null) {
		$newEncryptedData = array();	
		foreach($data as $name=>$valueToEncrypt){
			$valueToEncrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->encryptionKey, $valueToEncrypt, MCRYPT_MODE_CFB, $this->ivKey);
			$valueToEncrypt = bin2hex($valueToEncrypt);
			$valueToEncrypt = base64_encode($valueToEncrypt);
			$newEncryptedData[$name] = $valueToEncrypt;
		}

		$iv = bin2hex($this->ivKey);
		$iv = base64_encode($iv);
		$newEncryptedData['iv'] = $iv;

		$encryptionKey = bin2hex($this->encryptionKey);
		$encryptionKey = base64_encode($encryptionKey);
		$newEncryptedData['ek'] = $encryptionKey;

		if(isset($serialize) && $serialize) {
			$newEncryptedData = serialize($newEncryptedData);
			$newEncryptedData = bin2hex($newEncryptedData);
			$newEncryptedData = base64_encode($newEncryptedData);
		}
		$this->data = $newEncryptedData;
		return $this->data;
	}

	public static function decryptData($data,$serialize = null) {
		if(isset($serialize) && $serialize) {
			$data = base64_decode($data);
			$data = hex2bin($data);
			$data = unserialize($data);
		}
		$iv = $data['iv'];	
		$iv = base64_decode($iv);
		$iv = hex2bin($iv);

		$encryptionKey = $data['ek'];	
		$encryptionKey = base64_decode($encryptionKey);
		$encryptionKey = hex2bin($encryptionKey);

		$DecryptedData = array();
		foreach($data as $name=>$valueToDecrypt){
			if($name != "iv" && $name != "ek") {
				$valueToDecrypt = base64_decode($valueToDecrypt);
				$valueToDecrypt = hex2bin($valueToDecrypt);
				$valueToDecrypt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $encryptionKey, $valueToDecrypt, MCRYPT_MODE_CFB, $iv);
				$DecryptedData[$name] = $valueToDecrypt;
			}		
		}

		return $DecryptedData;
	}

}