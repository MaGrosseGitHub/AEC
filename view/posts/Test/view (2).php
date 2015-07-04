<?php $title_for_layout = "Index : ".$post->name; ?>

<div id="loading" style = "display : none;"> <?php echo HTML::getImg('loading.gif',true); ?> </div>
	<div class="row">
		
		<div class="news col-md-9">

			<div class="sidebarNews">
				<div class="page-header">
					<!-- <img src="<?php echo Router::webroot('img/2011-09/'.$post->name.'.jpg'); ?>" alt=""> -->
					<h1><span class="title"><?php echo $post->name; ?></span>, 
						<small>
							<a href="<?php echo Router::url('posts/category/slug:'.$post->category_id); ?>">
								<?php echo $post->category_id; ?>
							</a>
						</small>
					</h1>

					<?php echo $post->user_id; ?>
				</div>
				<div class="newsContent">
					<?php echo $post->content; ?>
				</div>
			</div>

	    	<?php  
	    	// echo Router::url("posts/view/id:{$post->id}/slug:$post->slug")
	    	$comments = new Comments(array('id'=>"$post->id", 'slug' => $post->name), array('url' => 'http://www.kotaku.com')); 
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
		<div id = "sidebarContainer" class="col-md-2" style = "position : fixed; display : inline-block;">
			<div class="sidebar col-md-12 full-width-tabs" style = "overflow: hidden; height:400px;">
				<!-- data-spy="affix" -->
			      <ul id="sidebar" class="nav nav-tabs">
			        <!-- <li><a href="#related" data-toggle="tab">related</a></li> -->
			        <li><a class = "sidebarAll" href="#all" data-toggle="tab">all</a></li>
			        <li class="related"><a href="#relatedTab" class="dropdown-toggle relatedTab" data-toggle="dropdown">related</a></li>
			        <li class="author"><a href="#authorDiv" data-toggle="tab">author</a></li>
			      </ul>
			      <div id="sidebarContent" class="tab-content">
			        <div class="tab-pane fade col-md-12" id="all" style = "overflow-y: scroll; height:350px;"> 
					  <!-- <div class="scrollTools">
					    <a href="#" id="up" class = "buttonUp"></a>
					    <a href="#" id="down" class = "buttonDown"></a>
					  </div> -->
			        </div>
					<!-- tabs for related links -->
			        <div class="tab-pane fade col-md-12" id="relatedTab" style = "overflow-y: scroll; height:350px;"></div>
			        <div class="tab-pane fade col-md-12" id="anchor" style = "overflow-y: scroll; height:350px;"></div>
			        <div class="tab-pane fade col-md-12" id="relatedLinks" style = "overflow-y: scroll; height:350px;">Lien en ralation avec cette article</div>
					<!-- end of tabs for related links -->
			        <div class="tab-pane fade col-md-12" id="authorDiv" style = "overflow-y: scroll; height:350px;"></div>
			      </div>

			</div>
		</div>

	</div>

    <script type="text/javascript">
    $(document).ready(function() {

    	$("#loading").hide();
    	newPageTitle = "Index : <?php echo $post->name; ?>"
    	$('title').text(newPageTitle);

    	// fb-like fb_edge_widget_with_comment fb_iframe_widget
    	// setTimeout(function(){
    	// 	console.log($('.fb-like').find('iframe'));
    	// 	// $('.fb-like').find('iframe').hide();
    	// 	$('.fb-like').find('iframe').hover(function(){
    	// 		console.log("HOVER");
    	// 	})
    	// }, 3000);

    	var scrollToolsDiv = '<div class="scrollTools"><a href="#" id="up" class = "buttonUp"></a><a href="#" id="down" class = "buttonDown"></a></div>';
    	var postAuthor = "<?php echo $post->user_id; ?>";
        $relatedLinks = false;
        $internalLinks = false;
        $anchorFound = false;
		$removeAnchorActive = false;
		$relatedTab = "";
		var nice = 0;

        $(".related").hide();
        $(".author").hide();

    	//fill "all news" tab
        if($(".actu").length){
        	$("#all").append($(".actu").html());
	        $("#all").find('.page-header h1').hide();
	        $("#all").find(".filterDiv").remove();
            $("#all").find('.newsPreview').each(function(){
            	var newsPreview = $(this).text();
            	newsPreview = newsPreview.substr(0,75);
            	$(this).text(newsPreview+"...");
            });
	        $("#all").find(".post").DataFilter({
	          div : true,
	          appendTo : $('.posts'),
	          filterTypes : {
	            type : ['parapente', 'parachute', 'aviation']
	          },
	        });
        }else{
        	prevIndex = true;
        	var url = window.location.href;
        	url = url.substr(0, url.indexOf("blog"));
        	url = url+"lookFor_blog/";
        	console.log(url);
			$.get(url, function(data) {
        		$("#loading").clone().prependTo("#all");
	        	$("#all").find('#loading').show();
				var $allNews = $.trim(data);
	            // $allNews = $($allNews).find('.posts').html();
	            $("#all").html($allNews);
				// prevPageTitle = "IndexPage";
				prevPageTitle = "";
        		// $("#all").append(scrollToolsDiv);
        		$("#loading").clone().prependTo("#all");
	            $("#all").find('.page-header h1').hide();
	            $("#all").find('a.ajax').each(function(){
	            	var $newHref = $(this).attr("href");
	            	$newHref = $newHref.replace("lookFor_blog", "blog");
	            	$(this).attr("href", $newHref);
	            	$(this).removeClass("ajax");
	            });
	            $("#all").find('.newsPreview').each(function(){
	            	var newsPreview = $(this).text();
	            	newsPreview = newsPreview.substr(0,75);
	            	$(this).text(newsPreview+"...");
	            });
	            $("#all").find('filter').hide();
				// prevPageTitle = "Index";
		    });
	        $("#all").find('#loading').hide();
	        $.ias({
	            container : '.posts',
	            item: '.post',
	            pagination: '.posts .navigation',
	            next: '.next-posts:last',
	            loader: '<img src="<?php echo Router::url("css/img/loading.gif"); ?>"/>',
	            history : false,
	            triggerPageThreshold : 100,
	            onRenderComplete: function(items) {
	                $("#all").find(".post").DataFilter({
	                  div : true,
	                  appendTo : $('.posts'),
	                  filterTypes : {
	                    type : ['parapente', 'parachute', 'aviation']
	                  }
	                });

	                var filterContainer = $("#all").find(".filterDiv:last");
	                $("#all").find(".filterDiv").remove();
	                $("#all").find(".posts").prepend(filterContainer);
				    $("#all").find('filter').hide();
				    $("#all").find('filterInput').hide();
	            },
            	scrollContainer : $("#all"),
	        });
        }
        
    	//fill "related" tab
        hostname = new RegExp(location.host);
        var anchorArray = [];
        // var hostname = RegExp('^((f|ht)tps?:)?//(?!' + location.host + ')');
        $('.newscontent a').each(function(){
            var url = $(this).attr("href");
            var urlOrigin = url;
            if(hostname.test(url) || url.slice(0, 1) == "/"){
               // If it's local...
               var checkPostUrl = new RegExp('\\b(posts|blog)\\b', 'gi');
               checkPostUrl = url.match(checkPostUrl);
               var checkUserUrl = new RegExp('\\b(user)\\b', 'gi');
               checkUserUrl = url.match(checkUserUrl);
               if(checkPostUrl && !checkUserUrl){
               		var $curTab, loadUrl = url.replace("blog", "lookFor_blog");
	                var $curImg = urlOrigin, $curImgpre = window.location.href;
	                $curImg = $curImg.substr(urlOrigin.indexOf("blog")+5, urlOrigin.length);
	                $curImg = $curImg.substr(0, $curImg.indexOf("-"));
	                $curImgpre = $curImgpre.substr(0, $curImgpre.indexOf("blog"));
	                var urlNewsContent, urlContent = "";
	                $.get(loadUrl, function(data) {
	              		urlContent = $.trim(data);
		                urlContent = $(urlContent).find('.sidebarNews');
		                urlContent = $(urlContent).find('.newsContent').each(function(){
		                	var newsImg = '<img src ="'+$curImgpre+'img/cache/post/'+$curImg+'/'+$curImg+'_150x100.jpg" width = "100px" height = "67px">';
			            	var newsLink = '<p style="text-align:right"><a href="'+url+'">Lire la suite &rarr;</a></p>';
			            	var newsPreview = $(this).text();
			            	newsPreview = newsPreview.substr(0,75);
			            	$(this).text(newsPreview+"...");
			            	$(this).prepend(newsImg);
			            	$(this).append(newsLink);
			            });
		                if($relatedTab == "relatedTab"){
		                	$("#relatedTab").append(urlContent);
		                	$curTab = $("#relatedTab");
		                } else{
		                	$("#relatedLinks").append(urlContent);
		                	$curTab = $("#relatedLinks");
		                }
				    });
               }
               $internalLinks = true;
               $relatedLinks = true;
            } else if(url.slice(0, 1) == "#"){
                // It's an anchor link
		        anchorArray.push($(this));
    			$anchorFound = true;
                $relatedLinks = true;
            } else {
               // a link that does not contain the current host
               $(this).attr('target', '_newtab');         
            }
        });

		if($relatedLinks){
        	$(".related").show();
        	if($anchorFound && $internalLinks){
        		$("li.related").append('<ul class="dropdown-menu" role="menu" aria-labelledby="relatedTab"><li ><a class = "relatedAnchor" href="#anchor" data-toggle="tab">Ancre</a></li><li><a class = "internalLinks" href="#relatedLinks" data-toggle="tab">Lien en relation</a></li></ul>');
        		var newRelatedText = '<b class="caret"></b>';
        		$("li.related a.relatedTab").append(newRelatedText);
        		$("li.related a.relatedTab").attr("href", "#");
				$relatedTab = "internalLinks";
				$("#anchor").html("Naviguez plus facilement avec les ancres - <h3>"+$('span.title').text()+" :</h3><br/>");
        		$.each(anchorArray, function(){
        			// $("#anchor").append($(this));
        			var li = $('<li/>').appendTo("#anchor");
				    var liLink = $('<a/>').text($(this).text()).attr("href", $(this).attr("href")).appendTo(li);
        		})
        		// $("#anchor").append(scrollToolsDiv);
        		// $("#relatedLinks").append(scrollToolsDiv);
        	}
			if($anchorFound){
				$('.relatedAnchor').tab('show');
        		$("li.related").addClass("active");
        		$removeAnchorActive = true;
			}

			if(!$anchorFound && $internalLinks){
        		// $("#relatedTab").append(scrollToolsDiv);
				$('.internalLinks').tab('show');
        		$("li.related").addClass("active");
        		$removeAnchorActive = true;
			}

			if($anchorFound && !$internalLinks){
				$relatedTab = "relatedTab";
        		// $("#relatedTab").append(scrollToolsDiv);
				$('.relatedTab').tab('show');
        		$("li.related").addClass("active");
        		$removeAnchorActive = true;
				$("#relatedTab").html("Naviguez plus facilement avec les ancres - <h3>"+$('span.title').text()+" :</h3><br/>");
        		$.each(anchorArray, function(){
        			// $("#relatedTab").append($(this));
        			var li = $('<li/>').appendTo("#relatedTab");
				    var liLink = $('<a/>').text($(this).text()).attr("href", $(this).attr("href")).appendTo(li);
        		})
			}

			if(!$anchorFound && $internalLinks){
				$relatedTab = "relatedTab";
			}
		}

		if(!$anchorFound || !$relatedLinks || !$internalLinks){
			$('.sidebarAll').tab('show');
		}

    	//fill "author" tab
		var $authorNewsUrl = window.location.href;
    	$authorNewsUrl = $authorNewsUrl.substr(0, $authorNewsUrl.indexOf("blog"));
    	$authorNewsUrl = $authorNewsUrl+"lookFor_blog/user/"+postAuthor;
		$.get($authorNewsUrl, function(data) {
        	// $('#authorDiv').clone().append($("#loading"));
    		$("#loading").clone().prependTo("#authorDiv");
	        $("#authorDiv").find('#loading').show();
			var $authorNews = $.trim(data);
            $authorNews = $($authorNews).find('.posts').html();
			if($authorNews.length != 11){
	            $("#authorDiv").html($authorNews);
    			$("#loading").clone().prependTo("#authorDiv");
	            $("#authorDiv").find('a.ajax').each(function(){
	            	var $newHref = $(this).attr("href");
	            	$newHref = $newHref.replace("lookFor_blog", "blog");
	            	$(this).attr("href", $newHref);
	            	$(this).removeClass("ajax");
	            });
	            $("#authorDiv").find('.newsPreview').each(function(){
	            	var newsPreview = $(this).text();
	            	newsPreview = newsPreview.substr(0,75);
	            	$(this).text(newsPreview+"...");
	            });
	            $("#authorDiv").find('filter').hide();
        		// $("#authorDiv").append(scrollToolsDiv);
		        $(".author").show();
			} 
	    });
	    $("#authorDiv").find('#loading').hide();

		//call scroll plugin
		// $("#all").niceScroll({
		// 	cursorwidth : '6px'
		// });
		 
		var scrollArray = ['all', 'anchor', 'relatedTab', 'relatedLinks', 'authorDiv'];

		//add params to scoll plugin css
		for(var i = 0; i <5; i++){
			$("#"+scrollArray[i]).niceScroll({
				cursorwidth : '6px'
			});
			$("#ascrail200"+i).css("background-color","rgba(0, 0, 0, 0.14902)");
			$("#ascrail200"+i).css("z-index","auto");
			$("#ascrail200"+i).css("cursor","pointer");
			$("#ascrail200"+i).css("width","3px");
			$("#ascrail200"+i).append(scrollToolsDiv);

			var scroller = $("#ascrail200"+i+"-hr").find("div");
			scroller.css('left', "3px");
			var scrollerHr = $("#ascrail200"+i).find("div");
			scrollerHr.css('left', "1px");

			var margin = 0;
			$("#"+scrollArray[i]).find("#down").click(function () {
				margin +=250;
				nice[0].doScrollTop(margin,500);
			});
			$("#"+scrollArray[i]).find("#up").click(function () {
				if(margin != 0) {
				  margin -= 250;
				}
				nice[i].doScrollTop(margin,500);
			});
		}
		
		//show tabs on click
        $('ul#sidebar a').click(function (e) {
        	if($removeAnchorActive){
        		$("li.related").removeClass("active");
        		$("a.relatedAnchor").parent().removeClass("active");
        		$removeAnchorActive = false;
        	}

        	$linkText = $(this).text();
        	if($linkText == "all"){
        		nice = $("#all").getNiceScroll();
        	} else if($linkText == "author"){
        		nice = $("#author").getNiceScroll();
        	}

			$(this).tab('show');
			e.preventDefault();
		});

    });
</script>
