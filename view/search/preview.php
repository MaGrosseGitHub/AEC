<span class="tt-suggestions">
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
					<div class="infoType noresults">
					</div>
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
							<?php echo $results->author_id; ?>
						</span>
					</div>
					<div class="infoType project">
				<?php 
				elseif($searchBdd == "Author" && $searchInfoType == "individual") : ?>
					<div class="searchInfo author">
						<span class = "si-name">
							<?php echo $results->lastName.' '.$results->firstName; ?>
						</span>
						<br>
						<span class = "si-pname">
							<?php echo $results->lastName.' '.$results->firstName; ?>
						</span>
					</div>
					<div class="infoType author">
				<?php 
				elseif($searchBdd == "Author" && $searchInfoType == "organization") : ?>
					<div class="searchInfo project">
						<span class = "si-name">
							<?php echo $results->lastName?>
						</span>
						<br>
						<span class = "si-pname">
							<?php echo $results->lastName.' '.$results->firstName; ?>
						</span>
					</div>
					<div class="infoType organization">
				<?php 
				endif; ?>
					</div>
				</div>
			</div>
				<?php
				if(!$skipDiv)
					echo "<br>$searchBdd </div>";

			endforeach;
		endif;
	?>
<!--   <div class="tt-suggestion">
    <div id="result" class="preview">
      <span id="searchBorder"></span>
      <div class="searchThumb">
        ﻿<img class = "project" src="/AEC/webroot/img/cache/post/test7/test7_150x100.jpg" alt="test6_150x100">        
      </div>
      <div class="searchInfo">
        <span class = "si-name" title="test6">Lorem ipsum Duis pariatur dolor Ut sit Duis aliqua ex exercitation nulla reprehenderit dolore eiusmod nostrud incididunt ullamco ut ut tempor.</span>
        <br>
        <span class = "si-pname" title="admin">Lorem ipsum Anim in ad ex id consequat laboris nulla fugiat culpa id pariatur velit Duis deserunt nisi do ex consequat exercitation ut ut proident culpa elit dolor est exercitation.</span>
      </div>
      <div class="infoType project">
      </div>
    </div>
  </div>
  <div class="tt-suggestion">
    <div id="result" class="preview">
      <span id="searchBorder"></span>
      <div class="searchThumb">
        ﻿<img class = "author" src="/AEC/webroot/img/cache/post/test6/test6_150x100.jpg" alt="test6_150x100">        
      </div>
      <div class="searchInfo author">
        <span class = "si-name" title="test6">test6</span>
        <br>
        <span class = "si-pname" title="admin">admin</span>
      </div>
      <div class="infoType author">
      </div>
    </div>
  </div>
  <div class="tt-suggestion">
    <div id="result" class="preview">
      <span id="searchBorder"></span>
      <div class="searchThumb">
        ﻿<img class = "project" src="/AEC/webroot/img/cache/post/test9/test9_150x100.jpg" alt="test6_150x100">        
      </div>
      <div class="searchInfo project">
        <span class = "si-name" title="test6">test6</span>
        <br>
        <span class = "si-pname" title="admin">admin</span>
      </div>
      <div class="infoType organization">
      </div>
    </div>
  </div>
  <div class="tt-suggestion tt-is-under-cursor" style = "display : none;">
    <p>
      <a href="http://tympanus.net/codrops/2013/11/05/animated-svg-icons-with-snap-svg/">Animated SVG Icons with Snap.svg</a>
    </p>
  </div> -->


<!-- 	<div id="result" class = "preview">
		<span id="searchBorder"></span>
		<?php 
		//if($searchBdd == "Post") : ?>
		<div class="searchThumb col-md-3">
			<?php //echo HTML::getImg("cache/post/".$results->slug."/".$results->slug."_150x100.jpg", null, null, null, true); ?>
		</div>
		<div class="searchInfo col-md-9">
			<span title = "<?php //echo $results->title_FR;	?>"><?php //echo $results->title_FR;	?></span>
			<br>
			<span title = "<?php //echo $results->user_id;	?>"><?php //echo $results->user_id;	?></span>
		</div>
		<?php 
		//elseif($searchBdd == "Author") : ?>
		<div class="searchThumb col-md-3">
			<?php //echo HTML::getImg("cache/post/".$results->slug."/".$results->slug."_150x100.jpg", null, null, null, true); ?>
		</div>
		<div class="searchInfo col-md-9">
			<span title = "<?php //echo $results->firstName;	?>"><?php //echo $results->firstName;	?></span>
			<br>
			<span title = "<?php //echo $results->lastName;	?>"><?php //echo $results->lastName;	?></span>
		</div> -->
</span>