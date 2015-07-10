<?php 
$debut = microtime(true); 
define('WEBROOT',dirname(__FILE__)); 
define('ROOT',dirname(WEBROOT)); 
define('DS',DIRECTORY_SEPARATOR); 
define('CONF',ROOT.DS.'config'); 
define('CORE',ROOT.DS.'core'); 
define('LIB',ROOT.DS.'core'.DS.'lib'); 
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])).'/webroot'); 
// define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME']))); 
// define('BASE_URL','http://localhost/POO3'); 

// #DocumentRoot "K:/wamp/www/POO3/"
// <Directory "K:/wamp/www/POO3">
//     Options All
//     AllowOverride All
//     order allow,deny
//     allow from all

// </Directory>  

// require CORE.DS.'includes.php'; 
require LIB.DS.'functions.php'; //contains an autoloader for all the important classes and multiple useful global functions

new Language();
new Dispatcher("/AEC/webroot/");

global $title_for_layout;
?>
<!-- <h1>TEST</h1> -->
<!-- <div style="position:fixed;bottom:0; background:#900; color:#FFF; line-height:30px; height:30px; left:0; right:0; padding-left:10px; ">
<?php 
	echo 'Page générée en '. round(microtime(true) - $debut,5).' secondes'; 
?>
</div> -->
