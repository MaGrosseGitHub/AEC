<?php
class QRCodeLib{

	private static $pathToLib;
	private static $qrDir;
	private static $qrSize = 510;
	private static $qrLogo = "img/logo/logo.png";

	static protected function init() {
    	self::$pathToLib  = LIB.DS."phpqrcode/qrlib.php";
      	require_once self::$pathToLib;
  	}

	private static function AddLogo($QR, $logo = ''){
		if(empty($logo))
			$logo = self::$qrLogo;
		$dir = $QR;;
		if($logo !== FALSE){
			$logo = imagecreatefrompng($logo);
			imagealphablending( $logo, false );
			imagesavealpha( $logo, true );
			$QR = imagecreatefrompng($QR); 
			imagealphablending( $QR, false );
			imagesavealpha( $QR, true );

			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			
			$logo_width = imagesx($logo);
			$logo_height = imagesy($logo);
			
			// Scale logo to fit in the QR Code
			$logo_qr_width = $QR_width/2.5;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;
			
			imagecopyresampled($QR, $logo, $QR_width/3.25, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
		}
		imagepng($QR, $dir);
		imagedestroy($QR);
	}

	public static function GenerateQRCodes($link, $dir, $foreground = 0x000, $background = 0xFFFFFF, $transparent = false, $addLogo = 'true', $logoPath = ''){
		// QRCodeLib::QRPng($link, $dir, $foreground, $background, $transparent, $addLogo, $logoPath);
		// debug(pathinfo($dir));
		QRCodeLib::QRPdf($link, $dir, $foreground, $background, $transparent, $addLogo, $logoPath, false, false); //Also Generates PNGs
		QRCodeLib::QRSvg($link, $dir, $foreground, $background, false);
		MakePath(pathinfo($dir)['dirname'].'/QR CODES/');
		rename(pathinfo($dir)['dirname'].DS.'QR PNG/', pathinfo($dir)['dirname'].'/QR CODES/'.'QR PNG/');
		rename(pathinfo($dir)['dirname'].DS.'QR SVG/', pathinfo($dir)['dirname'].'/QR CODES/'.'QR SVG/');
		rename(pathinfo($dir)['dirname'].DS.'QR PDF/', pathinfo($dir)['dirname'].'/QR CODES/'.'QR PDF/');
		$zip = new ZipLib();
		$zip->compress(pathinfo($dir)['dirname'].'/QR CODES/', pathinfo($dir)['dirname']);
		rrmdir(pathinfo($dir)['dirname'].'/QR CODES/');
	}

	public static function QRPng($link, $dir, $foreground = 0x000, $background = 0xFFFFFF, $transparent = false, $addLogo = 'true', $logoPath = '', $compress = true){
      	self::init();
      	$pathInfo = pathinfo($dir);
      	$qrName = $pathInfo['basename'];
      	$pathRelativ = $pathInfo['dirname'];
      	$qrPath = realpath($pathInfo['dirname']);
      	$foreground = stringToColorCode($foreground);
      	$background = stringToColorCode($background);

      	$qrList = array(
      					array('name' => 'BlackandRed', 'foreground' => 0x000, 'background' => 0xc0392b, 'transparent' => false),
      					array('name' => 'RedandBlack', 'foreground' => 0xc0392b, 'background' => 0x000, 'transparent' => false),
      					array('name' => 'WhiteandRed', 'foreground' => 0xFFFFFF, 'background' => 0xc0392b, 'transparent' => false),
      					array('name' => 'WhiteandBlack', 'foreground' => 0xFFFFFF, 'background' => 0x000, 'transparent' => false),
      					array('name' => 'transparentAndRed', 'foreground' => 0xFFFFFF, 'background' => 0xc0392b, 'transparent' => true),
      					array('name' => 'transparentAndBlack', 'foreground' => 0xFFFFFF, 'background' => 0x000, 'transparent' => true),
      					array('name' => 'transparentAndWhite', 'foreground' => 0xFFFFFF, 'background' => 0xFFFFFF, 'transparent' => true),
      					array('name' => 'Custom', 'foreground' => $foreground, 'background' => $background, 'transparent' => $transparent)
      				);

      	$qrPath .="/QR PNG/";
      	if(!file_exists($qrPath))
      		MakePath($qrPath);

		$qrcodes = array();
      	foreach ($qrList as $qrsettings => $options) {
			$qr = QRcode::png($link, $qrPath."/".$qrName."_".$options['name'].".png", QR_ECLEVEL_H, 10, 5, false, $options['foreground'], $options['background'], $options['transparent']);
			if($addLogo){
				if(empty($qr))
					$qr = $qrPath."/".$qrName."_".$options['name'].".png";
				if(!empty($logoPath))
					self::AddLogo($qr, $logoPath);
				else
					self::AddLogo($qr);
			}
			array_push($qrcodes, $pathRelativ."/QR PNG/".$qrName."_".$options['name'].".png");
      	}
		if($compress){
	      	$zip = new ZipLib();
	      	$zip->compress($qrPath, $pathRelativ);			
		}

      	return $qrcodes;
	}

	public static function QRSvg($link, $dir, $foreground = 0x000, $background = 0xFFFFFF, $compress = true){
      	self::init();
      	$pathInfo = pathinfo($dir);
      	$qrName = $pathInfo['basename'];
      	$pathRelativ = $pathInfo['dirname'];
      	$qrPath = realpath($pathInfo['dirname']);
      	$foreground = stringToColorCode($foreground);
      	$background = stringToColorCode($background);

      	$qrList = array(
      					array('name' => 'BlackandRed', 'foreground' => 0x000, 'background' => 0xc0392b),
      					array('name' => 'RedandBlack', 'foreground' => 0xc0392b, 'background' => 0x000),
      					array('name' => 'WhiteandRed', 'foreground' => 0xFFFFFF, 'background' => 0xc0392b),
      					array('name' => 'WhiteandBlack', 'foreground' => 0xFFFFFF, 'background' => 0x000),
      					array('name' => 'Custom', 'foreground' => $foreground, 'background' => $background)
      				);

      	$qrPath .="/QR SVG/";
      	if(!file_exists($qrPath))
      		MakePath($qrPath);

		$qrcodes = array();
      	foreach ($qrList as $qrsettings => $options) {
			$qr = QRcode::svg($link, $qrPath.$qrName."_".$options['name'].".svg", QR_ECLEVEL_H, self::$qrSize, 5, false, $options['foreground'], $options['background']);
			array_push($qrcodes, $pathRelativ."/QR SVG/".$qrName."_".$options['name'].".png");
		}
		if($compress){
	      	$zip = new ZipLib();
	      	$zip->compress($qrPath, $pathRelativ);			
		}

      	return $qrcodes;
	}

	public static function QRPdf($link, $dir, $foreground = 0x000, $background = 0xFFFFFF, $transparent = false, $addLogo = 'true', $logoPath = '', $deletePngAfter = true, $compress = true){
		$qrList = QRCodeLib::QRPng($link, $dir, $foreground, $background, $transparent, $addLogo, $logoPath, $compress);

      	foreach ($qrList as $qr) {
      		$fileInfo = pathinfo($qr);
      		$filename = $fileInfo['dirname'].'/'.$fileInfo['filename'].'.pdf';
      		$filename = str_replace("PNG", "PDF", $filename);
      		if(!file_exists(pathinfo($filename)['dirname']))
      			MakePath($filename, true);
			try {
					ob_start();
					echo '<img style="width: 100%;" src="'.$qr.'" alt="QRCode">';
					// // echo '<div style="width : '.getimagesize("img/galerie/test/0CEk8eQyYgGOJDPuLRF11386252356.jpg")[0].'px; height : '.getimagesize("img/galerie/test/0CEk8eQyYgGOJDPuLRF11386252356.jpg")[1].'px;background-image: url(img/galerie/test/0CEk8eQyYgGOJDPuLRF11386252356.jpg)">test</div>';
					$content = ob_get_clean();
					echo $content;
					$pdf = new HTML2PDF('p', 'A4', 'en');
					$pdf->writeHTML($content);
	        		ob_clean();
					$pdf->output($filename, 'F');
			} catch (HTML2PDF_exception $e) {
				// die($e);
			}
		}
		ob_clean();
		if($compress){
	      	$zip = new ZipLib();
	      	$zipDest = str_replace("QR PDF", "", pathinfo($filename)['dirname']);
	      	$zip->compress(pathinfo($filename)['dirname'], $zipDest);			
		}

		if($deletePngAfter){
			DeleteDirectoryContent($fileInfo['dirname']);
			rmdir($fileInfo['dirname']);
			unlink($fileInfo['dirname'].'.zip');
		}
	}
}
?>