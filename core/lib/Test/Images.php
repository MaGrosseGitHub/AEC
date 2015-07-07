<?php
class Images{

    static private $pathToLib;

    static private function init() {
      self::$pathToLib  = ROOT.DS.'core'.DS.'lib/imagine.phar';
    }

    static public function convert($image, $format, $unlink = false, $watermark = true, $quality = 100, $watermarkImg = null, $watermarkOpacity = null){
      if(self::checkFormat($format)) {
        self::init();
        require_once self::$pathToLib;
        $imagine = new Imagine\Gd\Imagine();

        if($watermark){
          self::watermark($image);
        } elseif($watermark && (isset($watermarkImg) && !empty($watermarkImg))) {
          self::watermark($image, $watermarkImg);
        } elseif($watermark && (isset($watermarkOpacity) && !empty($watermarkOpacity))) {
          self::watermark($image, null, $watermarkOpacity);
        } elseif($watermark && (isset($watermarkImg) && !empty($watermarkImg)) && (isset($watermarkOpacity) && !empty($watermarkOpacity))) {
          self::watermark($image, $watermarkImg, $watermarkOpacity);
        }

        $info = pathinfo($image);
        $ext = $info['extension'];
        $dest = $info['dirname'] . DS . $info['filename'] . ".".$format;
        $imagine->open($image)->save($dest, array('quality' => $quality));
        if($unlink && $ext != $format) {
          unlink($image);
        }
        return $dest;
      } else {
        return false;
      }
    }

    static public function resize($image, $width, $height, $format = null, $customDir = null, $customName = null, $checkFile = null, $crop = null, $grayscale = true){
      self::init();

      $info = pathinfo($image);
      if(!isset($customDir) || empty($customDir)) {
        $outputDir = $info['dirname'];
      } else if(isset($customDir) && !empty($customDir)) {
        $outputDir = $customDir;
      }
      if(!isset($customName) || empty($customName)) {
        $outputName = $info['filename'];
      } else if(isset($customName) && !empty($customName)) {
        $outputName = $customName;
      }

      if(!isset($format) || empty($format)) {
        $format = "jpg";
      } else {
        if(!self::checkFormat($format)){
          return false;
        }
      }

      $dest = $outputDir . DS . $outputName . "_$width" . "x$height" . ".".$format;

      if($checkFile && file_exists($dest)){
         return '<img src="' . $dest . '">';
      }
      require_once self::$pathToLib;

      $imagine = new Imagine\Gd\Imagine();
      $size = new Imagine\Image\Box($width,$height);
      if(!isset($crop) || $crop) {
        $imagine->open($image)->thumbnail($size, 'outbound')->save($dest);
      } else if(isset($crop) && !$crop) {
        $imagine->open($image)->thumbnail($size, 'inset')->save($dest);
      }
      if($grayscale){
        self::grayScale($dest);
      }
      return '<img src="' . $dest . '">';
    }

    static public function grayScale($image) { 

      $info = pathinfo($image);
      $dest = $info['dirname'] . DS . "grayscale_".$info['filename'] . ".jpg";

      $image = imagecreatefromjpeg($image);
      if($image && imagefilter($image, IMG_FILTER_GRAYSCALE))
      {
          imagejpeg($image, $dest);
      }
    }

    static public function watermark($image, $watermark = "img/logo/logo.png", $opacity = 50, $customDir = null) {  

      $imageInfo = pathinfo($image);
      $watermarkInfo = pathinfo($watermark);
      $watermarkExt = $watermarkInfo['extension'];
      $imageExt = $imageInfo['extension'];

      if(strtolower($watermarkExt) == "png") {
        $stamp = imagecreatefrompng($watermark);
      } else if(strtolower($watermarkExt) == "jpg" || strtolower($watermarkExt) == "jpeg") {
        $stamp = imagecreatefromjpeg($watermark);
      }

      if(strtolower($imageExt) == "png") {
        $im = imagecreatefrompng($image);
      } else if(strtolower($imageExt) == "jpg" || strtolower($imageExt) == "jpeg") {
        $im = imagecreatefromjpeg($image);
      }

      if(!isset($customDir) || empty($customDir)) {
        $outputDir = $imageInfo['dirname'];
      } else if(isset($customDir) && !empty($customDir)) {
        $outputDir = $customDir;
      }

      $dest = $outputDir . DS . $imageInfo['basename'];

      $marge_right = 10;
      $marge_bottom = 10;
      $sx = imagesx($stamp);
      $sy = imagesy($stamp);

      // Merge the stamp onto our photo with an opacity of 50%
      imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), $opacity);

      imagejpeg($im, $dest);
      imagedestroy($im);
    }

    static public function mosaic($directory, $perLine, $width, $height){
      $dest = $directory . '/mosaic.jpg';
      if(file_exists($dest)){
          return $dest;
      }
      $images = glob($directory . '/*.jpg');
      require_once self::$pathToLib;

      // On crée une mosaic vide
      $imagine = new Imagine\Gd\Imagine();
      $size = new Imagine\Image\Box($width * ceil( count($images) / $perLine), $perLine * $height);
      $thumbsize = new Imagine\Image\Box($width, $height);
      $mosaic = $imagine->create($size);

      foreach($images as $k => $image){
          if(!strpos($image, 'mosaic')){
              $x = floor($k / $perLine) * $width;
              $y = $k % $perLine * $height;
              $point = new Imagine\Image\Point($x, $y);
              $thumb = $imagine->open($image)->thumbnail($thumbsize, 'outbound');
              $mosaic->paste($thumb,  $point);
          }
      }

      $aplat = $imagine->create($size, new Imagine\Image\Color('000000', 50));
      $mosaic->paste($aplat, new Imagine\Image\Point(0,0));

      $mosaic->save($dest);
      return $dest;

    }

    static private function checkFormat($format) {
      $extensionArray = ['jpg','png','jpeg','gif'];
      if(in_array($format, $extensionArray)) {
        return true;
      } else {
        return false;
      }
    }

    static public function checkImg($controller, $img, $size = 10, $save = false, $saveOptions = array()){
      if($size == null){
        $size = 10;
      }
      $converted = false;
      if($img['error'] == 0){
        if($img['size'] <= $size*pow(10,6)){
          // Testons si l'extension est autorisée
          $info_file = pathinfo($img['name']);
          $extension_upload = $info_file['extension'];
          if(self::checkFormat($extension_upload)){
            if($save){
              if(isset($saveOptions) && !empty($saveOptions)){
                if(!isset($saveOptions['directory']) || !isset($saveOptions['imgName'])){
                  $controller->Notification->setFlash('Repertoir ou nom du fichier manquant !', 'error'); 
                  return false;
                }
                if(!file_exists($saveOptions['directory'])) mkdir($saveOptions['directory'],0777); 
                move_uploaded_file($img['tmp_name'], $saveOptions['directory'] .'/'. $saveOptions['imgName'] .'.'.$extension_upload);
                $image = $saveOptions['directory'] .'/'. $saveOptions['imgName'] .'.'.$extension_upload;
                if(isset($saveOptions['convert']) && $saveOptions['convert']){                
                  self::convert($image, "jpg", true, false);
                  $converted = true;
                }
                if(isset($saveOptions['resize']) && $saveOptions['resize']){
                  if(!isset($saveOptions['width'])){
                    $width = 180;
                  }
                  if(!isset($saveOptions['height'])){
                    $height = 135;
                  }
                  if($converted){
                    $image = substr($image, 0, -3);
                    $image = $image.'jpg';
                  }
                  Images::resize($image, $width, $height, null, null, null, null, null, false);
                }
                $controller->Notification->setFlash('l\'envoi de du fichier a bien été effectuer !', 'success'); 
                return true;
              } else {
                $controller->Notification->setFlash('Erreur lors du transfert.', 'error'); 
                return false;
              }
            } else {
              return true;
            }
          } else {
            $controller->Notification->setFlash('Ce n\'est pas la bonne extension !', 'error'); 
            return false;
          }
        }else {
          $controller->Notification->setFlash('Le fichier est trop gros, la limite est de '.$size.'Mo', 'error'); 
          return false;
        }
      }
      else
      {
        $controller->Notification->setFlash('Erreur lors du transfert', 'error'); 
        return false;
      }
    }

    static private function getPharInfo($file = null) {
      $file = ROOT.DS.'core'.DS.'lib/imagine.phar';
      $p = new Phar($file, 0);
      // Phar étend la classe DirectoryIterator de SPL
      foreach (new RecursiveIteratorIterator($p) as $file) {
          // $file est une classe PharFileInfo et hérité de SplFileInfo
          echo "<pre>";
          echo $file->getFileName() . "<br>";
          echo $file->getPathName() . "<br>";
          echo file_get_contents($file->getPathName()) . "<br>"; // affiche le contenu;
          echo "</pre>";
      }
    }

}