<?php 
class AuthorsController extends Controller{
	
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
		$fields = ['id', 'name', 'created', 'online', 'type', 'slug', 'user_id', 'category_id'];
		$fields = implode(",", $fields).', LEFT(content, 500) as content';
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
		$this->SetHits(Cache::POST.DS.$slug.DS.$slug);

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
		$this->loadModel('Author');
		$condition = array('type'=>'individual'); 
		$d['posts'] = $this->Author->find(array(
			'fields'     => 'Author.id,Author.firstName,Author.lastName,Author.organization',
			'order' 	 => 'id DESC',
			'conditions' => $condition,
			'limit'      => ($perPage*($this->request->page-1)).','.$perPage
		));
		$d['total'] = $this->Author->findCount($condition); 
		$d['page'] = ceil($d['total'] / $perPage);
		$this->set($d);
	}

	/**
	* Permet d'éditer un article
	**/
	function admin_edit($id = null){
		$this->loadModel('Author'); 
		if($id === null){
			$id = "";
		}
		$d['id'] = $id; 
		if($this->request->data){
			if($this->Author->validates($this->request->data)){
				$this->request->data->type = 'individual';

				$preDir = "tmp/Author/";
				// if(Images::checkImg($this, $_FILES['file'], null, true, array('directory' => $preDir.$this->request->data->slug, 'imgName' => $this->request->data->slug, "convert" => true, "resize" => true))){
				// 	unlink($preDir.$this->request->data->slug."/".$this->request->data->slug.".jpg");
				// }

				$this->Author->save($this->request->data);
				// $cacheDir = Cache::POST.DS.$this->request->data->slug;
				// $this->Cache->write($this->request->data->slug, $this->request->data, $cacheDir, true);
				$this->Notification->setFlash('Le contenu a bien été modifié', 'success'); 
				$this->redirect('admin/authors/index'); 
			}else{
				$this->Notification->setFlash('Merci de corriger vos informations','error'); 
			}
			
		}else{
			$this->request->data = $this->Author->findFirst(array(
				'conditions' => array('id'=>$id)
			));
		}
		// On veut un sélecteur de catégorie donc on récup la liste des catégories
		$this->loadModel('Category');
		$d['categories'] = $this->Category->findList(); 
		$this->set($d);
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