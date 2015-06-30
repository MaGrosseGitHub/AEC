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
	    
      	$tests = $test."\\svgqr.svg";
      	// debug($test);
	    // it is saved to file but also returned from function
	 //    QRcode::svg($dataText, $svgTagId, "img/galerie/test/".$saveToFile, QR_ECLEVEL_H, 300, 0, true);

  //     	// $testp = $test."/test2.png";
		// QRcode::png($dataText, $test."/test2.png", "H", 10, 5, false, 0x000, 0xc0392b);
		// QRcode::png($dataText, $test."/test3.png", "H", 10, 5, false, 0xc0392b, 0x000);
		// QRcode::png($dataText, $test."/test4.png", "H", 10, 5, false, 0xFFFFFF, 0xc0392b);

		// $tempDir = EXAMPLE_TMP_SERVERPATH;
	    
	    // it is saved to file but also returned from function
	    // $svgCode = QRcode::svg($dataText, $tests);
	    // debug(strlen($svgCode));
	    QRcode::svg($dataText, $test."\\svgqr1.svg", QR_ECLEVEL_H, 300, 5, false, 0x000, 0xc0392b);
	    QRcode::svg($dataText, $test."\\svgqr2.svg", QR_ECLEVEL_H, 300, 5, false, 0xc0392b, 0x000);
	    QRcode::svg($dataText, $test."\\svgqr3.svg", QR_ECLEVEL_H, 300, 5, false, 0xFFFFFF, 0xc0392b);
	    // $svgCodeFromFile = file_get_contents($tests);

	    // // tag output
	    // echo $svgCodeFromFile;
	    // echo '<br/>';
	    
	    // // we print code
	    // echo '<span style="font-family: monospace, Courier, Courier New;font-size: 8pt">';
	    // echo self::xml_highlight($svgCodeFromFile);
	    // echo '</span>';
	}

	    
    // taken from: http://php.net/manual/en/function.highlight-string.php by: Dobromir Velev
    static function xml_highlight($s){
        $s = preg_replace("|<([^/?])(.*)\s(.*)>|isU", "[1]<[2]\\1\\2[/2] [5]\\3[/5]>[/1]", $s);
        $s = preg_replace("|</(.*)>|isU", "[1]</[2]\\1[/2]>[/1]", $s);
        $s = preg_replace("|<\?(.*)\?>|isU","[3]<?\\1?>[/3]", $s);
        $s = preg_replace("|\=\"(.*)\"|isU", "[6]=[/6][4]\"\\1\"[/4]",$s);
        $s = htmlspecialchars($s);
        $s = str_replace("\t","&nbsp;&nbsp;",$s);
        $s = str_replace(" ","&nbsp;",$s);
        $replace = array(1=>'0000FF', 2=>'0000FF', 3=>'800000', 4=>'00AA00', 5=>'FF0000', 6=>'0000FF');
        foreach($replace as $k=>$v) {
            $s = preg_replace("|\[".$k."\](.*)\[/".$k."\]|isU", "<font color=\"#".$v."\">\\1</font>", $s);
        }
        return nl2br($s);
    }
}
?>