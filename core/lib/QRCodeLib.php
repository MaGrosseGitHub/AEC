<?php
class QRCodeLib{

	private static $pathToLib;

	static protected function init() {
    	self::$pathToLib  = LIB.DS."phpqrcode/qrlib.php";
      	require_once self::$pathToLib;
  	}

	public static function GenerateQRCode(){
      	self::init();
      	$test = realpath("img/galerie/test/");

      	$dataText = "http://localhost/AEC/webroot/cockpit/posts/test/";
	    $svgTagId   = 'id-of-svg';
	    $saveToFile = '203_demo.svg';
	    
      	// $test = $test."/svgqr.svg";
      	// debug($test);
	    // it is saved to file but also returned from function
	    // return QRcode::svg($dataText, $svgTagId, false, QR_ECLEVEL_H, 300, 0, true);

      	// $test = $test."/test2.png";
		QRcode::png($dataText, $test."/test2.png", "H", 10, 0, false, 0x000, 0xc0392b);
		QRcode::png($dataText, $test."/test3.png", "H", 10, 0, false, 0xc0392b, 0x000);
	}

}
?>