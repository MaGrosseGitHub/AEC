<style>

	#result {
		margin : 2px;
		background :#BEBEBE;

		overflow: hidden; 
		position: relative;
		/*overflow: scroll; */
	}

	.preview {
		width : 300px;
		height : 80px;
	}

	.searchThumb {
		margin : 0;
		padding : 0;
	}

	.searchThumb img{
		/*height : 80px;*/
		/*width : 80px;*/
		width : 100%;
		height : 100%;
	}

	.searchInfo:after {
		right: 100%;
		top: 85%;
		content: " ";
		height: 0;
		width: 0;
		position: absolute;
		pointer-events: none;
		border: solid transparent;
		border-color: rgba(190, 190, 190, 0);
		border-right-color: #BEBEBE;
		border-width: 10px;
		margin-top: -10px;
	}

	#searchBorder{
		position : absolute;
		background: red;
		width : 10px;
		height : 80px;
		top : 0px;
		left : 0px;
		z-index: 1000;
		display: none;
	}

	#result:hover #searchBorder {
		display: inline-block;
	}

</style>

<div id="searchresults" class = "row">
	<?php 
		if(array_key_exists('EMPTY', $searchResults) &&  $searchResults['EMPTY']){
			echo "Pas de resultats";
		} else {
			foreach ($searchResults as $searchKey => $results) :
				$searchKey = explode("-", $searchKey);
				$searchBdd = $searchKey[1];
				$searchId = $searchKey[2];
				$skipDiv = false;
			?>
			<div id="result" class = "preview">
				<span id="searchBorder"></span>
			<?php
				if($searchBdd == "User") : ?>
				<div class="searchThumb col-md-3">
					<?php echo HTML::getImg("cache/users/".$results->login.DS."profil".DS.$results->login.".jpg", null, null, null, true); ?>
				</div>
				<div class="searchInfo col-md-9">
					<span title = "<?php echo $results->login;	?>"><?php echo $results->login;	?></span>
				</div>

				<?php 
				elseif($searchBdd == "Post") : ?>
				<div class="searchThumb col-md-3">
					<?php echo HTML::getImg("cache/post/".$results->slug.DS.$results->slug."_150x100.jpg", null, null, null, true); ?>
				</div>
				<div class="searchInfo col-md-9">
					<span title = "<?php echo $results->name;	?>"><?php echo $results->name;	?></span>
					<br>
					<span title = "<?php echo $results->user_id;	?>"><?php echo $results->user_id;	?></span>
				</div>
				<?php
				elseif($searchBdd == "Event") : ?>

				<?php
					echo $results->titre;
					echo "<br>$results->auteur";
					if(array_key_exists("fromDate", $results))
						echo "<br>from : $results->fromDate";
					echo "<br>to : $results->toDate";
				?>
					
				<?php
				elseif ($searchBdd == "Site") : ?>

				<?php
					echo $results->title;
					echo "<br>$results->club";
				?>

				<?php
				elseif ($searchBdd == "Media") : ?>

				<?php
					$sliderlimit = 4;
					$countSliderLimit = 0;
					$beforeDiv = '<div id="result" class = "preview">
											<span id="searchBorder"></span>';;
					$afterDiv = '</div>';
					if(is_array(reset($results))) {
						$userMedia = reset($results);
						foreach ( $userMedia as $key => $value) {
							if(is_array($value) || is_object($value)){
								if($countSliderLimit == $sliderlimit){
									break;
								}
								if($countSliderLimit >=1)
									echo $beforeDiv;
								
								if(count($userMedia) >= 5){
									if($value ->type == "img"){
										echo $value->name;
										echo "<br>$value->user";
										echo "<br>Count : ".$userMedia['userCount'].'<br>';
									}
									if($value ->type == "album"){
										echo "<br>$value->user";
										$albumImgs = explode(",", $value->album);
										echo "<br>img :".$albumImgs[mt_rand(0,(count($albumImgs)-1))];
										echo "<br>Count : ".$userMedia['userCount'].'<br>';
									}
								} else {					
									if($value ->type == "img"){
										echo $value->name;
										echo "<br>$value->user";
										echo "<br>Count : ".$userMedia['userCount'].'<br>';
									}
									if($value ->type == "album"){
										$albumImgs = explode(",", $value->album);
										if(count($albumImgs) >= ($sliderlimit - $countSliderLimit)){
											for ($i=0; $i < ($sliderlimit - $countSliderLimit); $i++) { 
												if($i >=1)
													echo $beforeDiv;
												?>								
												<div class="searchThumb col-md-3">
													<?php echo HTML::getImg($albumImgs[$i], null, null, null, true); ?>
												</div>
												<div class="searchInfo col-md-9"><span title = "<?php echo $value->user; ?>"><?php echo $value->user; ?></span>													
													<br>
													<span title = "<?php echo '('.$userMedia['userCount'].')'; ?>"><?php echo '('.$userMedia['userCount'].')' ; ?></span>
												</div>
												<?php
												if($i < (($sliderlimit - $countSliderLimit)-1))
													echo $afterDiv;
											}
										} else {
											for ($i=0; $i < count($albumImgs); $i++) {  
												if($i >=1)
													echo $beforeDiv;
												?>
												<div class="searchThumb col-md-3">
													<?php echo HTML::getImg($albumImgs[$i], null, null, null, true); ?>
												</div>
												<div class="searchInfo col-md-9"><span title = "<?php echo $value->user; ?>"><?php echo $value->user; ?></span>													
													<br>
													<span title = "<?php echo '('.$userMedia['userCount'].')'; ?>"><?php echo '('.$userMedia['userCount'].')' ; ?></span>
												</div>
												<?php
												if($i < (count($albumImgs)-1))
													echo $afterDiv;
											}
										}
									}
									$countSliderLimit = $sliderlimit-1;
									$skipDiv = true;
								}
								$countSliderLimit++;
								echo "<br>$searchBdd";
								echo $afterDiv;
							}
						}
					} else {
						if($results ->type == "album") : 
							$albumImgs = explode(",", $results->album);
						?>
							<div class="searchThumb col-md-3">
								<?php echo HTML::getImg($albumImgs[mt_rand(0,(count($albumImgs)-1))], null, null, null, true); ?>
							</div>
							<div class="searchInfo col-md-9">
							<?php 					
								echo $results->name;
								echo "<br>$results->user";
								echo "<br>Count : ".count($albumImgs);
							?>
							</div>
						<?php
						endif;
					}
				endif;

				if(!$skipDiv)
					echo "<br>$searchBdd </div>";

			endforeach;
		}
	?>
</div>