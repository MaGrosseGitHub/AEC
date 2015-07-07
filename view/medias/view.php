<div class="row-fluid">
	<div class="col-md-12">		
		<div id="lightbox">
			<div class="imgLightbox col-md-12">
				<?php 
					if($imgInfo->type == "img"){
						echo HTML::getImg($imgInfo->file, false, false, 'class = "originalImg" max-width = "100%"', true);
					} elseif($imgInfo->type == "video") {
						echo '<iframe width="100%" height="450" src="'.$imgInfo->iframe.'" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
					}
				?>
        		<div class="prevButton" style = "display : none">
        			<a href = "#" id="prevImg"><?php echo HTML::getImg("next.svg", true); ?></a></div>
        		<div class="nextButton" style = "display : none">
        			<a href = "#" id="nextImg"><?php echo HTML::getImg("next.svg", true); ?></a>
        		</div>
			</div>
			<div id="comments">
				<div class="user">
					<?php echo $imgInfo->user; ?>
					<?php 
						$slugUrl = str_replace("lookFor_", "", curPageURL());
						$slugUrl = str_replace("media", "media/view", $slugUrl);
						$realSizeUrl = Router::webroot("img/".$imgInfo->file);
						($imgInfo->type == "video" ? $realSizeUrl = $imgInfo->link : '');
					?>
					<a class = "reelSize" href="<?php echo $realSizeUrl; ?>" <?php //echo ($imgInfo->type == "video" ? 'style = "display : none;"' : ''); ?>>Taille réel</a>
					<a class = "slugUrl" href="<?php echo $slugUrl; ?>" style = "display : none;">slug</a>
					<?php echo $imgInfo->name; ?>
				</div>
				<?php  
			    	$comments = new Comments(array('id'=>"$imgInfo->id", 'slug' => $imgInfo->slug), array('url' => 'http://www.kotaku.com')); 
			    	// , 'url'=>Router::url("posts/view/id:{$post->id}/slug:$post->slug")
			    ?>
			</div>
			<!-- <div class="clearfix"></div> -->
		</div>
	</div>
</div>