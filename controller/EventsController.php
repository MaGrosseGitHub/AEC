<?php 
class EventsController extends Controller{

    public $days       = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi','Dimanche');
    public $months     = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
	public $year;
	public $thisYear;
	public $years = array();

	private $limitDate, $limitMonth, $limitYear;
	/**
	* Blog, liste les articles
	**/
	function index($year = null){		
        $limitDate = strtotime(date('d-m-Y', time())." 00:00:00");
        $limitMonth = intval(date('n', time()));
        $limitYear = intval(date('Y', time()));
        $this->limitDate = $limitDate;
        $this->limitMonth = $limitMonth;
        $this->limitYear = $limitYear;
        $d['limitDate'] = $limitDate;
        $d['limitMonth'] = $limitMonth;
        $d['limitYear'] = $limitYear;

		$this->loadModel('Event');
		$condition = array('toDate'=>$limitDate);
		$d['events'] = $this->Event->find(array(
			'fields'     => 'id,auteur,titre,type,fromDate,toDate',
			'conditions' => $condition,
			'CustomCondition' => '>='
		));

        $nextMonth = array(); 
        $usersArray = array("Users"); 
        $intervalArray = array(); 
        $eventMonths = array();
        $newFromDate = "";
        $newToDate = "";

        $limitToDate = 0;
        $limitFromDate = 0;
        foreach ($d['events'] as $k => $v){
			$newEntry = array(
				'id' => $v->id, 
				'auteur' => $v->auteur,
				// 'description' => $v->description, 
				'titre' => $v->titre, 
				'type' => $v->type,
				'from' => $v->fromDate, 
				'to' => $v->toDate
			);
			if($limitToDate == 0 || $limitToDate >= $v->toDate){
				$limitToDate = $v->toDate;
			}
			if($limitFromDate == 0 || $limitFromDate >= $v->fromDate){
				$limitFromDate = $v->fromDate;
			}
			if(date('n', $v->fromDate) != date('n', $v->toDate) )
				$newEntry['nextMonth'] = true;
			$newEvents[$v->auteur]['events'][] = $newEntry; 
			$newEventsEntry = count($newEvents[$v->auteur]['events'])-1;
			// $CheckEvents[$v->fromDate] = $v->auteur.'===>'.$newEventsEntry;
			$intervalArray[$v->auteur.'==>'.$newEventsEntry] = $v->toDate;
			if(!in_array($v->auteur, $usersArray))
				array_push($usersArray, $v->auteur); 
			if(!in_array(intval(date('n', $limitFromDate)), $eventMonths))
				array_push($eventMonths, intval(date('n', $limitFromDate))); 

        }

        $prevYear = false;
        if(date('Y', $limitFromDate) < $limitYear){
        	$prevYear = true;
        }
        if($limitYear <= date('Y', $limitFromDate) && date('n', $limitFromDate) <= $limitMonth){
        	$limitMonth = date('n', $limitFromDate);
        	$limitYear = date('Y', $limitFromDate);
        }
        $this->limitMonth = $limitMonth;
        $d['limitMonth'] = $limitMonth;
        $this->limitYear = $limitYear;
        $d['limitYear'] = $limitYear;


        $d['nextMonth'] = $nextMonth;
        $d['usersArray'] = $usersArray;
        $d['intervalArray'] = $intervalArray;
        $d['newEvents'] = $newEvents;
        $d['newEventsEntry'] = $newEventsEntry;
        $d['eventMonths'] = $eventMonths;
        // $d[''] = $;

        $d['calendar'] = $this->getAll($year, $prevYear);
		$d['year'] = $this->year;
		$d['thisYear'] = $this->thisYear;
        $d['years'] = $this->years;
		$this->set($d);
	}

	/**
	* Affiche les evenements d'un utilisateur en particulier
	**/
	function view($user,$year = null){
        $limitDate = strtotime(date('d-m-Y', time())." 00:00:00");
        $limitMonth = intval(date('n', time()));
        $this->limitDate = $limitDate;
        $this->limitMonth = $limitMonth;
        $d['limitDate'] = $limitDate;
        $d['limitMonth'] = $limitMonth;

		$this->loadModel('Event');
		// $condition = array('auteur'=>$user);
		$condition = "auteur = '$user'";
		$d['userEvents']  = $this->Event->find(array(
			'fields'     => 'id,auteur,titre,type,fromDate,toDate',
			'conditions' => $condition
		)); 

		$d['total'] = $this->Event->findCount($condition); 

		if(empty($d['userEvents'])){
			$this->e404('Page introuvable'); 
		}

        $nextMonth = array();
        foreach ($d['userEvents'] as $id => $event) {
          $newEntry = array(
                            'id' => $event->id, 
                            'titre' => $event->titre, 
                            'from' => $event->fromDate, 
                            'to' => $event->toDate
                            );

          $monthFrom = date('n', $newEntry['from']); 
          $monthTo = date('n', $newEntry['to']); 
          if($monthFrom == $monthTo) {            
            $nextMonth[$monthFrom][] = $newEntry;
          } else {                    
            $nextMonth[$monthFrom][] = $newEntry;
            $nextMonth[$monthTo][] = $newEntry;
          }
        }

        $d['nextMonth'] = $nextMonth;
        $d['newEntry'] = $newEntry;
        $d['monthFrom'] = $monthFrom;
        $d['monthTo'] = $monthTo;

        $d['calendar'] = $this->getAll();
		$d['year'] = $this->year;	
        $d['years'] = $this->years;
		$d['user'] = $user;
		$d['thisYear'] = $this->thisYear;	
		$this->set($d);
	}

	/**
	* Affiche un evenement en particulier
	**/
	function event($id, $slug){
		$this->loadModel('Event');
		$d['userEvent']  = $this->Event->findFirst(array(
			'fields'	 => '*',
			'conditions' => array('id'=>$id)
		));

		if(empty($d['userEvent'])){
			$this->e404('Page introuvable'); 
		}

		if($slug != $d['userEvent']->slug){
			$this->redirect("events/event/id:$id/slug:".$d['userEvent']->slug,301);
		}		

		$this->loadModel('Participate');
		$d['Participation'] = $this->Participate->findCount(); 
		$this->set($d);
	}


	/**
	* Créer le calendrier
	**/
    function getAll($year = null, $prevYear = false){
        $cal = array();
        $years = array();
		$this->thisYear = date('Y');	

		if(!isset($year)) {
			if(date('n') >= 8)
				$year = date('Y')+1;
			else
				$year = date('Y');

			$this->year = $year;
		} else {
			$this->year = $year;
		}

        if($prevYear)
        	$date = new DateTime(($this->limitYear).'-01-01');
        else
        	$date = new DateTime($this->thisYear.'-01-01');
        // debug($date->format('Y'), "date->format('Y')");
        // debug($year, 'year');
        // debug($this->limitMonth, 'limitMonth');
        // debug($this->limitYear, 'limitYear');
        while($date->format('Y') <= ($year+1)){
            // Ce que je veux => $r[ANEEE][MOIS][JOUR] = JOUR DE LA SEMAINE
            $y = $date->format('Y');
	        $m = $date->format('n');
            if(($y == $this->limitYear && $m >= $this->limitMonth) || ($y >= $this->thisYear && $this->limitYear != $this->thisYear)){
	            if(!in_array($y,$years))
	            	array_push($years, $date->format('Y'));
	            $day = $date->format('j');
	            $w = str_replace('0','7',$date->format('w'));
	            $cal[$y][$m][$day] = $w;
            }
	        $date->add(new DateInterval('P1D'));
        }
        $this->years = $years;
        return $cal; 
    }

	/**
	* Gérrer les participations
	**/
	function participate($id){
		if(!isset($id) || empty($id)){
			$this->e404('Page introuvable'); 
		}

		$this->loadModel('Participate');

		if($this->request->data){
			if($this->Participate->validates($this->request->data)){
				$CheckParticipate = $this->Participate->findFirst(array(
					'conditions' => array('id_event' => $id,'nom' => $this->request->data->nom,'prenom' => $this->request->data->prenom,'email' => $this->request->data->email, 'tel' => $this->request->data->tel,
				)));	

				if(!empty($CheckParticipate)) {
					foreach ($this->request->data as $key => $value) {
						if($CheckParticipate->$key != $this->request->data->$key) {
							$this->Form->errors["exists"] = "Vous déjà inscrit à cette événement";
							return false;
						}
					}
				}	 
				$this->Participate->save($this->request->data);
				unset($this->request->data->id_event);
				$encryptData = new Encrypt();
				$userData = $encryptData->encryptData($this->request->data,true);
				Cookies::write('userData',$userData);
			}
		}

		$d['Participation'] = $this->Participate->findCount(); 
		$this->set($d);
	}
	
	/**
	* ADMIN  ACTIONS
	**/
	/**
	* Liste les différents articles
	**/
	function admin_index(){
		$perPage = 10; 
		$this->loadModel('Event');
		$d['posts'] = $this->Event->find(array(
			'fields'     => '*',
			'order' 	 => 'fromDate DESC'
		));
		$d['total'] = $this->Event->findCount(); 
		$this->set($d);
	}

	/**
	* Permet d'éditer un article
	**/
	function admin_edit($id = null){
		$this->loadModel('Event'); 
		if($id === null){
			$id = "";
		}
		$d['id'] = $id; 
		if($this->request->data){
			if($this->Event->validates($this->request->data)){
				$this->request->data->fromDate = intval(strtotime($this->request->data->fromDate));
				$this->request->data->toDate = intval(strtotime($this->request->data->toDate));

				$this->request->data->slug = makeSlug($this->request->data->titre, 200);
				$this->Event->save($this->request->data);
				$this->Notification->setFlash('Le contenu a bien été modifié', 'success'); 
				$this->redirect('admin/events/index'); 
			}else{
				$this->Notification->setFlash('Merci de corriger vos informations','error'); 
			}
			
		}else{
			$this->request->data = $this->Event->findFirst(array(
				'conditions' => array('id'=>$id)
			));
		}
		$this->loadModel('Category');
		$d['categories'] = $this->Category->findList(); 
		$this->set($d);
	}

	/**
	* Permet de supprimer un article
	**/
	function admin_delete($id){
		$this->loadModel('Event');
		$this->Event->delete($id);
		$this->Notification->setFlash('Le contenu a bien été supprimé', 'success'); 
		$this->redirect('admin/events/index'); 
	}

	/**
	* Permet de lister les contenus
	**/
	function admin_tinymce(){
		$this->loadModel('Event');
		$this->layout = 'modal'; 
		$d['events'] = $this->Event->find();
		$this->set($d);
	}

}