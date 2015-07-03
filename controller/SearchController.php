<?php
class SearchController extends Controller{	

	protected function SearchInBdd($keyWord, $options = array()){
		debug('<br><br><br><br><br><br>');
		$searchResults = array();
		$availableResults = array();
		$contentArray = ['content_FR', 'content_EN', 'description', 'bio_FR', 'bio_EN'];
		$userArray = ['user', 'user_id', 'auteur'];
		$filter = "all";
		//option = table => [['fetched row'], date column, [fields to not omit but add in case of preview]], users doens't have any since users are always displayed first
		$optionsDefault = array(
					'preview' => false, 
					'searchIn' => array(
						'Post' => [
							['title_FR', 'title_EN', 'content_FR', 'content_EN'], 
							'created', 
							['id', 'online', 'type', 'category_id', 'organization_id', 'author_id', 'slug', 'created']
						],
						'Author' => [
							['firstName', 'lastName', 'bio_EN', 'bio_FR'], 
							'created', 
							['id', 'bio_FR', 'bio_EN', 'website', 'type', 'organization']
						]
					)
				);
		if(array_key_exists('searchIn', $options))
			$options['searchIn'] = array_merge($optionsDefault['searchIn'], $options['searchIn']);
		$options = array_merge($optionsDefault, $options);

		$keyWord = explode("+", $keyWord);
		foreach ($options['searchIn'] as $bdd => $row) {
			$row = $row[0];
			if(is_array($row) && !empty($row)) {
		
				$this->loadModel($bdd);
				$condition = array();
				$cond = array();

				$fields = $row;
				// foreach ($row as $rowKey => $column) {

				// 	foreach ($keyWord as $wordkey => $word) {
				// 		if(!in_array($column, $contentArray))	
				// 			$word = "%$word%";
				// 		else
				// 			$word = "% $word %";
				// 		$cond[] = $column.' LIKE "'.$word.'"';
				// 	}

				// 	if(count($options['searchIn'][$bdd]) >= 3 && in_array($column, $contentArray)){ //if column is in omit array : delete it
				// 		unset($fields[$rowKey]);
				// 	}
				// }
				$condTemp = array();
				foreach ($row as $rowKey => $column) {
					foreach ($keyWord as $wordkey => $word) {
						$cond = array_merge($cond, $this->getLevenshtein1($word));
					}

					foreach ($cond as $condKey => $condVal) {
						$condTemp[] = "(".$column." LIKE '%".$condVal."%')";
					}

					if(count($options['searchIn'][$bdd]) >= 3 && in_array($column, $contentArray)){ //if column is in omit array : delete it
						unset($fields[$rowKey]);
					}
				}
				$cond = $condTemp;

				// foreach ($cond as $condKey => $condVal) {
				// 	$cond[$condKey] = $column.' LIKE '.$condVal;
				// }
				// debug($cond);
				$condition = implode(' OR ',$cond);

				if($bdd == "Post"){
					$condition = '('.$condition.') AND online = 1 AND type = "post"';
				} elseif($bdd == "Author") {
					$condition = '('.$condition.') AND type != "group"';
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

				// debug($bddConditions);
				$results = $this->$bdd->find($bddConditions);
				debug($results);

				// if($bdd == "Media"){

				// 	$mediaUsers = array();
				// 	$mediaSearchResults = array();
				// 	$limitMedia = 4;
				// 	foreach ($results as $resultKey => $result) {
				// 		if (!array_key_exists($result->user, $mediaUsers)) {
				// 			$mediaUsers[$result->user]['nbImgs'] = 1;
				// 			$mediaUsers[$result->user]['date'] = $result->date;
				// 			$mediaUsers[$result->user]['id'] = $result->id;
				// 			$mediaUsers[$result->user]['searchId'] = $result->date.'-Media-'.$result->id;
				// 			$mediaUsers[$result->user]['user'] = $result->user;
				// 			$mediaSearchResults[$result->user][] = $result;
				// 			if($result->type == "album"){
				// 				$mediaUsers[$result->user]['onlyAlbums'] = true;
				// 			} else {
				// 				$mediaUsers[$result->user]['onlyAlbums'] = false;
				// 			}

				// 			$countCond = "(((type = 'img' AND album = '') OR (type = 'album' AND album != '')) AND post_id IS NULL AND user = '".mysql_real_escape_string($result->user)."' )";
				// 			$mediaSearchResults[$result->user]['userCount'] = $this->Media->findCount($countCond); 

				// 			$searchResults[$mediaUsers[$result->user]['searchId']] = $mediaSearchResults;
				// 		} else if(array_key_exists($result->user, $mediaUsers) && ($mediaUsers[$result->user]['nbImgs'] < $limitMedia || $mediaUsers[$result->user]['onlyAlbums']) ){
				// 			$mediaUsers[$result->user]['nbImgs']++;
				// 			if($result->date > $mediaUsers[$result->user]['date']) {
				// 				$mediaUsers[$result->user]['date'] = $result->date;
				// 				$mediaUsers[$result->user]['id'] = $result->id;

				// 				$mediaSearchResults[$result->user][] = $result;

				// 				unset($searchResults[$mediaUsers[$result->user]['searchId']]);
				// 				$mediaUsers[$result->user]['searchId'] = $result->date.'-Media-'.$result->id;
				// 				$searchResults[$mediaUsers[$result->user]['searchId']] = $mediaSearchResults;
				// 			} else {
				// 				$mediaSearchResults[$result->user][] = $result;

				// 				unset($searchResults[$mediaUsers[$result->user]['searchId']]);
				// 				$searchResults[$mediaUsers[$result->user]['searchId']] = $mediaSearchResults;
				// 			}
				// 			if($result->type != "album"){
				// 				$mediaUsers[$result->user]['onlyAlbums'] = false;
				// 			} 
				// 		}
				// 	}

				// 	foreach ($mediaUsers as $mediaUser => $userMediaInfo) {
				// 		if($userMediaInfo['onlyAlbums'] && $userMediaInfo['nbImgs'] >= 1){
				// 			unset($searchResults[$userMediaInfo['searchId']]);
				// 			foreach ($mediaSearchResults[$mediaUser] as $mediaKey => $userMediaArray) {
				// 				if(is_array($userMediaArray) || is_object($userMediaArray)){
				// 					$albumName = $userMediaArray->date.'-Media-'.$userMediaArray->id;
				// 					$searchResults[$albumName] = $userMediaArray;
				// 				}
				// 			}
				// 		}
				// 	}
				// }

				// if($bdd == "MapInfo" && !empty($results)){
				// 	$mapResults = array();	
				// 	foreach ($results as $resultKey => $result) {	
				// 		$this->loadModel('Map');
				// 		$mapResults  = $this->Map->findFirst(array(
				// 			'conditions' => array('id'=>$result->maps_id)
				// 		)); 
				// 		if($mapResults->event == "club"){
				// 			$mapResults->event = 'user';
				// 		} elseif($mapResults->event == "event"){
				// 			$mapResults->auteur = $mapResults->club;
				// 			unset($mapResults->club);
				// 			$mapResults->titre = $mapResults->title;
				// 			$mapResults->slug = makeSlug($mapResults->titre, 200);
				// 			unset($mapResults->title);
				// 			$mapResults->description = $mapResults->content;
				// 			unset($mapResults->content);
				// 			$mapResults->toDate = $mapResults->date;
				// 		}

				// 		$resultArrayKey = $mapResults->date.'-'.ucfirst($mapResults->event).'-'.$mapResults->id_event;
				// 		if (!array_key_exists($resultArrayKey, $searchResults)) {
				// 			$mapResults->id = $mapResults->id_event;
				// 			$searchResults[$resultArrayKey] = $mapResults;
				// 		}
				// 	}
				// }
				

				if(!empty($results)){
					foreach ($results as $resultKey => $result) {
						if(isset($result->$options['searchIn'][$bdd][1]))
							$resultArrayKey = $result->$options['searchIn'][$bdd][1].'-'.$bdd.'-'.$result->id;
						else if($bdd == "Author")
							$resultArrayKey = $result->type.'-'.$bdd.'-'.$result->id;
						else
							$resultArrayKey = $bdd.'-'.$result->id;
						$searchResults[$resultArrayKey] = $result;
					}
					array_push($availableResults, $bdd);
				}
			}
		}

		mb_internal_encoding('UTF-8'); 
		// debug($this->mysql_fuzzy_regex("test prenom ati"), "mysql_fuzzy_regex");
		// debug($this->rlike("test prenom ati"), 'rlike');
		// debug($this->getLevenshtein1("test prenom ati"), 'getLevenshtein1');
		if(empty($searchResults)){
			$searchResults['EMPTY'] = true;
		}

		ksort($searchResults);
		$searchResults = array_reverse($searchResults, "FUZZY");

		return $searchResults; 
	}

	function getLevenshtein1($word)
	{
	    $words = array();
	    for ($i = 0; $i < strlen($word); $i++) {
	        // insertions
	        $words[] = substr($word, 0, $i) . '_' . substr($word, $i);
	        // deletions
	        $words[] = substr($word, 0, $i) . substr($word, $i + 1);
	        // substitutions
	        $words[] = substr($word, 0, $i) . '_' . substr($word, $i + 1);
	    }
	    // last insertion
	    $words[] = $word . '_';
	    return $words;

	    //usage :
	    //SELECT *  FROM `catalog_product_flat_1` WHERE
		// `name` LIKE '%_agento%' OR
		// `name` LIKE '%M_gento%' OR
		// `name` LIKE '%Ma_ento%' OR
		// `name` LIKE '%Mag_nto%' OR
		// `name` LIKE '%Mage_to%' OR
		// `name` LIKE '%Magen_o%' OR
		// `name` LIKE '%Magent_%' OR
		// `name` LIKE '%_Magento%' OR
		// `name` LIKE '%M_agento%' OR
		// `name` LIKE '%Ma_gento%' OR
		// `name` LIKE '%Mag_ento%' OR
		// `name` LIKE '%Mage_nto%' OR
		// `name` LIKE '%Magen_to%' OR
		// `name` LIKE '%Magent_o%' OR
		// `name` LIKE '%Magento_%' OR
		// `name` LIKE '%agento%' OR
		// `name` LIKE '%Mgento%' OR
		// `name` LIKE '%Maento%' OR
		// `name` LIKE '%Magnto%' OR
		// `name` LIKE '%Mageto%' OR
		// `name` LIKE '%Mageno%' OR
		// `name` LIKE '%Magent%'
	}


	function rlike($my_string) {
	    $strlen = strlen( $my_string );
	 
	    for ($i = 0; $i <= $strlen; $i++) {
	        for( $x = 0; $x <= ($strlen -1); $x++ ) {
	            if ($x == $i) {
	                $char ='.';
	            } else {
	                $char = substr( $my_string, $x, 1 );
	            }
	            $rstr[$x] = $char;
	        } 
	        $rlike[$i] = implode($rstr);
	    }
	    return "RLIKE '". implode('|',array_filter($rlike))."'";
	}


	function mysql_fuzzy_regex($str) { 	
		$len=mb_strlen($str); 	$qstr=[]; 	
		for ($i=0; $i < $len; $i++) 
			$qstr[$i]=preg_quote(mb_substr($str, $i, 1)); 	 	
		$reg='[[:<:]]('.implode($qstr).'[[:alnum:]]?'; 	
		for ($i=0; $i < $len; $i++) { 		
			$reg.='|'; 		
			for ($x=0; $x < $len; $x++) 
				$reg.=$x==$i ?'([[:alnum:]]'.$qstr[$x].'|[[:alnum:]]?)' :$qstr[$x]; 	
		} 	
		return $reg.')[[:>:]]'; 
	}

	public function index($keyWord, $options = array()){
		$d['searchResults'] = $this->SearchInBdd($keyWord, $options);
		debug($d['searchResults']);

		$this->set($d);
	}

	public function preview($keyWord, $options = array()){
		$d['searchResults'] = $this->SearchInBdd($keyWord, array('preview' => true));
		debug($d['searchResults']);
		
		$this->set($d);
	}

}