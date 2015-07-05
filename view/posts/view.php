<?php $title_for_layout = "Index : ".$post->title_FR; ?>

<div id="loading" style = "display : none;"> <?php echo HTML::getImg('loading.gif',true); ?> </div>
	<div class="row">
		
		<div class="news col-md-12">

			<div class="sidebarNews">
				<div class="page-header">
					<!-- <img src="<?php echo Router::webroot('img/2011-09/'.$post->title_FR.'.jpg'); ?>" alt=""> -->
					<h1><span class="title"><?php echo $post->title_FR; ?></span>, 
						<small>
							<a href="<?php echo Router::url('posts/category/slug:'.$post->category_id); ?>">
								<?php echo $post->category_id; ?>
							</a>
						</small>
					</h1>

					<?php echo $post->user_id; ?>
				</div>
				<div class="newsContent">
					<?php echo $post->content_FR; ?>
				</div>
			</div>

	    	<?php  
	    	// echo Router::url("posts/view/id:{$post->id}/slug:$post->slug")
	    	$comments = new Comments(array('id'=>"$post->id", 'slug' => $post->title_FR), array('url' => 'http://www.kotaku.com')); 
	    	// , 'url'=>Router::url("posts/view/id:{$post->id}/slug:$post->slug")
	    	?>
	    	<!-- "e_$userEvent->id", $userEvent->titre, Router::webroot("events/event/$userEvent->id") -->
	
		</div>  
		<style>
			.full-width-tabs > ul.nav.nav-tabs {
			    display: table;
			    width: 100%;
			    table-layout: fixed;
			}
			.full-width-tabs > ul.nav.nav-tabs > li {
			    float: none;
	    		display: table-cell;
			    width: 100%; /* added this line */
			}
			.full-width-tabs > ul.nav.nav-tabs > li > a {
			    text-align: center;
			}
		</style>  	

	</div>

    <script type="text/javascript">
    $(document).ready(function() {

    	

    });
</script>
