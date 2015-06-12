<style>
  
.buttonUp {
background-image: url(css/img/mCSB_buttons.png);
background-position: -80px 0px;
background-repeat: no-repeat;
color: rgb(238, 238, 238);
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
top : -7px;
width: 16px;
}
.buttonDown {
background-image: url(css/img/mCSB_buttons.png);
background-position: -80px -20px;
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
bottom : -15px;
width: 16px;
}

</style>
<div class="row">
  <?php 
    $requestUri = $_SERVER['REQUEST_URI'];
    $urlArray = explode("/", $requestUri);
    $nextPage = "";
    foreach ($urlArray as $index) {
      if(preg_match("#\?page=#", $index)) {
        debug($index,'initial');
        $index = preg_replace("#index\?page=#","",$index);
        debug($index,"index");
        $nextPage = $index + 1;
        debug($nextPage);
     }
    }

    if($nextPage == ""){
      $nextPage = 2;
    }
  ?>
	<div class="span6" style = "height : 400px;">
		<div class="page-header">
			<h1><?php echo isset($title)?$title:'Le blog'; ?></h1>
		</div>
    <div class="post">
  		<?php foreach ($posts as $k => $v): ?>
  		<div class="clearfix">
  			<h3><?php echo $v->name; ?><small>,<a href="<?php echo Router::url('posts/category/slug:'.$v->catslug); ?>"><?php echo $v->catname; ?></a></small></h3>
  			
  			<!-- <img src="<?php echo './img/'.$v->name; ?>" alt=""> -->
        <!-- <?php debug($v->slug); ?> -->
  			<?php echo substr(strip_tags($v->content),0,300); ?>...
  		</div>
  		<p style="text-align:right"><a href="<?php echo Router::url("posts/view/id:{$v->id}/slug:$v->slug"); ?>">Lire la suite &rarr;</a></p>
  		<p>&nbsp;</p>
  		<?php endforeach ?>
    </div>

    <!-- <div class="pagination">
      <ul>
        <?php for($i=1; $i <= $page; $i++): ?>
        <li <?php if($i==$this->request->page) echo 'class="active"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>
    </ul> -->

    <?php if ($nextPage <= $page): ?>     
    <div class="navigation">
      <a class="next-posts" href="<?php echo Router::url('lookFor/posts/index?page='.$nextPage); ?>">2</a>
    </div> 
    <?php endif ?>

	</div>
    
  <!-- <div class="scrollTools">
    <a href="#" id="up" class = "buttonUp"></a>
    <a href="#" id="down" class = "buttonDown"></a>
  </div> -->
</div>
	<?php //require('sidebar.php'); ?>


    <script type="text/javascript">
        $(document).ready(function() {
          $(".span6").niceScroll(); // First scrollable DIV 
          $.ias({
              container : '.span6',
              item: '.post',
              pagination: '.span6 .navigation',
              next: '.next-posts:last',
              loader: '<img src="css/img/loading.gif"/>',
              history : false,
              scrollContainer : $(".span6")
              // triggerPageThreshold: 2
          });

          // $("#ascrail2000").css("background-color","rgba(0, 0, 0, 0.14902)");
          // $("#ascrail2000").css("z-index","auto");
          // $("#ascrail2000").css("cursor","pointer");
          // $("#ascrail2000").css("width","3px");
          // $("#ascrail2000").append($(".scrollTools"));

          // var scroller = $("#ascrail2000-hr").find("div");
          // scroller.css('left', "2px");
          // var scrollerHr = $("#ascrail2000").find("div");
          // scrollerHr.css('left', "2px");

          // var nice = $(".span6").getNiceScroll();
          // var margin = 0;
          // $("#down").mousedown(function () {
          //   margin +=250;
          //   nice[0].doScrollTop(margin,500);
          //   console.log(margin);
          // });
          // $("#up").click(function () {
          //   if(margin != 0) {
          //     margin -= 250;
          //   }
          //   nice[0].doScrollTop(margin,500);
          // });


        });
    </script>