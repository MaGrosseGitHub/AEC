<?php
class Images{

  static private $pathToLib;

  static protected function init() {
    self::$pathToLib  = ROOT.DS.'core'.DS.'lib/imagine.phar';
  }

  static public function convert($image, $format = "jpg", $unlink = false, $watermark = false, $quality = 100, $watermarkImg = null, $watermarkOpacity = null){
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
      Images::SetImgBDD($dest);
      return $dest;
    } else {
      return false;
    }
  }

  static public function resize($image, $width, $height, $format = null, $customDir = null, $customName = null, $checkFile = null, $crop = null, $grayscale = true, $saveBDD = true){
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
    Images::SetImgBDD($dest);
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
    Images::SetImgBDD($dest);
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

  static public function mosaic($album, $overwrite = true, $width = 1500, $height = 800, $filename = null, $perLine = null){
    $maxMosaicImgs = 12;
    self::init();
    if(isset($filename) && !empty($filename))
      $dest = 'tmp/Medias/Albums/'.$filename.'.jpg';
    else
      $dest = 'tmp/Medias/Albums/'.$album->name.'.jpg';

    if(file_exists($dest) && !$overwrite){
        return $dest;
    }

    require_once self::$pathToLib;
    $images = $album->images;
    // On crée une mosaic vide
    $imagine = new Imagine\Gd\Imagine();

    if(count($images) == 1){
      copy("img/".$images[0], $dest);
      return $dest;
    } elseif(count($images) < $maxMosaicImgs && count($images) >= 2){
      $divideFour = count($images)%4;
      $divideThree = count($images)%3;
      $perLine = ($divideFour < $divideThree) ? $divideFour : $divideThree;
      $nbValidImgs = count($images)-$perLine;
      $divideFour = ($divideFour < $divideThree) ? true : false;
      if(count($images) == 2){
        $nbValidImgs = 2;
      }

      if($divideFour){
        $perLine = 4;
        $width = 1600;
        $thumbHeight = $height/2;
        if($nbValidImgs == 4){
          $thumbWidth = $height;
          $perLine = 2;
        } else {
          $thumbWidth = $width/4;
        }
      } else {
        $perLine = 3;
        $height = 900;
        if($nbValidImgs == 3 || $nbValidImgs == 2){
          $thumbWidth = $width/2;
          $thumbHeight = $height;
          $nbValidImgs = 2;
          $divideFour = true;
        } elseif($nbValidImgs == 6) {
          $thumbWidth = $width/3;
          $thumbHeight = $height/2;
          $divideFour = true;
        } else {
          $thumbWidth = $width/3;
          $thumbHeight = $height/3;
        }
      }
    } else {
      $width = 1600;
      $height = 900;
      $thumbWidth = $width/4;
      $thumbHeight = $height/3;
      $divideFour = true;
      $nbValidImgs = 12;
      $perLine = 4;
    }

    $size = new Imagine\Image\Box($width, $height);
    $thumbsize = new Imagine\Image\Box($thumbWidth, $thumbHeight);
    $mosaic = $imagine->create($size);
    $test = 0;
    for ($i= 0; $i < $nbValidImgs; $i++) {
      $image = "img/".$images[$i];
      if($divideFour) {        
        $x = ($i%$perLine) * $thumbWidth;
        $y = (floor($i / $perLine)) * $thumbHeight;
      } else {
        $x = (floor($i / $perLine)) * $thumbWidth;
        $y = ($i%$perLine) * $thumbHeight;
      }

      $point = new Imagine\Image\Point($x, $y);
      $thumb = $imagine->open($image)->thumbnail($thumbsize, 'outbound');
      $mosaic->paste($thumb,  $point);
    }

    $aplat = $imagine->create($size, new Imagine\Image\Color('FFF', 75));
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
              if(!file_exists($saveOptions['directory'])) MakePath($saveOptions['directory']); 
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
              if($converted){
                $image = substr($image, 0, -3);
                $image = $image.'jpg';
              }
              Images::SetImgBDD($image);
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

  static public function SetImgBDD($file){
    $fileData = pathinfo($file);
    $fileName = $fileData['filename'];
    $fileDir = $fileData['dirname'];
    $extension = $fileData['extension'];

    if(file_exists($file)){
      $imgSizaData = getimagesize($file);
      if($imgSizaData[0] > 1920){ //if width superior to 4k resize
        $newSize = Images::GetCorrespondingSize($imgSizaData[0], $imgSizaData[1]);
        Images::resize($file, $newSize[0], $newSize[1], $extension,null,null,null,false, false, false);
        $image= file_get_contents($fileDir.'/'.$fileName.'_'.$newSize[0].'x'.$newSize[1].'.'.$extension);
        unlink($fileDir.'/'.$fileName.'_'.$newSize[0].'x'.$newSize[1].'.'.$extension);
      } else {
        $image= file_get_contents($file);
      }
      $image= base64_encode($image);

      $result = array("name" => $fileName, "extension" => $extension, "image" =>$image);
      $result = (object) $result;

      $imgCtrl = new Controller();
      $imgCtrl->loadModel('ImgDump');
      $imgBdd = $imgCtrl->ImgDump->findFirst(array(
        'conditions' => array('name' => $fileName)
      ));

      if(!empty($imgBdd)){
        $result->id = $imgBdd->id;
        $imgCtrl->ImgDump->save($result);
      }
      else{
        $imgCtrl->ImgDump->save($result);
      }
      $cacheDir = Cache::DUMP.DS."ImgDump";
      $imgCtrl->Cache->write("LastModBDD", time(), $cacheDir, true);

      return true;
    } else {
      return false;
    }

  }

  static public function GetImgBDD($file){
    if(!file_exists($file)){
      $fileData = pathinfo($file);
      $fileName = $fileData['filename'];
      $fileDir = $fileData['dirname'];
      $extension = $fileData['extension'];

      $imgCtrl = new Controller();
      $imgCtrl->loadModel('ImgDump');
      $imgBdd = $imgCtrl->ImgDump->findFirst(array(
        'conditions' => array('name' => $fileName)
      ));
      if(!empty($imgBdd)){
        $imageData = base64_decode($imgBdd->image);
        $source = imagecreatefromstring($imageData);

        $imageName = $fileDir.'/'.$imgBdd->name.'.'.$imgBdd->extension;
        $imageName = str_replace(Router::webroot(""), "", $imageName);
        switch ($imgBdd->extension) {
          case 'png':
              $imageSave = imagepng($source,$imageName,100);
              break;
          case 'jpg':
              $imageSave = imagejpeg($source,$imageName,100);
              break;
          case 'jpeg':
              $imageSave = imagejpeg($source,$imageName,100);
              break;
          case 'gif':
              $imageSave = imagegif($source,$imageName,100);
              break;
        }
        imagedestroy($source);
        return true;
      }
      else{
        return false;
      }
    }
    else {
      return true;
    }
  }

  static public function DeleteImg($file){
    if(strpos(strtolower(mime_content_type($file)),'image') !== false){
      if(file_exists($file)){
        $fileData = pathinfo($file);
        $fileName = $fileData['filename'];
        $fileDir = $fileData['dirname'];
        $extension = $fileData['extension'];

        $imgCtrl = new Controller();
        $imgCtrl->loadModel('ImgDump');
        $imgBdd = $imgCtrl->ImgDump->findFirst(array(
          'conditions' => array('name' => $fileName)
        ));
        if(!empty($imgBdd)){
          $imgCtrl->ImgDump->delete($imgBdd->id);
        }
        unlink($file);
        $cacheDir = Cache::DUMP.DS."ImgDump";
        $imgCtrl->Cache->write("LastModBDD", time(), $cacheDir, true);

        return true;
      } else {
        return false;
      }
    } else {
      unlink($file);
    }
  }

  static protected function phpResize($images, $width, $height){

    $fileData = pathinfo($images);
    $fileName = $fileData['filename'];
    $fileDir = $fileData['dirname'];
    $extension = $fileData['extension'];
    $imageName = $fileDir.'/'.$fileName.'01.'.$extension;
    switch ($extension) {
      case 'png':
          $images_orig = imagecreatefrompng($images);
          break;
      case 'jpg':
          $images_orig = imagecreatefromjpeg($images);
          break;
      case 'jpeg':
          $images_orig = imagecreatefromjpeg($images);
          break;
      case 'gif':
          $images_orig = imagecreatefromgif($images);
          break;
    }

    $photoX = ImagesX($images_orig);
    $photoY = ImagesY($images_orig);
    $images_fin = ImageCreateTrueColor($width, $height);
    ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);

    switch ($extension) {
      case 'png':
          $imageSave = imagepng($images_fin,$imageName,100);
          break;
      case 'jpg':
          $imageSave = imagejpeg($images_fin,$imageName,100);
          break;
      case 'jpeg':
          $imageSave = imagejpeg($images_fin,$imageName,100);
          break;
      case 'gif':
          $imageSave = imagegif($images_fin,$imageName,100);
          break;
    }
    ImageDestroy($images_orig);
    ImageDestroy($images_fin);
  }

  // static public function GetCorrespondingSize($width, $height){ //resizes with width and height in mind (image will never be bigger than specified width or height)
  //   $max_width = 1920;
  //   $max_height = 1080;
  //   $width_percent = $max_width/$width;
  //   $height_percent = $max_height/$height;
  //   $scale = ($width_percent>$height_percent)?'height':'width';
  //   $scale_percent = $scale.'_percent';
  //   $scale_percent = $$scale_percent;   
  //   $width*=$scale_percent;
  //   $height*=$scale_percent; 
  //   return array($width, $height);
  // } 
  
  static public function GetCorrespondingSize($original_width, $original_height){ //resizes with width only in mind
    $max_width = 1920;
    $max_height = 1080;
    $new_width = $original_width; 
    $new_height = $original_height;
    if ($original_width > $max_width) {
      $ratio = $max_width / $original_width;
      $new_width = $max_width;
      $new_height = $original_height * $ratio;
    }
    return array($new_width, $new_height);
  }

}