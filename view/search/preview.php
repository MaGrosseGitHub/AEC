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

<div id="searchresults" class = "row col-md-3">
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
				if($searchBdd == "Post") : ?>
				<div class="searchThumb col-md-3">
					<?php echo HTML::getImg("cache/post/".$results->slug."/".$results->slug."_150x100.jpg", null, null, null, true); ?>
				</div>
				<div class="searchInfo col-md-9">
					<span title = "<?php echo $results->title_FR;	?>"><?php echo $results->title_FR;	?></span>
					<br>
					<span title = "<?php echo $results->user_id;	?>"><?php echo $results->user_id;	?></span>
				</div>
				<?php 
				elseif($searchBdd == "Author") : ?>
				<div class="searchThumb col-md-3">
					<?php echo HTML::getImg("cache/post/".$results->slug."/".$results->slug."_150x100.jpg", null, null, null, true); ?>
				</div>
				<div class="searchInfo col-md-9">
					<span title = "<?php echo $results->firstName;	?>"><?php echo $results->firstName;	?></span>
					<br>
					<span title = "<?php echo $results->lastName;	?>"><?php echo $results->lastName;	?></span>
				</div>

				<?php
				endif;

				if(!$skipDiv)
					echo "<br>$searchBdd </div>";

			endforeach;
		}
	?>
</div>