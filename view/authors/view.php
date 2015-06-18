
	<div class="row-fluid">
		
		<div class="news col-md-12">

			<div class="sidebarNews">
				<div class="page-header">
					<!-- <img src="<?php //echo Router::webroot('img/2011-09/'.$author->name.'.jpg'); ?>" alt=""> -->
					<h1><span class="title"><?php echo $author->firstName.' '.$author->lastName; ?></span>, 
						<small>
							<!-- <a href="<?php //echo Router::url('posts/category/slug:'.$author->category_id); ?>"> -->
								<?php //echo $author->category_id; ?>
							</a>
						</small>
					</h1>
				</div>
				<div class="newsContent">
					<?php echo $author->bio_FR; ?>
				</div>
			</div>
	
		</div>  
	</div>