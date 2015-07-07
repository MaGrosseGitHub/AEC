<?php
class SearchController extends Controller{	

	protected function SearchInBdd($keyWord, $options = array()){
		// debug('<br><br><br><br><br><br>');
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
							['id', 'online', 'type', 'category_id', 'organization_id', 'author_id', 'slug', 'created', 'user_id']
						],
						'Author' => [
							['firstName', 'lastName', 'bio_EN', 'bio_FR', 'organization'], 
							'created', 
							['id', 'website', 'type', 'organization', 'slug']
						]
					)
				);
		if(array_key_exists('searchIn', $options))
			$options['searchIn'] = array_merge($optionsDefault['searchIn'], $options['searchIn']);
		$options = array_merge($optionsDefault, $options);

		$LevenshteinArr = array();
		$keywordOrigin = $keyWord;
		$keyWord = explode("+", $keyWord);
		foreach ($options['searchIn'] as $bdd => $row) {
			$row = $row[0];
			if(is_array($row) && !empty($row)) {
		
				$this->loadModel($bdd);
				$condition = array();
				$cond = array();

				$fields = $row;
				foreach ($row as $rowKey => $column) {
					foreach ($keyWord as $wordkey => $word) {
						if(!in_array($column, $contentArray))	
							$word = "%$word%";
						else
							$word = "% $word %";
						$cond[] = $column.' LIKE "'.$word.'"';
					}

					if(count($options['searchIn'][$bdd]) >= 3 && in_array($column, $contentArray)){ //if column is in omit array : delete it
						unset($fields[$rowKey]);
					}
				}

				//Fuzzy search (getLevenshteinSql function)
				// $condTemp = array();
				// foreach ($row as $rowKey => $column) {
				// 	foreach ($keyWord as $wordkey => $word) {
				// 		$cond = array_merge($cond, $this->getLevenshtein1($word));
				// 	}

				// 	foreach ($cond as $condKey => $condVal) {
				// 		$condTemp[] = "(".$column." LIKE '%".$condVal."%')";
				// 	}

				// 	if(count($options['searchIn'][$bdd]) >= 3 && in_array($column, $contentArray)){ //if column is in omit array : delete it
				// 		unset($fields[$rowKey]);
				// 	}
				// }
				// $cond = $condTemp;

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
				// debug($results);				

				if(!empty($results)){
					foreach ($results as $resultKey => $result) {
						if(isset($result->$options['searchIn'][$bdd][1]))
							$resultArrayKey = $result->$options['searchIn'][$bdd][1].'-'.$bdd.'-'.$result->id;
						else if($bdd == "Author")
							$resultArrayKey = $result->type.'-'.$bdd.'-'.$result->id;
						else
							$resultArrayKey = $bdd.'-'.$result->id;
						$searchResults[$resultArrayKey] = $result;
						$resultLev = array();
						if($options['preview']){
							foreach ($result as $resType => $resVal) {
								if(in_array($resType, $options['searchIn'][$bdd][0]) && !empty($resVal))
									$resultLev[$resType] = $resVal;
							}
							$LevenshteinArr[$resultArrayKey] = $resultLev;
						}
					}
					array_push($availableResults, $bdd);
				}
			}
		}

		// debug($this->mysql_fuzzy_regex($keywordOrigin), "mysql_fuzzy_regex");
		// debug($this->rlike($keywordOrigin), 'rlike');
		// debug($this->getLevenshteinSql($keywordOrigin), 'getLevenshteinSql');
		
		// debug($LevenshteinArr);
		// debug($this->getLevenshteinArray($keywordOrigin, $LevenshteinArr));
		if($options['preview']){
			$LevenshteinResults = $this->getLevenshteinArray($keywordOrigin, $LevenshteinArr);
			$searchResults = $this->rearrangeResults($searchResults, $LevenshteinResults);
		}
		$results = array();
		// debug(fuzzySearch(implode(" ", $keyWord), $LevenshteinArr));
		// debug(fuzzySearchComplete(implode(" ", $keyWord), $LevenshteinArr));
		
		// debug($searchResults);
		if(empty($searchResults)){
			$searchResults['EMPTY'] = true;
		}

		if(!$options['preview']){
			ksort($searchResults);
			$searchResults = array_reverse($searchResults, "FUZZY");
		}
		return $searchResults; 
	}

	public function index($keyWord, $options = array()){
		$d['searchResults'] = $this->SearchInBdd($keyWord, $options);
		// debug($d['searchResults']);

		$this->set($d);
	}

	public function preview($keyWord, $options = array()){
		$d['searchResults'] = $this->SearchInBdd($keyWord, array('preview' => true));
		// debug($d['searchResults']);
		
		$this->set($d);
	}



	function getLevenshteinArray($str, $array, $wordPosition = true){
		$keywords = explode("+", $str);
		$results = array();
		$wordCount = 0.5;
		foreach ($keywords as $keyind => $keyword) {
			foreach ($array as $key => $value) {
				foreach ($value as $field => $fieldVal) {
					$divider = 1;
					if($wordPosition) //wordPosition will make the search based on the position of each word, the first one being the most important and the last one being the last important
						$wordCount*2;
					if(!isset($results[$key]))
						$results[$key] = levenshtein($keyword, $fieldVal)/$wordCount*2;
					else
						$results[$key] += levenshtein($keyword, $fieldVal)/$wordCount*2;
				}
			}
			$wordCount++;
		}
		asort($results);
		return $results;
	}

	function rearrangeResults(Array $array, Array $orderArray){
	    $ordered = array();
	    foreach($orderArray as $key => $value) {
	    	// debug($key);
	        if(array_key_exists($key,$array)) {
	            $ordered[$key] = $array[$key];
	            unset($array[$key]);
	        }
	    }
    	return $ordered + $array;
	}

	function getLevenshteinSql($word)
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
		mb_internal_encoding('UTF-8'); 
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

}