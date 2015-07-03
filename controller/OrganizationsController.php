<?php 
class OrganizationsController extends Controller{
	
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
	// function category($slug){
	// 	$this->loadModel('Category'); 
	// 	$category = $this->Category->findFirst(array(
	// 		'conditions' => array('slug' => $slug),
	// 		'fields'     => 'id,name'
	// 	));
	// 	if(empty($category)){
	// 		$this->e404();
	// 	}
	// 	$perPage = 100; 
	// 	$this->loadModel('Post');
	// 	$condition = array('online' => 1,'type'=>'post','category_id' => $category->id); 
	// 	$d['posts'] = $this->Post->find(array(
	// 		'conditions' => $condition,
	// 		'fields'     => 'Post.id,Post.name,Post.slug,Post.created,Post.category_id as catname,Post.content',
	// 		'order'      => 'created DESC',
	// 		'limit'      => ($perPage*($this->request->page-1)).','.$perPage
	// 	));
	// 	$d['total'] = $this->Post->findCount($condition); 
	// 	$d['page'] = ceil($d['total'] / $perPage);
	// 	$d['title'] = 'Tous les articles "'.$category->name.'"'; 
	// 	$this->set($d);
	// 	// Le système est le même que la page index alors on rend la vue Index
	// 	$this->render('index'); 
	// }

	/**
	* Affiche un article en particulier
	**/
	function view($id,$slug){	
		if(!$this->Cache->read(Cache::AUTHOR.DS.$slug.DS.$slug)){			
			$this->loadModel('Author');
			$d['author']  = $this->Author->findFirst(array(
				'fields'	 => 'Author.id,Author.slug,Author.firstName,Author.lastName,Author.website,Author.organization, Author.bio_'.strtoupper(Language::$curLang),
				'conditions' => array('Author.id'=>$id,'Author.type'=>'individual')
			));

			$cacheDir = Cache::AUTHOR.DS.$d['author']->slug;
			$this->Cache->write($d['author']->slug, $d['author'], $cacheDir, true);
		} else {
			$d['author'] = $this->Cache->read(Cache::AUTHOR.DS.$slug.DS.$slug, true);
		}	
		$this->SetHits(Cache::AUTHOR.DS.$slug.DS.$slug);

		if(empty($d['author'])){
			$this->e404('Page introuvable'); 
		}
		if($slug != $d['author']->slug){
			$this->redirect("authors/view/id:$id/slug:".$d['author']->slug,301);
		}
		$this->set($d);
	}
	
	/**
	* ADMIN  ACTIONS
	**/
	/**
	* Liste les différents articles
	**/
	function admin_index(){
		$GLOBALS['title_for_layout'] = "Index organisations";
		$perPage = 100; 
		$this->loadModel('Author');
		$condition = "type = 'organization' AND firstName != 'other'"; 
		$d['organizations'] = $this->Author->find(array(
			'fields'     => 'Author.id,Author.firstName',
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
		$GLOBALS['title_for_layout'] = "Edit organization";
		$this->loadModel('Author'); 
		if($id === null){
			$id = "";
		}
		$d['id'] = $id; 
		if($this->request->data){
			if($this->Author->validates($this->request->data)){
				$this->request->data->type = 'organization';
				$slug = makeSlug($this->request->data->firstName.$this->request->data->firstName);
				$this->request->data->slug = $slug;

				$preDir = "tmp/Organization/";
				Images::checkImg($this, $_FILES['file'], null, true, array('directory' => $preDir.$slug, 'imgName' => $slug, "convert" => true));

				$this->Author->save($this->request->data);
				$cacheDir = Cache::ORGANIZATION.DS.$slug;
				$this->Cache->write($slug, $this->request->data, $cacheDir, true);
				$this->Notification->setFlash('Le contenu a bien été modifié', 'success'); 
				$this->redirect('admin/organizations/index'); 
			}else{
				$this->Notification->setFlash('Merci de corriger vos informations','error');  
				foreach ($this->Form->errors as $error => $value) {
					$this->Notification->setFlash($value,'error', false, array("title" => ucfirst($error))); 
				}
			}
			
		}else {
			$this->request->data = $this->Author->findFirst(array(
				'conditions' => array('id'=>$id)
			));
		}
		$this->set($d);
	}

	/**
	* Permet de supprimer un article
	**/
	function admin_delete($id){
		$this->loadModel('Author');
		$this->Author->delete($id);
		$this->Notification->setFlash('L\'organization a bien été supprimé', 'success'); 
		$this->redirect('admin/organizations/index'); 
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