<?php
class Model{
	
	static $connections = array(); 

	public $conf = 'default';
	public $table = false; 
	public $db; 
	public $primaryKey = 'id'; 
	public $id; 
	public $errors = array();
	public $form; 
	public $validate = array();

	/**
	* Permet d'initialiser les variable du Model
	**/
	public function __construct(){
		// Nom de la table
		if($this->table === false){
			$this->table = strtolower(get_class($this)).'s'; 
		}
		
		// Connection à la base ou récupération de la précédente connection
		$conf = Conf::$databases[$this->conf];
		if(isset(Model::$connections[$this->conf])){
			$this->db = Model::$connections[$this->conf];
			return true; 
		}
		try{
			$pdo = new PDO(
				'mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
				$conf['login'],
				$conf['password'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

			Model::$connections[$this->conf] = $pdo; 
			$this->db = $pdo; 
		}catch(PDOException $e){
			if(Conf::$debug >= 1){
				die($e->getMessage()); 
			}else{
				die('Impossible de se connecter à la base de donnée'); 
			}
		}	 
	}

	/**
	* Permet de valider des données
	* @param $data données à valider 
	**/
	function validates($data){
		$errors = array(); 
		foreach($this->validate as $k=>$v){
				if(!isset($data->$k)){
					$errors[$k] = $v['message']; 
				}else{
					if($v['rule'] == 'notEmpty'){
						if(empty($data->$k)){
							$errors[$k] = $v['message']; 
						}
					}elseif($v['rule'] == 'email'){
						if(!filter_var($data->$k, FILTER_VALIDATE_EMAIL)){
							$errors[$k] = $v['message']; 
						}
					}elseif(is_array($v['rule'])){
						if(!in_array($k, $v['rule']))
							$errors[$k] = $v['message'];
					}elseif(!preg_match('/^'.$v['rule'].'$/',$data->$k)){
						$errors[$k] = $v['message'];
					}
				}
		}
		$this->errors = $errors; 
		if(isset($this->Form)){
			$this->Form->errors = $errors; 
		}
		if(empty($errors)){
			return true;
		}
		return false;
	}



	/**
	* Permet de récupérer plusieurs enregistrements
	* @param $req Tableau contenant les éléments de la requête
	**/
	public function find($req = array()){
		$sql = 'SELECT ';

		if(isset($req['fields'])){
			if(is_array($req['fields'])){
				$sql .= implode(', ',$$req['fields']);
			}else{
				$sql .= $req['fields']; 
			}
		}else{
			$sql.='*';
		}

		$sql .= ' FROM '.$this->table.' as '.get_class($this).' ';

		// Liaison
		if(isset($req['join'])){
			foreach($req['join'] as $k=>$v){
				$sql .= 'RIGHT JOIN '.$k.' ON '.$v.' '; 
			}
		}

		// Construction de la condition
		if(isset($req['conditions']) && !empty($req['conditions'])){
			$sql .= 'WHERE ';
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions']; 
			} else {
				$cond = array(); 
				foreach($req['conditions'] as $k=>$v){
					if(!is_numeric($v)){ //if condition is string, escape characters
						$v = $this->db->quote($v); 
						// $v = '"'.mysql_real_escape_string($v).'"'; 
					}
					if(isset($req['CustomCondition']) && !empty($req['CustomCondition'])){
						$cond[] = $k.$req['CustomCondition'].$v;
					} else{
						$cond[] = "$k=$v";
					}
				}
				if(isset($req['conditionOperator'])){
					$sql .= implode(' '.$req['conditionOperator'].' ',$cond);
				} else {
					$sql .= implode(' AND ',$cond);
				}
			}
		}

		if(isset($req['order'])){
			$sql .= ' ORDER BY '.$req['order'];
		}


		if(isset($req['limit'])){
			$sql .= ' LIMIT '.$req['limit'];
		}

		$pre = $this->db->prepare($sql); 
		$pre->execute(); 
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	* Alias permettant de retrouver le premier enregistrement
	**/
	public function findFirst($req = ""){
		return current($this->find($req)); 
	}

	/**
	* Récupère le nombre d'enregistrement
	**/
	public function findCount($conditions = null){
		$res = $this->findFirst(array(
			'fields' => 'COUNT('.$this->primaryKey.') as count',
			'conditions' => $conditions
			));
		return $res->count;  
	}

	/**
	* Permet de récupérer un tableau indexé par primaryKey et avec name pour valeur
	**/
	function findList($req = array(), $fieldName = "name"){
		if(!isset($req['fields'])){
			if(!isset($req['fieldName']))
				$req['fields'] = $this->primaryKey.',name';
			elseif(isset($req['fieldName']) && !empty($req['fieldName']))
				$req['fields'] = $this->primaryKey.','.$fieldName;
		}
		$d = $this->find($req);
		$r = array(); 
		foreach($d as $k=>$v){
			//when getting more than two fields, we need a way to get all the data
			//the way this works is it first count the number of fields we get
			//if there are more than two fields, the user can specify a string
			//that string will be used to format all fields' data
			//Ex : i have requested 3 fields id, field1, field2 
			//which correspond to the data id, data1, data2
			//I want to return an array with the id as the key and the rest as the value
			//the $req['formatProperties'] then needs to be 'field1, ,field2'
			//the comma separating each field and the whitespaces are added as is
			//this will will return an array : id=> 'data1 data2'
			$nbProperties = count(get_object_vars($v)); 
			if($nbProperties > 2 && isset($req['formatProperties']) && $req['formatProperties']!= ""){
				$properties = explode(",", $req['formatProperties']);
				$endVal = "";
				foreach ($properties as $p => $val) {
					if($val != " "){
						$val = trim($val);
						if(isset($v->$val) && !empty($v->$val))
							$endVal .= $v->$val;
					} elseif(!isset($v->$val) && $val == " "){
						$endVal .= $val;
					}
				}
				$r[current($v)] = $endVal; 
			} else {
				//this works when getting only two fields	
				//get the first field as key and the second as value	
				$r[current($v)] = next($v); 	
			}
		}
		return $r; 
	}

	/**
	* Permet de supprimer un enregistrement
	* @param $id ID de l'enregistrement à supprimer
	**/	
	public function delete($id){
		$sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id";
		$this->db->query($sql); 
	}


	/**
	* Permet de sauvegarder des données
	* @param $data Données à enregistrer
	**/
	public function save($data){
		$key = $this->primaryKey;
		$fields =  array();
		$d = array(); 
		foreach($data as $k=>$v){
			if($k!=$this->primaryKey){
				$fields[] = "$k=:$k";
				$d[":$k"] = $v; 
			}elseif(!empty($v)){
				$d[":$k"] = $v; 
			}
		}
		if(isset($data->$key) && !empty($data->$key)){
			$sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'=:'.$key;
			$this->id = $data->$key; 
			$action = 'update';
		} else{
			$sql = 'INSERT INTO '.$this->table.' SET '.implode(',',$fields);
			$action = 'insert'; 
		}
		$pre = $this->db->prepare($sql); 
		$pre->execute($d);
		if($action == 'insert'){
			$this->id = $this->db->lastInsertId(); 
		}

      	$cacheDir = Cache::DUMP.DS."BDD";
      	$ctrl = new Controller;
      	$ctrl->Cache->write("LastModBDD", time(), $cacheDir, true);
	}

}