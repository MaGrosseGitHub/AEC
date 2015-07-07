<?php
class Language {

	public static $curLang = "";

	private $available_languages = array("en", "fr");

	private $langs = array();

	function __construct(){
		if(!Cookies::CheckCookie("lang")){
			$this->langs = $this->PreferedLanguage($this->available_languages, $_SERVER["HTTP_ACCEPT_LANGUAGE"]);

			if(!empty($this->langs))
				Language::$curLang = array_keys($this->langs)[0]; //get first element from language array
			else
				Language::$curLang = $this->available_languages[0];

			Cookies::write("lang", language::$curLang);
		} else {
			Language::$curLang = Cookies::read("lang");
		}
	}

	public function ChangeLanguage($lang){
		if(is_string($lang) && in_array($lang, $this->available_languages)){
			if(Language::$curLang == $lang)
				return true;
			else {
				Language::$curLang = $langs;
				Cookies::write("lang", language::$curLang);
			}
		}
	}


	private function PreferedLanguage(array $available_languages, $http_accept_language) {

	    $available_languages = array_flip($available_languages);

	    $langs;
	    preg_match_all('~([\w-]+)(?:[^,\d]+([\d.]+))?~', strtolower($http_accept_language), $matches, PREG_SET_ORDER);
	    foreach($matches as $match) {

	        list($a, $b) = explode('-', $match[1]) + array('', '');
	        $value = isset($match[2]) ? (float) $match[2] : 1.0;

	        if(isset($available_languages[$match[1]])) {
	            $langs[$match[1]] = $value;
	            continue;
	        }

	        if(isset($available_languages[$a])) {
	            $langs[$a] = $value - 0.1;
	        }

	    }
	    arsort($langs);

	    return $langs;
	}
}