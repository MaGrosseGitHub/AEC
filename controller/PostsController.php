<?php 
class PostsController extends Controller{
	
	/**
	* Blog, liste les articles
	**/
	function index($user = null){
		$perPage = 5; 
		if(isset($user) && !empty($user))
			$perPage = 1000;

		$this->loadModel('Post');
		if(!isset($user) || empty($user))
			$condition = array('online' => 1,'type'=>'post'); 
		elseif(isset($user) && !empty($user))
			$condition = array('online' => 1,'type'=>'post', 'user_id'=>$user);
		$fields = ['id', 'title_FR', 'created', 'online', 'type', 'slug', 'user_id', 'category_id'];
		$fields = implode(",", $fields).', LEFT(content_FR, 500) as content';
		// SELECT LEFT(field name, 40) FROM table name WHERE condition for first 40 and 
		// SELECT RIGHT(field name, 40) FROM table name WHERE condition for last 40
		$options = array(
			'conditions' => $condition,
			'fields' => $fields,
			'order'      => 'created DESC',
			'limit'      => ($perPage*($this->request->page-1)).','.$perPage
		);
		$d['posts'] = $this->Post->find($options);

		$d['total'] = $this->Post->findCount($condition); 
		$d['page'] = ceil($d['total'] / $perPage);
		$d['curPage'] = $this->request->page;
		$d["title_for_layout"] = "Index";

		$this->set($d);
	}

	/**
	* Permet d'afficher les posts d'une catégorie
	**/
	function category($slug){
		$this->loadModel('Category'); 
		$category = $this->Category->findFirst(array(
			'conditions' => array('slug' => $slug),
			'fields'     => 'id,name'
		));
		if(empty($category)){
			$this->e404();
		}
		$perPage = 100; 
		$this->loadModel('Post');
		$condition = array('online' => 1,'type'=>'post','category_id' => $category->id); 
		$d['posts'] = $this->Post->find(array(
			'conditions' => $condition,
			'fields'     => 'Post.id,Post.name,Post.slug,Post.created,Post.category_id as catname,Post.content',
			'order'      => 'created DESC',
			'limit'      => ($perPage*($this->request->page-1)).','.$perPage
		));
		$d['total'] = $this->Post->findCount($condition); 
		$d['page'] = ceil($d['total'] / $perPage);
		$d['title'] = 'Tous les articles "'.$category->name.'"'; 
		$this->set($d);
		// Le système est le même que la page index alors on rend la vue Index
		$this->render('index'); 
	}

	/**
	* Affiche un article en particulier
	**/
	function view($id,$slug){	
		if(!$this->Cache->read(Cache::POST.DS.$slug.DS.$slug)){			
			$this->loadModel('Post');
			$d['post']  = $this->Post->findFirst(array(
				'fields'	 => 'Post.id,Post.content,Post.name,Post.slug,Post.category_id, Post.user_id',
				'conditions' => array('Post.online' => 1,'Post.id'=>$id,'Post.type'=>'post')
			)); 

			$cacheDir = Cache::POST.DS.$slug;
			$this->Cache->write($slug, $d['post'], $cacheDir, true);
		} else {
			$d['post'] = $this->Cache->read(Cache::POST.DS.$slug.DS.$slug, true);
		}	
		$this->SetHits(Cache::POST.DS.$d['post']->slug.DS.$d['post']->slug);

		if(empty($d['post'])){
			$this->e404('Page introuvable'); 
		}
		if($slug != $d['post']->slug){
			$this->redirect("posts/view/id:$id/slug:".$d['post']->slug,301);
		}
		$this->set($d);
	}

	function flux(){
		$this->loadModel('Post');
		$condition = 'online = 1 AND type != "page" '; 
		$options = array(
			'conditions' => $condition,
			'order'      => 'created DESC',
		);
		$d['posts'] = $this->Post->find($options);
		$this->set($d);
	}
	
	/**
	* ADMIN  ACTIONS
	**/
	/**
	* Liste les différents articles
	**/
	function admin_index(){
		$perPage = 100; 
		$this->loadModel('Post');
		$condition = array('type'=>'post'); 
		$d['posts'] = $this->Post->find(array(
			'fields'     => 'Post.id,Post.title_FR,Post.online,Post.created,Post.category_id as catname',
			'order' 	 => 'created DESC',
			'conditions' => $condition,
			'limit'      => ($perPage*($this->request->page-1)).','.$perPage
		));
		$d['total'] = $this->Post->findCount($condition); 
		$d['page'] = ceil($d['total'] / $perPage);
		$this->set($d);
	}

	/**
	* Permet d'éditer un article
	**/
	function admin_edit($id = null){
		$this->loadModel('Post'); 
		if($id === null){
			$post = $this->Post->findFirst(array(
				'conditions' => array('online' => -1),
			));
			if(!empty($post)){
				$id = $post->id;
			}else{
				$this->Post->save(array(
					'online' => -1,
					'created' 	 => null
				));
				$id = $this->Post->id;
			} 

			if(file_exists("img/galerie/".$id)){
				// rmdir("img/galerie/".$id);
				// MakePath("img/galerie/".$id."/",false, 0777); 
				$files = glob("img/galerie/".$id."/*"); 
				if(count($files) > 0){
					foreach($files as $file){ 
						if(is_file($file))
							unlink($file);
					}
				}
			}
		}
		$d['id'] = $id; 
		if($this->request->data){
			if($this->Post->validates($this->request->data)){
				//general settings
				$this->request->data->type = 'post';
				$this->request->data->slug = makeSlug($this->request->data->title_EN, 200);
				$this->request->data->user_id = $_SESSION['User']->login;

				//date settings
				$this->request->data->publication = new DateTime($this->request->data->publication);
				$this->request->data->publication = $this->request->data->publication->getTimestamp();
				$this->request->data->created = time();

				//video settings
				$youtube = $this->DecodeVideo($this->request->data->video_youtube, "youtube");
				$vimeo = $this->DecodeVideo($this->request->data->video_vimeo, "vimeo");
				$server = Router::webroot("vid/".$this->request->data->video_server);
				$videoData = array("youtube" => $youtube, "vimeo" => $vimeo, "server" => $server);
				$this->request->data->videos_id = json_encode($videoData);
				unset($this->request->data->video_youtube);
				unset($this->request->data->video_vimeo);
				unset($this->request->data->video_server);

				// date timestamp to normal settings
				// $d = new DateTime();
				// $d->setTimestamp($this->request->data->publication);
				// $d->format('U = Y-m-d H:i:s');
				// $this->request->data->d = $d;
				// die();

				$preDir = "tmp/Post/";
				$this->Post->save($this->request->data);

				$cacheDir = Cache::POST.DS.$this->request->data->slug;
				$this->Cache->write($this->request->data->slug, $this->request->data, $cacheDir, true);

				$this->Notification->setFlash('Le contenu a bien été modifié', 'success');
				$this->redirect('admin/posts/index'); 
			}else{
				$this->Notification->setFlash('Merci de corriger vos informations','error'); 
			}
			
		}else{
			$this->request->data = $this->Post->findFirst(array(
				'conditions' => array('id'=>$id)
			));

			if(!empty($this->request->data->videos_id)){
				//decode and add video data
				$videoData = json_decode($this->request->data->videos_id);
				$youtube = $videoData->youtube->imgInfo->link;
				$vimeo = $videoData->vimeo->imgInfo->link;
				$server = $videoData->server;
				$server = substr($server, strpos($server, "vid/") + 4 ); //position of "vid/" plus length of "vid/" (4)

				$this->request->data->video_youtube = $youtube;
				$this->request->data->video_vimeo = $vimeo;
				$this->request->data->video_server = $server;
			}

			if(!empty($this->request->data->images_id)){
				//decode and add images data
				$imagesData = array();
				foreach (json_decode($this->request->data->images_id) as $imgKey => $img) {
					$img = str_replace("_180x135", "", $img);
					array_push($imagesData, $img);
				}
				$d['imagesData'] = $imagesData;
				$d['images_id'] = $this->request->data->images_id;
				$this->request->data->images_id = "";
			} else {
				$d['images_id'] = "";
			}

			if(!empty($this->request->data->author_id))
				$d['author_id'] = $this->request->data->author_id;
			else
				$d['author_id'] = "";


			//test delete from bdd function
			//add img save in bdd
			//add possiblity to select default img
		}
		// On veut un sélecteur de catégorie donc on récup la liste des catégories
		$this->loadModel('Category');
		$d['categories'] = $this->Category->findList(); 
		$this->loadModel('Author');
		$d['organizations'] = $this->Author->findList(array(
				'conditions' => array('type'=>"organization"),
				'fields' => 'id, firstName'
			));

		$d['authors_cat'] = $this->Author->find(array(
				'conditions' => array('type'=>"individual"),
				'fields' => 'id, firstName, lastName, organization'
			));

		$authorsSimple = array();
		foreach ($d['authors_cat'] as $autK => $autVal) {
			$item = new StdClass;
			$item->id = $autVal->id;
			$item->text = $autVal->firstName.' '.$autVal->lastName;
			array_push($authorsSimple, $item);
		}
		$items = array();
		foreach ($d['organizations'] as $orgK => $orgName) {
			// $submenu = array();
			$submenu = new StdClass;
			$submenu->items = array();
			foreach ($d['authors_cat'] as $autK => $autVal) {
				if(strtolower($orgName) == strtolower($autVal->organization)){
					$submenuPush = new StdClass;
					$submenuPush->id = $autVal->id;
					$submenuPush->text = $autVal->firstName.' '.$autVal->lastName;
					array_push($submenu->items, $submenuPush);
				}
			}
			$submenu->showSearchInput = true; 

			$pushItems = new StdClass;
			$pushItems->id = (string)$orgK;
			$pushItems->text = $orgName;
			$pushItems->submenu = $submenu;
			array_push($items, $pushItems);
		}
		$d['authors_cat'] = json_encode($items);
		$d['authors'] = json_encode($authorsSimple);

		$this->set($d);
	}

	function admin_process(){
		if($this->request->data && !empty($this->request->data) && !empty($_FILES['file']['name'])){
			if(strpos($_FILES['file']['type'], 'image') !== false) {

				$fileId = $this->request->data->phpId;
				$imgDir = "img/galerie/".$fileId."/";
				if(!file_exists($imgDir)) MakePath($imgDir,false, 0777); 

				$ext = substr($_FILES['file']['name'], -4);
				$imageName = generateRandomString();
				$image = $imgDir.$imageName.time().$ext;
				$imgData = $image;

				move_uploaded_file($_FILES['file']['tmp_name'], $image);
				$image = Images::convert($image, "jpg", true);
				Images::resize($image, 180, 135);
				// // Images::watermark($image, $watermark, 70);
				$v = Router::webroot($image);
				$v = str_replace('\\','/',$v);

				$html = '<div class="file"><img src="'.$v.'"/> '.basename($_FILES['file']['name']).'<div class="actions"><a href="delete_img/'.$fileId.'/'.basename($v).'" class="del">Supprimer</a></div> </div>';
				$html = str_replace('"','\\"',$html);

				die('{"error":false, "html": "'.$html.'", "imgData" : "'.$imgData.'"}');
			} else {
				die('{"error":true, "html": "Le fichier n\'est pas une image"}');
			}	
		}
		die('{"error":true, "une erreur est survenu"}');	
	}

	function admin_delete_img(){
		// die('{"error":false, "html": "L\'image a bien été supprimée"}');
		if($this->request->data && !empty($this->request->data)){
			$this->loadModel('Post'); 
			if(!isset($this->request->data->deleteAll) || (isset($this->request->data->deleteAll) && !$this->request->data->deleteAll)) {
				$id = $this->request->data->id;
				$file = $this->request->data->img;
				$originFile = $file;
				$imgDir = WEBROOT.DS.'img'.DS.'galerie'.DS.$id.DS;

				$imgInfo = pathinfo($imgDir.$file);
				$imgName = $imgInfo['basename'];
				$imgDir = $imgInfo['dirname'];
				$imgNameExt = str_replace(".".$imgInfo['extension'], "", $imgName);	

				unlink($imgDir.DS."grayscale_".$imgNameExt."_180x135.".$imgInfo['extension']);
				unlink($imgDir.DS.$imgNameExt."_180x135.".$imgInfo['extension']);
				unlink($imgDir.DS.$file);	

				$this->request->data = $this->Post->findFirst(array(
					'conditions' => array('id'=>$id)
				));
				$imgGroup = json_decode($this->request->data->images_id);
				if(!empty($imgGroup)){
					if(($key = array_search('img/galerie/'.$id.'/'.$file, $imgGroup)) !== false) {
					    unset($imgGroup[$key]);
						$imgGroup = array_values($imgGroup);
					}

					$this->request->data->images_id = json_encode($imgGroup);
					$this->Post->save($this->request->data);
					$cacheDir = Cache::POST.DS.$this->request->data->slug;
					$this->Cache->write($this->request->data->slug, $this->request->data, $cacheDir, true);
				}
				
				die('{"error":false, "html": "L\'image a bien été supprimée"}');
			} else {
				$id = $this->request->data->id;
				if(file_exists("img/galerie/".$id)){
					$files = glob("img/galerie/".$id."/*"); 
					if(count($files) > 0){
						foreach($files as $file){ 
							if(is_file($file))
								unlink($file);
						}
					}
				}				
				$this->request->data = $this->Post->findFirst(array(
					'conditions' => array('id'=>$id)
				));
				if(!empty($this->request->data->images_id)){
					$this->request->data->images_id = "";
					$this->Post->save($this->request->data);
					$cacheDir = Cache::POST.DS.$this->request->data->slug;
					$this->Cache->write($this->request->data->slug, $this->request->data, $cacheDir, true);
				}

				die('{"error":true, "html": "Toutes les images ont bien été supprimées"}');
			}
		} else {
				die('{"error":true, "html": "une erreur est survenue"}');
		}
	}

	function admin_searchVid(){
		if($this->request->data && !empty($this->request->data)){
			$p=isset($this->request->data->path)?$this->request->data->path:"";
			$f=isset($this->request->data->filter)?$this->request->data->filter:"";
			$s=isset($this->request->data->s)?$this->request->data->s:"";

			die(json_encode(searchDir("./vid/",$p,$f,$s,-1)));
		}
	}

	protected function DecodeVideo($url, $service){
		if(!empty($url)) {
			if($service == "youtube") {
	          	// preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches); 
	          	$result = "";
				if (stristr($url,'youtu.be/')){
					preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); 
					$result = $final_ID[4]; 
				} else {
					@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD);
					if(isset($IDD[5])) 
						$result = $IDD[5]; 
					else
						return false;
				}
				return $this->GetVideoInfo($result, "youtube"); 
			}
			if($service == "vimeo") {
				if(preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $url, $output_array)) {
              		if(isset($output_array[5]))
						return $this->GetVideoInfo($output_array[5], "vimeo"); 
          		}
			}
		}
	}

	protected function GetVideoInfo ($url, $service){		

		$d['video'] = $url;
		$d['service'] = $service;

		if($d['service'] != "youtube" && $d['service'] != "vimeo" && $d['service'] != "dailymotion")
			return false;

		if($d['service']== 'youtube')
		{
			$iframe = 'http://www.youtube.com/embed/'.$d['video'];
			$link = "http://www.youtube.com/watch?v=".$d['video'];
			$thumb = 'http://img.youtube.com/vi/'.$d['video'].'/0.jpg';
			$thumb2 = 'http://img.youtube.com/vi/'.$d['video'].'/2.jpg';
			$thumb3 = 'http://img.youtube.com/vi/'.$d['video'].'/3.jpg';
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
				$thumb2 = $hash[0]["thumbnail_large"];
				$thumb3 = substr($hash[0]["thumbnail_large"],0,-7);
			} else {
				$thumb = Router::webroot("css/img/noPic.png");
			}
		} elseif($d['service']=='dailymotion') {
			$iframe = 'http://www.dailymotion.com/embed/video/'.$d['video'];
			$link = "http://www.dailymotion.com/video/".$d['video'];
			$thumb = 'http://www.dailymotion.com/thumbnail/video/'.$d['video'];
		}	

		$d['imgInfo'] = new stdClass(); 
		// $d['imgInfo']->id = $id;
		// $d['imgInfo']->slug = $slug;
		$d['imgInfo']->iframe = $iframe.'?autoplay=1';
		$d['imgInfo']->link = $link;
		$d['imgInfo']->thumb = $thumb;
		$d['imgInfo']->thumb2 = $thumb2;
		$d['imgInfo']->thumb3 = $thumb3;

		return $d;
	}

	/**
	* Permet de supprimer un article
	**/
	function admin_delete($id){
		$this->loadModel('Post');
		$this->Post->delete($id);
		$this->Notification->setFlash('Le contenu a bien été supprimé', 'success'); 
		$this->redirect('admin/posts/index'); 
	}

	function admin_test(){
		if($this->request->data && !empty($this->request->data) ){
			debug($this->request->data);
			debug($_FILES);

			$imgDir = "img/galerie/test/";
			if(!file_exists($imgDir)) MakePath($imgDir,false, 0777); 

			$ext = substr($_FILES['file']['name'], -4);
			$imageName = generateRandomString();
			$image = $imgDir.$imageName.time().$ext;

			move_uploaded_file($_FILES['file']['tmp_name'], $image);
			debug(pathinfo($image));
			$imgData = Images::SetImgBDD($image);


		} else {

			// $imgData = Images::GetImgBDD("img/galerie/test/puDEg8ai2AUrmTfFjsc71435428485.jpg");
			// $d['img'] = "galerie/test/puDEg8ai2AUrmTfFjsc71435428485.jpg";
			// $imgData = Images::GetImgBDD("img/galerie/test/nc6KJo7mhLPtQfXO4NBu1435428386.jpg");
			// $d['img'] = "galerie/test/nc6KJo7mhLPtQfXO4NBu1435428386.jpg";
			// $this->set($d);
			 
			$email = "radouane.lahmidi@gmail.com";
			$password = "neji-sama";
			
			$mega = new Mega_API();
			$file = "img/galerie/test/0CEk8eQyYgGOJDPuLRF11386252356.jpg";
			// debug($mega->login($email, $password));
			debug($mega->upload($email, $password, $file));

			// if(!file_exists("tmp/Mega/01/megasession")){
				$mega = new MEGA();
				$test = $mega->user_login_session($email, $password);
				debug($test);

			// 	debug($mega->client_stdClass, "stdclient");
			// 	// $test2 = $mega->session_save($mega->client_stdClass);
			// 	$test2 = $mega->session_save($mega);
			// 	debug($test2, 'save session');

			// 	debug($mega->u_k, "mega master key");

			// 	$this->Cache->write("megasession", $test2, "tmp/Mega/01", true);	
			// }else {
				
			// 	$mega = new MEGA();
			// 	$session = $this->Cache->read("tmp/Mega/01/megasession", true);
			// 	debug($session);
			// 	$mega->create_from_session($session);
			// }




			// $file_info = $mega->public_file_info($ph, $key);
			// debug($file_info);

			// Print filename and size
			// debug('Filename: ' . $file_info['at']['n']);
			// debug('Size: ' . $file_info['s']);
		}
	}

	/**
	* Permet de lister les contenus
	**/
	function admin_tinymce(){
		$this->loadModel('Post');
		$this->layout = 'modal'; 
		$d['posts'] = $this->Post->find();
		$this->set($d);
	}


      
}