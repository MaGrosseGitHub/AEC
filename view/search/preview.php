<?php 
		if(array_key_exists('EMPTY', $searchResults) &&  $searchResults['EMPTY']) : ?>			
			<div class="tt-suggestion">
				<div id="result" class="preview">
					<span id="searchBorder"></span>
					<div class="searchThumb noresults">
					﻿	<img class = "noresults" src="<?php echo Router::webroot('css/View/Layout/default/img/noresults2bw.png'); ?>" alt="noresults">        
					</div>
					<div class="searchInfo noresults">
						<span class = "si-name" title="test6">No results</span>
						<br>
						<span class = "si-pname" title="admin">Pas de résultats</span>
					</div>
					<div class="infoType noresults"><span></span></div>
				</div>
			</div>
		<?php else :
			foreach ($searchResults as $searchKey => $results) :
				$searchKey = explode("-", $searchKey);
				$searchInfoType = $searchKey[0];
				$searchBdd = $searchKey[1];
				$searchId = $searchKey[2];
				$skipDiv = true;
			?>

			<div class="tt-suggestion">
				<div id="result" class="preview">
					<span id="searchBorder"></span>
				<?php 
				if($searchBdd == "Post") : ?>
					<div class="searchThumb">
						<?php echo HTML::getImg("cache/post/test7/test7_150x100.jpg", null, null, 'class = "project"', false, false); ?>  
						<!-- ﻿<img class = "project" src="/AEC/webroot/img/cache/post/test7/test7_150x100.jpg" alt="test6_150x100">    -->
						<?php //echo HTML::getImg("cache/post/".$results->slug."/".$results->slug."_150x100.jpg", null, null, null, true); ?>     
					</div>
				<?php 
				elseif($searchBdd == "Author" && $searchInfoType == "individual") : ?>
					<div class="searchThumb">
						<?php echo HTML::getImg("tmp/Author/".$results->slug."/".$results->slug.".jpg", null, null, 'class = "author"', false, true); ?>  
					</div>
				<?php 
				elseif($searchBdd == "Author" && $searchInfoType == "organization") : ?>
					<div class="searchThumb">
						<?php echo HTML::getImg("tmp/organization/".$results->slug."/".$results->slug.".jpg", null, null, 'class = "project"', false, true); ?>  
					</div>
				<?php 
				endif;

				if($searchBdd == "Post") : ?>
					<div class="searchInfo">
						<span class = "si-name">
							<?php echo $results->title_FR; ?>
						</span>
						<br>
						<span class = "si-pname">
							<?php //echo $results->author_id; ?>
              <?php echo (strtolower($results->organization_id) == 'other')?'':strtoupper($results->organization_id); ?>
						</span>
					</div>
					<div class="infoType project"><span></span></div>
				<?php 
				elseif($searchBdd == "Author" && $searchInfoType == "individual") : ?>
					<div class="searchInfo author">
						<span class = "si-name">
							<?php echo $results->lastName.' '.$results->firstName; ?>
						</span>
						<br>
						<span class = "si-pname">
              <?php echo (strtolower($results->organization) == 'other')?'':strtoupper($results->organization); ?>
						</span>
					</div>
					<div class="infoType author"><span></span></div>
				<?php 
				elseif($searchBdd == "Author" && $searchInfoType == "organization") : ?>
					<div class="searchInfo project">
						<span class = "si-name">
							<?php echo $results->lastName?>
						</span>
						<br>
						<span class = "si-pname">
							<?php echo $results->firstName; ?>
						</span>
					</div>
					<div class="infoType organization"><span></span></div>
				<?php 
				endif; ?>
				</div>
			</div>
				<?php
				if(!$skipDiv)
					echo "<br>$searchBdd </div>";

			endforeach;
		endif;
?>