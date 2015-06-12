<?php
class SearchController extends Controller{	

	protected function SearchInBdd($filter, $keyWord, $options = array()){
		debug('<br><br><br><br><br><br>');
		$searchResults = array();
		$availableResults = array();
		$contentArray = ['content', 'description'];
		$userArray = ['user', 'user_id', 'auteur', 'club'];

		//option = table => [['fetched row'], date column, [fields to not omit but add in case of preview]], users doens't have any since users are always displayed first
		$optionsDefault = array(
					'preview' => false, 
					'searchIn' => array(
						'User' => [
							['login'], 
							'date', 
							['id', 'role']
						],
						'Post' => [
							['name', 'content', 'user_id'], 
							'created', 
							['id', 'online', 'type', 'category_id', 'slug', 'created']
						],
						'Media' => [
							['name', 'user'], 
							'date', 
							['id', 'file', 'post_id', 'type', 'album', 'date']
						],
						'Event' => [
							['auteur', 'titre', 'description'], 
							'toDate', 
							['id', 'slug', 'fromDate', 'toDate', 'type', 'location']
						],
						'Site' => [
							['title', 'club', 'content'], 
							'date', 
							['id', 'location', 'type', 'date']
						],
						'MapInfo' => [
							['adresse', 'department_name', 'region'], 
							'date', 
							['id', 'maps_id', 'lat', 'lng', 'adresse']
						]
					)
				);
		if(array_key_exists('searchIn', $options))
			$options['searchIn'] = array_merge($optionsDefault['searchIn'], $options['searchIn']);
		$options = array_merge($optionsDefault, $options);

		$keyWord = explode("+", $keyWord);
		foreach ($options['searchIn'] as $bdd => $row) {
			$row = $row[0];
			if( ( ($bdd == ucfirst($filter) || $filter == "all") || ($filter == "maps" && ($bdd == "MapInfo" || $bdd == "Site") ) ) && (is_array($row) && !empty($row) ) ) {
		
				$this->loadModel($bdd);
				$condition = array();
				$cond = array();

				$fields = $row;
				foreach ($row as $rowKey => $column) {
					if($filter == "all" && in_array($column, $userArray))
						continue;

					foreach ($keyWord as $wordkey => $word) {
						if(!in_array($column, $contentArray))	
							$word = "%$word%";
						else
							$word = "% $word %";
						$cond[] = $column.' LIKE "'.mysql_real_escape_string($word).'"';
					}

					if(count($options['searchIn'][$bdd]) >= 3 && in_array($column, $contentArray)){ //if column is in omit array : delete it
						unset($fields[$rowKey]);
					}
				}
				$condition = implode(' OR ',$cond);

				if($bdd == "Event"){
        			$limitDate = strtotime(date('d-m-Y', time())." 00:00:00");
					$condition = '('.$condition.') AND toDate >= '.$limitDate;
				} elseif($bdd == "Post"){
					$condition = '('.$condition.') AND online = 1 AND type = "post"';
				} elseif($bdd == "Media") {
					$mediaColumn = "user";
					$userCondition = "";
					foreach ($keyWord as $wordkey => $word) {
						if(!in_array($column, $contentArray))	
							$word = "%$word%";
						else
							$word = "% $word %";

						if($wordkey == 0 && count($keyWord) > 1)
							$userCondition .= $mediaColumn.' LIKE "'.mysql_real_escape_string($word).'" OR ';
						elseif ($wordkey == (count($keyWord)-1))
							$userCondition .= $mediaColumn.' LIKE "'.mysql_real_escape_string($word).'"';
					}

					$mediaColumn = "name";
					$nameCondition = "";
					foreach ($keyWord as $wordkey => $word) {
						if(!in_array($column, $contentArray))	
							$word = "%$word%";
						else
							$word = "% $word %";

						if($wordkey == 0 && count($keyWord) > 1)
							$nameCondition .= $mediaColumn.' LIKE "'.mysql_real_escape_string($word).'" OR ';
						elseif ($wordkey == (count($keyWord)-1))
							$nameCondition .= $mediaColumn.' LIKE "'.mysql_real_escape_string($word).'"';
					}

					if($filter == 'all'){
						$condition = "(((type = 'img' AND album = '') OR (type = 'album' AND album != '')) AND post_id IS NULL AND ( type = 'album' AND ($nameCondition) ) )";
					} else {
						$condition = "(((type = 'img' AND album = '') OR (type = 'album' AND album != '')) AND post_id IS NULL AND ( $userCondition OR (type = 'album' AND ($nameCondition) ) ) )";
					}		
				} 

				$bddConditions = array(
					'CustomCondition' => ' LIKE ',
					'conditionOperator' => 'OR',
					'conditions' => $condition
				);
				if($options['preview']){
					$fields = array_merge($fields, $options['searchIn'][$bdd][2]);
					$bddConditions['fields'] = implode(",", $fields);
				} 

				$results = $this->$bdd->find($bddConditions);

				if($bdd == "Media"){

					$mediaUsers = array();
					$mediaSearchResults = array();
					$limitMedia = 4;
					foreach ($results as $resultKey => $result) {
						if (!array_key_exists($result->user, $mediaUsers)) {
							$mediaUsers[$result->user]['nbImgs'] = 1;
							$mediaUsers[$result->user]['date'] = $result->date;
							$mediaUsers[$result->user]['id'] = $result->id;
							$mediaUsers[$result->user]['searchId'] = $result->date.'-Media-'.$result->id;
							$mediaUsers[$result->user]['user'] = $result->user;
							$mediaSearchResults[$result->user][] = $result;
							if($result->type == "album"){
								$mediaUsers[$result->user]['onlyAlbums'] = true;
							} else {
								$mediaUsers[$result->user]['onlyAlbums'] = false;
							}

							$countCond = "(((type = 'img' AND album = '') OR (type = 'album' AND album != '')) AND post_id IS NULL AND user = '".mysql_real_escape_string($result->user)."' )";
							$mediaSearchResults[$result->user]['userCount'] = $this->Media->findCount($countCond); 

							$searchResults[$mediaUsers[$result->user]['searchId']] = $mediaSearchResults;
						} else if(array_key_exists($result->user, $mediaUsers) && ($mediaUsers[$result->user]['nbImgs'] < $limitMedia || $mediaUsers[$result->user]['onlyAlbums']) ){
							$mediaUsers[$result->user]['nbImgs']++;
							if($result->date > $mediaUsers[$result->user]['date']) {
								$mediaUsers[$result->user]['date'] = $result->date;
								$mediaUsers[$result->user]['id'] = $result->id;

								$mediaSearchResults[$result->user][] = $result;

								unset($searchResults[$mediaUsers[$result->user]['searchId']]);
								$mediaUsers[$result->user]['searchId'] = $result->date.'-Media-'.$result->id;
								$searchResults[$mediaUsers[$result->user]['searchId']] = $mediaSearchResults;
							} else {
								$mediaSearchResults[$result->user][] = $result;

								unset($searchResults[$mediaUsers[$result->user]['searchId']]);
								$searchResults[$mediaUsers[$result->user]['searchId']] = $mediaSearchResults;
							}
							if($result->type != "album"){
								$mediaUsers[$result->user]['onlyAlbums'] = false;
							} 
						}
					}

					foreach ($mediaUsers as $mediaUser => $userMediaInfo) {
						if($userMediaInfo['onlyAlbums'] && $userMediaInfo['nbImgs'] >= 1){
							unset($searchResults[$userMediaInfo['searchId']]);
							foreach ($mediaSearchResults[$mediaUser] as $mediaKey => $userMediaArray) {
								if(is_array($userMediaArray) || is_object($userMediaArray)){
									$albumName = $userMediaArray->date.'-Media-'.$userMediaArray->id;
									$searchResults[$albumName] = $userMediaArray;
								}
							}
						}
					}
				}

				if($bdd == "MapInfo" && !empty($results)){
					$mapResults = array();	
					foreach ($results as $resultKey => $result) {	
						$this->loadModel('Map');
						$mapResults  = $this->Map->findFirst(array(
							'conditions' => array('id'=>$result->maps_id)
						)); 
						if($mapResults->event == "club"){
							$mapResults->event = 'user';
						} elseif($mapResults->event == "event"){
							$mapResults->auteur = $mapResults->club;
							unset($mapResults->club);
							$mapResults->titre = $mapResults->title;
							$mapResults->slug = makeSlug($mapResults->titre, 200);
							unset($mapResults->title);
							$mapResults->description = $mapResults->content;
							unset($mapResults->content);
							$mapResults->toDate = $mapResults->date;
						}

						$resultArrayKey = $mapResults->date.'-'.ucfirst($mapResults->event).'-'.$mapResults->id_event;
						if (!array_key_exists($resultArrayKey, $searchResults)) {
							$mapResults->id = $mapResults->id_event;
							$searchResults[$resultArrayKey] = $mapResults;
						}
					}
				}


				if(!empty($results) && $bdd != "MapInfo" && $bdd != "Media"){
					foreach ($results as $resultKey => $result) {
						if($bdd != "User"){
							$resultArrayKey = $result->$options['searchIn'][$bdd][1].'-'.$bdd.'-'.$result->id;
							$searchResults[$resultArrayKey] = $result;
						} else {
							$resultArrayKey = '9999999999-'.$bdd.'-'.$result->id;
							$searchResults[$resultArrayKey] = $result;
						}
					}
					array_push($availableResults, $bdd);
				}
			}
		}

		if(empty($searchResults)){
			$searchResults['EMPTY'] = true;
		}

		ksort($searchResults);
		$searchResults = array_reverse($searchResults);

		return $searchResults; 
	}

	public function index($filter, $keyWord, $options = array()){
		$d['searchResults'] = $this->SearchInBdd($filter, $keyWord, $options);
		debug($d['searchResults']);

		$this->set($d);
	}

	public function preview($filter, $keyWord, $options = array()){
		$d['searchResults'] = $this->SearchInBdd($filter, $keyWord, array('preview' => true));
		debug($d['searchResults']);
		
		$this->set($d);
	}

}