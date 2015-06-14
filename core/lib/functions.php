<?php 
spl_autoload_register(function ($class) {

  $lib = LIB.DS . $class . '.php';
  $config = CONF.DS . $class.'.php';
  $core = CORE.DS . $class . '.php';

  $paths = array($core, $lib, $config);
  foreach ($paths as &$filename) {
    if(file_exists($filename))
        require_once($filename) ;
  }
});

function debug($var, $varName = null){

	if(Conf::$debug>0){
		$debug = debug_backtrace(); 
		echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].' </strong> l.'.$debug[0]['line'].'</a></p>'; 
		echo '<ol style="display:none;">'; 
		foreach($debug as $k=>$v){ if($k>0){
			echo '<li><strong>'.$v['file'].' </strong> l.'.$v['line'].'</li>'; 
		}}
		echo '</ol>'; 
		echo '<pre>';
		echo isset($varName) ? "<strong><em>".$varName."</em></strong> ===> " : "";
		print_r($var);
		echo '</pre>'; 
	}
	
}

function isValidTimeStamp($timestamp)
{
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}

function noaccent($str){
    $str= htmlentities($str, ENT_NOQUOTES, 'utf-8');
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    return $str;
}

/**
* Fonction de ré-écriture des URLs
* @var string  $name   URL a re-ecrire
**/
function AutoLinks($strlink)
{
        $str = preg_replace('/\s/', '-', $strlink); // Remplace les espaces par des '-'.
  
        $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
  
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str); // Remplace les accents des caractères
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        $str = preg_replace('/([^\w\-]+)/i', '', $str); // Remplace les caractères spéciaux sauf les '-'
        $str = preg_replace('/([_])/i', '', $str); // Remplace les underscores
  
        $str = strtolower($str); // On écrit le tout en minuscule
  
        return $str;
}

/* Remplace caractères accentués d'une chaine */
/* Générateur de Slug (Friendly Url) : convertit un titre en une URL valide.*/
function makeSlug($string, $maxlen=200){
//cyrylic transcription
    $cyrylicFrom = array('?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
    $cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia'); 
  
    $from = array('Á', 'À', 'Â', 'Ä', '?', '?', 'Ã', 'Å', '?', 'Æ', '?', '?', '?', '?', 'Ç', '?', '?', 'Ð', 'É', 'È', '?', 'Ê', 'Ë', '?', '?', '?', '?', '?', '?', '?', '?', 'á', 'à', 'â', 'ä', '?', '?', 'ã', 'å', '?', 'æ', '?', '?', '?', '?', 'ç', '?', '?', 'ð', 'é', 'è', '?', 'ê', 'ë', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'I', 'Í', 'Ì', '?', 'Î', 'Ï', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Ñ', '?', 'Ó', 'Ò', 'Ô', 'Ö', 'Õ', '?', 'Ø', '?', 'Œ', '?', '?', '?', 'í', 'ì', 'i', 'î', 'ï', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'ñ', '?', 'ó', 'ò', 'ô', 'ö', 'õ', '?', 'ø', '?', 'œ', '?', '?', '?', '?', 'Š', '?', '?', '?', 'Þ', 'Ú', 'Ù', 'Û', 'Ü', '?', '?', '?', '?', '?', '?', '?', 'Ý', '?', 'Ÿ', '?', '?', 'Ž', '?', '?', '?', '?', 'š', '?', 'ß', '?', '?', 'þ', 'ú', 'ù', 'û', 'ü', '?', '?', '?', '?', '?', '?', '?', 'ý', '?', 'ÿ', '?', '?', 'ž');
    $to   = array('A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'C', 'C', 'C', 'C', 'D', 'D', 'D', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'G', 'G', 'G', 'G', 'G', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'H', 'H', 'I', 'I', 'I', 'I', 'I', 'I', 'I', 'I', 'IJ', 'J', 'K', 'L', 'L', 'N', 'N', 'N', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'CE', 'h', 'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'ij', 'j', 'k', 'l', 'l', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'R', 'R', 'S', 'S', 'S', 'S', 'T', 'T', 'T', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'W', 'Y', 'Y', 'Y', 'Z', 'Z', 'Z', 'r', 'r', 's', 's', 's', 's', 'B', 't', 't', 'b', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'y', 'y', 'y', 'z', 'z', 'z');
    $numbers=array('0','1','2','3','4','5','6','7','8','9','-');
    $from = array_merge($from, $cyrylicFrom);
    $to   = array_merge($to, $cyrylicTo);   
    $newstring=strtolower(str_replace($from, $to, trim($string))); 
    $newstring=str_replace(' ', '-', $newstring); 
    $newStringTab=array();
    if(function_exists('str_split'))
    {
        $stringTab=str_split($newstring);
    }
    else
    {
      $slen=strlen($newstring);
      for($i=0; $i<$slen; $i++)
      {
         $stringTab[$i]=$newstring{$i};
      }
    }
    foreach($stringTab as $letter)
    {
       if(in_array($letter, range('a', 'z')) || in_array($letter, $numbers))
       {
          $newStringTab[]=$letter;
       }
    }
    if(count($newStringTab))
    {
      $newString=implode($newStringTab);
      if($maxlen>0)
      {
        $newString=substr($newString, 0, $maxlen);
      }
      $i=0;
      do{
        $newString = str_replace('--', '-', $newString);       
        $pos=strpos($newString, '--');
        $i++;
        if($i>100)
        {
          die('remove duplicates \'--\' loop error');
        }
          
      }while($pos!==false); 
    }
    else
    {
       $newString='';
    }      
       
      return $newString;   
}

function generateRandomString($length = 20) {
  return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

/**
 * Create a web friendly URL slug from a string.
 * 
 * Although supported, transliteration is discouraged because
 *     1) most web browsers support UTF-8 characters in URLs
 *     2) transliteration causes a loss of information
 *
 * @author Sean Murphy <sean@iamseanmurphy.com>
 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
 * @license http://creativecommons.org/publicdomain/zero/1.0/
 *
 * @param string $str
 * @param array $options
 * @return string
 */
function url_slug($str, $options = array()) {
  // Make sure string is in UTF-8 and strip invalid UTF-8 characters
  $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
  
  $defaults = array(
    'delimiter' => '-',
    'limit' => null,
    'lowercase' => true,
    'replacements' => array(),
    'transliterate' => false,
  );
  
  // Merge options
  $options = array_merge($defaults, $options);
  
  $char_map = array(
    // Latin
    'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
    'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
    'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
    'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
    'ß' => 'ss', 
    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
    'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
    'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
    'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
    'ÿ' => 'y',

    // Latin symbols
    '©' => '(c)',

    // Greek
    'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
    'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
    'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
    'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
    'Ϋ' => 'Y',
    'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
    'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
    'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
    'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
    'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

    // Turkish
    'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
    'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

    // Russian
    'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
    'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
    'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
    'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
    'Я' => 'Ya',
    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
    'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
    'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
    'я' => 'ya',

    // Ukrainian
    'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
    'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

    // Czech
    'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
    'Ž' => 'Z', 
    'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
    'ž' => 'z', 

    // Polish
    'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
    'Ż' => 'Z', 
    'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
    'ż' => 'z',

    // Latvian
    'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
    'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
    'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
    'š' => 's', 'ū' => 'u', 'ž' => 'z'
  );
  
  // Make custom replacements
  $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
  
  // Transliterate characters to ASCII
  if ($options['transliterate']) {
    $str = str_replace(array_keys($char_map), $char_map, $str);
  }
  
  // Replace non-alphanumeric characters with our delimiter
  $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
  
  // Remove duplicate delimiters
  $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
  
  // Truncate slug to max. characters
  $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
  
  // Remove delimiter from ends
  $str = trim($str, $options['delimiter']);
  
  return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}


/*Create  Directory Tree if none exists
If you are passing a path with a filename on the end, pass true as the second parameter to snip it off */
function MakePath($pathname, $is_filename=false){

  if($is_filename){

      $pathname = substr($pathname, 0, strrpos($pathname, '/'));

  }

    // Check if directory already exists

    if (is_dir($pathname) || empty($pathname)) {

        return true;

    }

    // Ensure a file does not already exist with the same name

    $pathname = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $pathname);

    if (is_file($pathname)) {

        trigger_error('mkdirr() File exists', E_USER_WARNING);

        return false;

    }

    // Crawl up the directory tree
     
    $pathtree = explode(DIRECTORY_SEPARATOR, $pathname);
    $curPath = "";

    for ($i=0; $i < count($pathtree); $i++) { 
      if($curPath != ""){
        $curPath = $curPath.DIRECTORY_SEPARATOR.$pathtree[$i];
      } else{
        $curPath = $pathtree[$i];
      }

      if(!is_dir($curPath)){
        mkdir($curPath);
      }
    }

    return true;

}

function curPageURL($onlyUri = false) {
  $pageURL = 'http';
  if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]== "on") {$pageURL .= "s";}
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }

  if($onlyUri)
    $pageURL = $_SERVER["REQUEST_URI"];
  return $pageURL;
}

function curPageName() {
  return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function randomColor ($lightColor = true, $minVal = 0, $maxVal = 255)
{
  if($lightColor){
    $minVal = 150;
    $maxVal = 255;
  } else {
    $minVal = 0;
    $maxVal = 100;
  }

    // Make sure the parameters will result in valid colours
    $minVal = $minVal < 0 || $minVal > 255 ? 0 : $minVal;
    $maxVal = $maxVal < 0 || $maxVal > 255 ? 255 : $maxVal;

    // Generate 3 values
    $r = mt_rand($minVal, $maxVal);
    $g = mt_rand($minVal, $maxVal);
    $b = mt_rand($minVal, $maxVal);

    // Return a hex colour ID string
    return sprintf('#%02X%02X%02X', $r, $g, $b);

}


function InsertAfter($arr, $keyToFind, $addArray){
    $keys = array_keys($arr);
    $spot = array_search($keyToFind, $keys);
    $chunks = array_chunk($arr, ($spot+1));
    array_unshift($chunks[1], array($addKey=>$addValue));
    $arr = call_User_Func_Array('array_Merge', $chunks);
    return $arr;
}

function RandAlbumImgs($input, $output){
  $randImg = rand(0,(count($input)-1));
  if(!in_array($randImg, $output)){
    return intval($randImg);
  } else {
    return RandAlbumImgs($input, $output);
  }
}

function changeToHHTPS(){
  if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
      if(!headers_sent()) {
          header("Status: 301 Moved Permanently");
          header(sprintf(
              'Location: https://%s%s',
              $_SERVER['HTTP_HOST'],
              $_SERVER['REQUEST_URI']
          ));
          exit();
      }
  }
}

function forceHTTPS(){
  $httpsURL = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  if( count( $_POST )>0 )
    die( 'Page should be accessed with HTTPS, but a POST Submission has been sent here. Adjust the form to point to '.$httpsURL );
  if( !isset( $_SERVER['HTTPS'] ) || $_SERVER['HTTPS']!=='on' ){
    if( !headers_sent() ){
      header( "Status: 301 Moved Permanently" );
      header( "Location: $httpsURL" );
      exit();
    }else{
      die( '<script type="javascript">document.location.href="'.$httpsURL.'";</script>' );
    }
  }
}