<?php $title_for_layout = $post->name; ?>

<style>
  
.buttonUp {
background-image: url(<?php echo HTML::getImg('mCSB_buttons.png', true, true); ?>);
background-position: -80px 0px;
/*background-position: 0px 0px;*/
/*background-position: -32px 0px;*/
/*background-position: -112px 0px;*/
/*background-position: -16px 0px;*/
background-repeat: no-repeat;
color: rgb(238, 238, 238);
/*color: rgb(51, 51, 51);*/
/*color: rgb(34, 34,34);*/
/*color: rgb(34, 34,34);*/
cursor: pointer;
display: block;
font-family: Verdana, Geneva, sans-serif;
font-size: 13px;
height: 20px;
/*line-height: 20px;*/
margin-bottom: 0px;
margin-left: 0px;
margin-right: 0px;
margin-top: 0px;
opacity: 0.75;
overflow-x: hidden;
overflow-y: hidden;
position: absolute;
left : -7.5px;
top : -20px;
width: 16px;


}
.buttonDown {
background-image: url(<?php echo HTML::getImg('mCSB_buttons.png', true, true); ?>);
background-position: -80px -20px;
/*background-position: 0px -20px;*/
/*background-position: -32px -20px;*/
/*background-position: -112px -20px;*/
/*background-position: -16px -20px;*/
background-repeat: no-repeat;
color: rgb(238, 238, 238);
cursor: pointer;
display: block;
font-family: Verdana, Geneva, sans-serif;
font-size: 13px;
height: 20px;
line-height: 20px;
margin-bottom: 0px;
margin-left: 0px;
margin-right: 0px;
margin-top: 0px;
opacity: 0.75;
overflow-x: hidden;
overflow-y: hidden;
position: absolute;
left : -7.5px;
bottom : -20px;
width: 16px;
}

</style>
<div id="loading" style = "display : none;"> <?php echo HTML::getImg('loading.gif',true); ?> </div>
	<div class="row-fluid">
		
		<div class="news col-md-9">
			<news>
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
			</news>
	    	<?php  $comments = new Comments("p_$post->id"); ?> 
		</div>

		<div class="col-md-2" style = "position : fixed; display : inline-block;">
			<div class="sidebar col-md-12" style = "overflow: hidden; height:400px;">
				<!-- data-spy="affix" -->
				<div class="bs-example bs-example-tabs" >
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

	</div>

    <script type="text/javascript">
    $(document).ready(function() {

    	$("#loading").hide();

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
        }else{
        	var url = window.location.href;
        	url = url.substr(0, url.indexOf("blog"));
        	url = url+"lookFor_blog/";
			$.get(url, function(data) {
        		$("#loading").clone().prependTo("#all");
	        	$("#all").find('#loading').show();
				var $allNews = jQuery.trim(data);
	            // $allNews = $($allNews).find('.posts').html();
	            $("#all").html($allNews);
        		// $("#all").append(scrollToolsDiv);
        		$("#loading").clone().prependTo("#all");
	            $("#all").find('.page-header h1').hide();
	            $("#all").find('a.ajax').each(function(){
	            	var $newHref = $(this).attr("href");
	            	$newHref = $newHref.replace("lookFor_blog", "blog");
	            	$(this).attr("href", $newHref);
	            	$(this).removeClass("ajax");
	            });
	            $("#all").find('filter').hide();
		    });
	        $("#all").find('#loading').hide();
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
	                var loadUrl = url.replace("blog", "lookFor_blog");
	                var urlContent = "";
	                $.get(loadUrl, function(data) {
	              		urlContent = jQuery.trim(data);
		                urlContent = $(urlContent).find('news').html();
		                urlContent = '<div class="post">'+urlContent+"</div>";
		                if($relatedTab == "relatedTab"){
		                	$("#relatedTab").append(urlContent);
		                } else{
		                	$("#relatedLinks").append(urlContent);
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
			var $authorNews = jQuery.trim(data);
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
			// console.log($("#"+scrollArray[i]).html());
			// $("#"+scrollArray[i]).append(scrollToolsDiv);
			// console.log($("#"+scrollArray[i]).html());
			$("#ascrail200"+i).css("background-color","rgba(0, 0, 0, 0.14902)");
			$("#ascrail200"+i).css("z-index","auto");
			$("#ascrail200"+i).css("cursor","pointer");
			$("#ascrail200"+i).css("width","3px");
			$("#ascrail200"+i).append(scrollToolsDiv);

			var scroller = $("#ascrail200"+i+"-hr").find("div");
			scroller.css('left', "3px");
			// scroller.css('width', "10px");
			var scrollerHr = $("#ascrail200"+i).find("div");
			scrollerHr.css('left', "1px");

			var margin = 0;
			$("#"+scrollArray[i]).find("#down").click(function () {
				margin +=250;
				nice[0].doScrollTop(margin,500);
				console.log(margin);
			});
			$("#"+scrollArray[i]).find("#up").click(function () {
				if(margin != 0) {
				  margin -= 250;
				}
				nice[0].doScrollTop(margin,500);
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
		})
		// $.ajax({
        //         type: "get",
        //         url: loadUrl,
        //         data: "ajax", 
        //         success: function(response) {
        //       		urlContent = jQuery.trim(response);
	       //          urlContent = $(urlContent).find('news').html();
	       //          console.log(urlContent);
        //         }
        // });
        	// $('#all').load(url, function(){
        	// 	$('#all').append($("#loading"));
        	// 	$("#loading").show();
	        // });
    });
</script>
