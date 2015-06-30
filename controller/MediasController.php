<?php 
class MediasController extends Controller{

	function index($user = null) {
		$perPage = 20; 
		$d['isAlbum'] = false;
		if(!isset($user) || empty($user))
			$condition = "((type = 'img' AND album = '') OR (type = 'video' AND album = '') OR (type = 'album' AND album != '')) AND post_id IS NULL";
		elseif(isset($user) && !empty($user)) {
			if(preg_match("#^album!#", $user)){
				$user = str_replace("album!", "", $user);
				$d['isAlbum'] = true;
				$condition = "( (type = 'album' AND album != '') AND post_id IS NULL AND name = '".$user."')";
			} else {
				$condition = "(((type = 'img' AND album = '') OR (type = 'video' AND album = '') OR (type = 'album' AND album != '')) AND post_id IS NULL AND user = '".$user."')";
			}
			$perPage = 9000;
		}
		$this->loadModel('Media');
		$d['images'] = $this->Media->find(array(
			'conditions' => $condition,
			'limit'      => ($perPage*($this->request->page-1)).','.$perPage,
			'order'		 => 'id'
		)); 
		// $d['albums'] = $this->Media->findList(array(
		// 	'conditions' => array('type'=>"album")
		// )); 
		
		if($d['isAlbum']){
			$d['images'] = reset($d['images']);
			$tempImgs = explode(",", $d['images']->album);
			$tempImgArr = array();
			$jumpIteration = false;
			$albumMosaic = new stdClass(); 
			$albumMosaic->name = $d['images']->name;
			$albumMosaic->images = array();
			foreach ($tempImgs as $tempImg => $TempImgData) {
				$tempMediaArr = new stdClass(); 
				preg_match_all("/\[(.*?)\]/",$TempImgData,$matches);
				if(!empty($matches[0])) { 
                    $videoData = explode("+", $matches[1][0]);
                    $service = $videoData[1];
                    $videoId = $videoData[0];
                    $videoSlug = 'video!'.$d['images']->user.'!'.$d['images']->name.'!'.$service.'!'.$videoId;
					$videoInfo = $this->GetVideoInfo($videoSlug);
					$videoInfo['id'] = $d['images']->id;
					$videoInfo['slug'] = $videoSlug;
					$videoInfo['post_id'] = $d['images']->post_id;
					$videoInfo['eventType'] = $d['images']->eventType;
					$videoInfo['date'] = $d['images']->date;
					$videoInfo['imgInfo']->album = '';
					$videoInfo['type'] = 'video';
					$videoInfo['name'] = $videoInfo['imgInfo']->name;
					$videoInfo['file'] = $service;
					$videoInfo['album'] = '';
                    if(count($videoData) > 2 && file_exists('img/'.$videoData[2])){
                    	$videoInfo['imgInfo']->thumb = $videoData[2];
                    	$videoInfo['name'] = $videoInfo['name'].','.$videoData[2];
                    }

					$dir = "tmp/Medias/Video/".$service."/".$videoId;
					if (!file_exists($dir) || !is_dir($dir)) {
                        $jumpIteration = true;          
					} 
					foreach ($videoInfo as $tempMediaArrKey => $tempMediaArrValue) {
						$tempMediaArr->$tempMediaArrKey = $tempMediaArrValue;
					}
				} else {
					$tempMediaArr->id = $d['images']->id;
					$tempMediaArr->post_id = $d['images']->post_id;
					$tempMediaArr->type = 'img';
					$tempMediaArr->eventType = $d['images']->eventType;
					$tempMediaArr->date = $d['images']->date;
					$tempMediaArr->user = $d['images']->user;
					$tempMediaArr->file = $TempImgData;
					$tempMediaArr->name = pathinfo($TempImgData);
					$tempMediaArr->name = $tempMediaArr->name['basename'];
					$tempMediaArr->album = '';
					$albumMosaic->images[] = $TempImgData;
				}

				if(!$jumpIteration)
					$tempImgArr[] = $tempMediaArr;
				else
					continue;
			}
			$d['images'] = $tempImgArr;
			Images::mosaic($albumMosaic);

		} 

		$d['total'] = $this->Media->findCount($condition);
		$d['page'] = ceil($d['total'] / $perPage);
		$d['curPage'] = $this->request->page;
		$this->set($d);
	}

	function view($id, $slug){
		$urlSlug = $slug;
		$file = explode("!", $slug);

		if($file[0] == "video"){
			$d = $this->GetVideoInfo($slug);
			$d['imgInfo']->id = $id;
			$d['imgInfo']->slug = $slug;
			$foundImg = true;

			$dir = "tmp/Medias/Video/".$d['service']."/".$d['video'];
			if (!file_exists($dir) || !is_dir($dir)) {
			    $d['imgInfo'] = array();
			    $foundImg = false;         
			} 

		} else {
			if(count($file) > 2){
				unset($file[1]);
			} 
			$file = implode("/", $file);
			// $file = str_replace("!", "/", $slug).'.jpg';
			$file = "img/galerie/$file.jpg";
			$foundImg = true;

			if(file_exists($file)){
				$d['imgUrl'] = explode("!", $urlSlug);
				$d['user'] = $d['imgUrl'][0];
				$d['file'] = str_replace("img/", "", $file);
				if(count($d['imgUrl']) > 2){
					$d['album'] = $d['imgUrl'][1];
					$d['image'] = $d['imgUrl'][2];
				} else{
					$d['image'] = $d['imgUrl'][1].'.jpg';
					$d['album'] = null;
				}
				$d['imgUrl'] = $file;

				$d['imgInfo'] = new stdClass(); 
				$d['imgInfo']->id = $id;
				$d['imgInfo']->slug = $slug;
				$d['imgInfo']->name = $d['image'];
				$d['imgInfo']->album = $d['album'];
				$d['imgInfo']->file = $d['file'];
				$d['imgInfo']->user = $d['user'];
				$d['imgInfo']->type = "img";
				$foundImg = true;
			} else{
				$this->loadModel('Media');
				$condition = array('id'=>$id);
				$d['imgInfo'] = $this->Media->findFirst(array(
					'conditions' => $condition
				)); 

				$tempSlug = pathinfo($d['imgInfo']->file);
				$d['imgInfo']->slug = $tempSlug['dirname'].'/'.$tempSlug['filename'];
				$d['imgInfo']->slug = str_replace("galerie/", "", $d['imgInfo']->slug);
				$d['imgInfo']->slug = str_replace("/", "!", $d['imgInfo']->slug);
				$foundImg = false;
			}
		}

		if(empty($d['imgInfo'])){
			$this->e404('Page introuvable'); 
		}
		if(!$foundImg && ($slug != $d['imgInfo']->slug || $id != $d['imgInfo']->id)){
			// $this->redirect("medias/view/id:$id/slug:".$d['imgInfo']->slug,301);
		}

		$this->set($d);
	}
	
	function admin_index($id = null){

		$this->loadModel('Media');

		if(isset($id) && !empty($id)) {
			$d['images'] = $this->Media->find(array(
				'conditions' => array('post_id' => $id
			))); 
			$d['post_id'] = $id;
		} else {
			$d['images'] = $this->Media->find(); 
			$d['post_id'] = $id;
		}

		$d['albums'] = $this->Media->findList(array(
			'conditions' => array('type'=>"album")
		)); 
		// $this->layout = 'modal';
		$this->set($d); 
	}

	function admin_upload(){
		$this->loadModel('Media');

		$d['albums'] = $this->Media->findList(array(
			'conditions' => array('type'=>"album")
		)); 
		$this->set($d);
	}

	function admin_process(){
		if(($this->request->data && !empty($this->request->data)) && (isset($this->request->data->addToAlbum) && !empty($this->request->data->addToAlbum))) {
			$this->loadModel('Media');
			$albumId = $this->request->data->addToAlbum;
			unset($this->request->data->addToAlbum);
			$album = $this->addToAlbum(intval($albumId), $this->request->data);

			$this->Session->setFlash("Le(s) média(s) ont bien ajouté à l'album");
			$this->redirect('admin/medias/index');
		}else if ($this->request->data && !empty($_FILES['file']['name'])) {
			if(strpos($_FILES['file']['type'], 'image') !== false) {

				$imgDir = "galerie/".$_SESSION['User']->login."/";
				if(!file_exists("img/".$imgDir)) mkdir("img/".$imgDir,0777); 

				$ext = substr($_FILES['file']['name'], -4);
				$imageName = generateRandomString();
				$image = "img/".$imgDir.$imageName.time().$ext;

				move_uploaded_file($_FILES['file']['tmp_name'], $image);
				$image = Images::convert($image, "jpg", true);
				Images::resize($image, 180, 135);
				// Images::watermark($image, $watermark, 70);
				$v = Router::webroot($image);
				$v = str_replace('\\','/',$v);

				$html = '<div class="file"><img src="'.$v.'"/> '.basename($v).'<div class="actions"><a href="'.basename($v).'" class="del">Supprimer</a></div> </div>';
				$html = str_replace('"','\\"',$html);

				$this->loadModel('Media');
				$album = "";
				if($this->request->data) {
					if($this->checkAddToAlbum($this->request->data->name)){
						$album = $this->addToAlbum($this->request->data->name, $imgDir.basename($v));
					}
				}

				$this->Media->save(array(
					'name' => basename($v),
					'file' => $imgDir.basename($v),
					'post_id' => null,
					'type' => 'img',
					'album' => $album,
					'user' => $_SESSION['User']->login		
				));

				die('{"error":false, "html": "'.$html.'"}'); 
			} else {
				die('{"error":true, "html": "Le fichier n\'est pas une image"}');
			}
		} else {
			die('{"error":true, "html": "Le fichier n\'est pas une image"}');
		}
	}

	function admin_delete($id = null){
		$this->loadModel('Media');
		if($this->request->data && !empty($this->request->data)){
			if(isset($this->request->data->deleteAlbum) || isset($this->request->data->deleteAlbumImg)){
				debug($this->request->data);

				if(isset($this->request->data->deleteAlbum)){
					$albumId = $this->request->data->deleteAlbum;
					$albumData = $this->Media->findFirst(array(
						'conditions' => array('id'=>$albumId)
					)); 
					$album = explode(",", $albumData->album);
					foreach ($album as $imgKey => $img) {
						$media = $this->Media->findFirst(array(
							'conditions' => array('file'=>$img)
						));
						$media->album = "";
						$this->Media->save($media);
					}
					$this->Media->delete($albumId);
				} elseif(isset($this->request->data->deleteAlbumImg)) {
					$albumId = $this->request->data->deleteAlbumImg;
					$albumData = $this->Media->findFirst(array(
						'conditions' => array('id'=>$albumId)
					)); 
					$album = explode(",", $albumData->album);
					foreach ($album as $imgKey => $img) {
						$media = $this->Media->findFirst(array(
							'conditions' => array('file'=>$img)
						));
						$this->deleteImg($img, $media->id);
					}
					$this->Media->delete($albumId);
				}
			} else {
				foreach ($this->request->data as $img => $checked) {
					if($checked){
						$media = $this->Media->findFirst(array(
							'conditions' => array('id'=>$img)
						));
						$id = $img;
						$this->deleteImg($media->file, $id, $media->album);
					}
				}
			}

			$this->Session->setFlash("Les médias ont bien été supprimés");
			$this->redirect('admin/medias/index');
		} else {
			$media = $this->Media->findFirst(array(
				'conditions' => array('id'=>$id)
			));
			$this->deleteImg($media->file, $id, $media->album);
			$this->Session->setFlash("Le média a bien été supprimé");
			$this->redirect('admin/medias/index');
		}
	}

	private function deleteImg($file, $id, $album = null){
		Images::DeleteImg(WEBROOT.DS.'img'.DS.$file);
		$imgInfo = pathinfo($file);
		$imgName = $imgInfo['basename'];
		$imgDir = $imgInfo['dirname'];
		$imgNameExt = str_replace(".".$imgInfo['extension'], "", $imgName);		
		Images::DeleteImg(WEBROOT.DS.'img'.DS.$imgDir.DS."grayscale_".$imgNameExt."_180x135.".$imgInfo['extension']);
		Images::DeleteImg(WEBROOT.DS.'img'.DS.$imgDir.DS.$imgNameExt."_180x135.".$imgInfo['extension']);
		$this->Media->delete($id);

		if(!empty($album)){
			$this->removeFromAlbum($album, $file);
		}
	}

	function admin_createAlbum($name) {		
		if($this->request->data) {
			$this->loadModel('Media');
			$this->Media->save(array(
				'name' => $name,
				'file' => null,
				'post_id' => null,
				'type' => 'album',
				'album' => "",
				'user' => $_SESSION['User']->login		
			));
			die(json_encode("Créeation Confirmé"));
		}
	}

	private function addToAlbum($data, $image){

		if(is_array($data)){
			$album = explode("/", $data);
			$albumName = $album[0];
			$albumdata = $this->Media->findFirst(array(
				'conditions' => array('name'=>$albumName)
			));
			$albumArray = explode(",", $albumdata->album);
		} elseif(is_int($data)){
			$albumdata = $this->Media->findFirst(array(
				'conditions' => array('id'=>$data)
			));
			$albumName = $albumdata->name;
			$albumArray = explode(",", $albumdata->album);			
		}

		if(!is_object($image)){
			$this->checkAndAdd($albumdata, $albumArray, $image);
		} elseif(is_object($image)) {
			$newAlbumContent = array();
			foreach ($image as $imgId => $imgCheck) {
				if($imgCheck) {
					$imgId = str_replace("_jpg", ".jpg", $imgId);
					array_push($newAlbumContent, $imgId);				
					$imgData = $this->Media->findFirst(array(
						'conditions' => array('file'=>$imgId)
					));
					$imgData->album = $albumName;
					$this->Media->save($imgData);
				}
			}
			$newAlbumContent = implode(",", $newAlbumContent);
			$this->checkAndAdd($albumdata, $albumArray, $newAlbumContent);	
		}
		return $albumName;
	}

	private function checkAndAdd($albumdata, $albumArray, $image){
		if($this->checkIfInAlbum($albumArray, $image)) {
			if($albumdata->album == "") {
				$albumdata->album = $image;
			} else {
				$albumdata->album = $albumdata->album.','.$image;
			}
			$this->Media->save($albumdata);
		} else {
			return false;
		}
	}

	private function removeFromAlbum($album, $image) {	

		$albumdata = $this->Media->findFirst(array(
			'conditions' => array('name'=>$album)
		));

		$album = explode(",", $albumdata->album);
		if(checkIfInAlbum($album, $image)) {
			$imageKey = array_search ($image, $album);
			unset($album[$imageKey]);
			$album = implode(",", $album);
			$albumdata->album = $album;
			$this->Media->save($albumdata);
		} else {
			return false;
		}

	}

	private function checkAddToAlbum($image){
		if(!is_array($image)) {
			if(strpos($image, "/")){
				return true;
			} else {
				return false;
			}
		}
	}

	private function checkIfInAlbum($album, $image){
		if(count($album) != 1 && $album[0] != "") {
			if(!in_array($image, $album)){
				return true;
			} else {
				return false;
			}
		}
		else{
			return true;
		} 		
	}

	protected function GetVideoInfo ($url){		
		$d['imgUrl'] = $d['file']= explode("!", $url);
		$d['user'] = $d['imgUrl'][1];
		if(count($d['imgUrl']) > 4){
			$d['album'] = $d['imgUrl'][2];
			$d['service'] = $d['imgUrl'][3];
			$d['video'] = $d['imgUrl'][4];
		} else{
			$d['service'] = $d['imgUrl'][2];
			$d['video'] = $d['imgUrl'][3];
			$d['album'] = null;
		}

		if(strlen($d['video']) == 11 && $d['service'] != "youtube")
			$d['service'] = "youtube";
		elseif(strlen($d['video']) == 8 && $d['service'] != "vimeo")
			$d['service'] = "vimeo";
		elseif (strlen($d['video']) == 7 && $d['service'] != "dailymotion")
			$d['service'] = "dailymotion";
		elseif(strlen($d['video']) != 11 && strlen($d['video']) != 8 && strlen($d['video']) != 7)
			$this->e404('Page introuvable');
		elseif($d['service'] != "youtube" && $d['service'] != "vimeo" && $d['service'] != "dailymotion")
			$this->e404('Page introuvable'); 

		if($d['service']== 'youtube')
		{
			$iframe = 'http://www.youtube.com/embed/'.$d['video'];
			$link = "http://www.youtube.com/watch?v=".$d['video'];
			$thumb = 'http://img.youtube.com/vi/'.$d['video'].'/2.jpg';
			$thumb = 'http://img.youtube.com/vi/'.$d['video'].'/0.jpg';
		} elseif($d['service']=='vimeo') {
			$iframe = 'http://player.vimeo.com/video/'.$d['video'];
			$link = "https://vimeo.com/".$d['video'];
			$ctx = stream_context_create(
				array(
					'http'=> array(
				        'timeout' => 5, // 1 200 Seconds = 20 Minutes
				    )
				)
			);
			if(@file_get_contents("http://vimeo.com/api/v2/video/".$d['video'].".php", false, $ctx)) {
				$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$d['video'].".php"));
				$thumb = $hash[0]["thumbnail_medium"];
				// $thumb = $hash[0]["thumbnail_large"];
			} else {
				$thumb = Router::webroot("css/img/noPic.png");
			}
		} elseif($d['service']=='dailymotion') {
			$iframe = 'http://www.dailymotion.com/embed/video/'.$d['video'];
			$link = "http://www.dailymotion.com/video/".$d['video'];
			$thumb = 'http://www.dailymotion.com/thumbnail/video/'.$d['video'];
		}	

		$d['imgUrl'] = $url;
		$d['file'] = $url;
		$d['imgInfo'] = new stdClass(); 
		// $d['imgInfo']->id = $id;
		// $d['imgInfo']->slug = $slug;
		$d['imgInfo']->name = $d['service'];
		$d['imgInfo']->name = $d['video'];
		$d['imgInfo']->album = $d['album'];
		$d['imgInfo']->file = $d['file'];
		$d['imgInfo']->user = $d['user'];
		$d['imgInfo']->type = "video";
		$d['imgInfo']->iframe = $iframe.'?autoplay=1';
		$d['imgInfo']->link = $link;
		$d['imgInfo']->thumb = $thumb;

		return $d;
	}

}