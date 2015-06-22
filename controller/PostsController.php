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
			'fields'     => 'Post.id,Post.name,Post.online,Post.created,Post.category_id as catname',
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
				$this->request->data->type = 'post';
				$this->request->data->slug = makeSlug($this->request->data->title_FR, 200);
				// $this->request->data->slug = url_slug($this->request->data->name, array( 'limit' => 200));
				$this->request->data->user_id = $_SESSION['User']->login;
				$this->request->data->publication = new DateTime($this->request->data->publication);
				$this->request->data->publication = $this->request->data->publication->getTimestamp();
				// $d = new DateTime();
				// $d->setTimestamp($this->request->data->publication);
				// $d->format('U = Y-m-d H:i:s');
				$this->request->data->created = time();

				debug($this->request->data);
				die();
				$preDir = "tmp/Post/";
				if(Images::checkImg($this, $_FILES['file'], null, true, array('directory' => $preDir.$this->request->data->slug, 'imgName' => $this->request->data->slug, "convert" => true, "resize" => true))){
					unlink($preDir.$this->request->data->slug."/".$this->request->data->slug.".jpg");
				}

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
		sleep(5);
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

				$returnArray = array("error"=> false, "html" => $html, "imgData" => $imgData);
				$returnArray = json_encode($returnArray);

				// die($returnArray); 
				die('{"error":false, "html": "'.$html.'", "imgData" : "'.$imgData.'"}');
			} else {
				die('{"error":true, "html": "Le fichier n\'est pas une image"}');
			}	
		}
		die('{"error":true, "une erreur est survenu"}');	
	}

	function admin_delete_img($id, $file){
		// unlink(WEBROOT.DS.'img'.DS.'galerie'.DS.$id.DS.$file);
		// $imgInfo = pathinfo($file);
		// $imgName = $imgInfo['basename'];
		// $imgDir = $imgInfo['dirname'];
		// $imgNameExt = str_replace(".".$imgInfo['extension'], "", $imgName);	
		$imgDir = WEBROOT.DS.'img'.DS.'galerie'.DS.$id.DS;
		// unlink($imgDir.DS."grayscale_".$imgNameExt."_180x135.".$imgInfo['extension']);
		// unlink(WEBROOT.DS.'img'.DS.$imgDir.DS.$imgNameExt."_180x135.".$imgInfo['extension']);
		// unlink(WEBROOT.DS.'img'.DS.'galerie'.DS.$id.DS.$file);
		


		//show existing imgs when editiong post
		//add function to delete imgs
		//also delete imgs from database
		//correct css for imgs
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