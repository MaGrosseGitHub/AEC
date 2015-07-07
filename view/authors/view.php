
	<div class="row-fluid">
		
		<div class="news col-md-12">

			<div class="sidebarNews">
				<div class="page-header">
					<!-- <img src="<?php //echo Router::webroot('img/2011-09/'.$author->name.'.jpg'); ?>" alt=""> -->
					<h1><span class="title"><?php echo $author->firstName.' '.$author->lastName; ?></span>, 
						<small>
							<!-- <a href="<?php //echo Router::url('posts/category/slug:'.$author->category_id); ?>"> -->
								<?php echo $author->organization; ?>
								<?php echo $author->website; ?>
							</a>
						</small>
					</h1>
				</div>
				<?php echo HTML::getImg($imgPath, null, null, null, false, true); ?>
				<div class="newsContent">
					<?php 
						$bio = "bio_".strtoupper(Language::$curLang);
						echo $author->$bio; 
						?>
				</div>
			</div>
	
		</div>  
	</div>