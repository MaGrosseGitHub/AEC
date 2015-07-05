<?php
class HTML{	

	static function JS($url,$customUrl = null){
		trim($url,'/');
		if(isset($customUrl) && $customUrl) {
			$newUrl = BASE_URL.'/js/'.$url; 
			return $newUrl;
		}
		$newUrl = BASE_URL.'/js/'.$url; 
		if(!preg_match("#^http|https|//#", $url) || !preg_match("#//#", $url)){
			$newUrl = $newUrl.'.js';
		} else {
			$newUrl = $url;
		}

		$newUrl = '<script type="text/javascript" src="'.$newUrl.'"></script>';
		return $newUrl;
	}

	static function CSS($url,$customUrl = null,$customType = null){
		trim($url,'/');
		$newUrl = BASE_URL.'/css/'.$url; 
		if($customUrl) {
			$newUrl = $url;
			if(isset($customType) && $customType == "JS") {
				$newUrl = HTML::JS($url, true);
			} 
		}
		if(!preg_match("#^http#", $url) || !preg_match("#^//#", $url)){
			$newUrl = $newUrl.'.css';	
		}
		$newUrl = '<link rel="stylesheet" type="text/css" href="'.$newUrl.'">';
		return $newUrl;
	}

	static function getImg($url,$css = null,$custom = null, $options = null, $notExistImg = false, $customDir = false){
		$distant = false;
		trim($url,'/');
		$filename = pathinfo($url)['filename'];
		if($css)
			$imgPath = "css/img/";
		else
			$imgPath = "img/";
		if($customDir)
			$imgPath = "";
		if(!isset($options) && !empty($options)) {
			$options = "";
		}
		$options .='alt = "'.$filename.'"';
		if(!preg_match("#^http|https#", $url) || !preg_match("#//#", $url))
			$newUrl = Router::webroot($imgPath.$url);
		else {
			$distant = true;
			$newUrl = $url;
		}
		if(file_exists($imgPath.$url) || $distant) {
			if(!$custom) {
				$newUrl = '<img src="'.$newUrl.'" '.$options.'>';
			} 
			return $newUrl;
		} else {
			if($notExistImg){
				$newUrl = Router::webroot("css/img/noPic.png");
				if(!$custom) {
					$newUrl = '<img src="'.$newUrl.'" '.$options.'>';
				} 
				return $newUrl;
			} else {
				if(Images::GetImgBDD($newUrl)){					
					$newUrl = '<img src="'.$newUrl.'" '.$options.'>';
					return $newUrl;
				} else {
					$newUrl = Router::webroot("css/img/noPic.png");
					if(!$custom) {
						$newUrl = '<img src="'.$newUrl.'" '.$options.'>';
					} 
					return $newUrl;
				}
				return false;
			}
		}
	}

}