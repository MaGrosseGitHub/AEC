<!-- <title>TEST de title</title> -->


<div class="row">
<div id="view"></div>
  <!-- <div id="myModal"></div> -->
  <div class="actu col-md-12">
    <div class="page-header">
      <h1><?php echo isset($title)?$title:'Le blog'; ?></h1>
    </div>
    <div class="posts">
      <totalPosts><?php echo $page; ?></totalPosts>  
      <?php foreach ($posts as $k => $v): ?>
      <div class="post">
        <filter class =  "type"><?php echo $v->category_id; ?></filter>
      <div class="clearfix">
        <h3><?php echo $v->name; ?><small>,<a href="<?php echo Router::url('posts/category/slug:'.$v->category_id); ?>"><?php echo $v->category_id; ?></a></small></h3>
        
        <?php echo HTML::getImg("cache/post/".$v->slug.DS.$v->name."_150x100.jpg", null, null, null, true); ?>
        <?php echo substr(strip_tags($v->content),0,300); ?>...
      </div>
      <p style="text-align:right">
        <a class = "ajax" href="<?php echo Router::url("lookFor/posts/view/id:{$v->id}/slug:$v->slug"); ?>">
          Lire la suite &rarr;
        </a>
      </p>
      <p>&nbsp;</p> 

    <div class="navigation" style = "display : none;">
    <?php 
      $nextPage = $curPage+1;
      if ($curPage < $page): 
      ?> 
      <a class="next-posts" href="<?php echo Router::url('lookFor/posts/index?page='.$nextPage); ?>">More content</a>
    <?php endif ?>
    </div> 

      </div>
      <?php endforeach ?>
    </div>

  </div>
  
</div>


<script type="text/javascript">
        $(document).ready(function() {

        $('filter').hide();
        $('filterInput').hide();

        $('totalPosts').hide();

        $(".posts").change(function(){
          console.log("CHANGE");
        })

        $(".post").DataFilter({
          div : true,
          appendTo : $('.posts'),
          filterTypes : {
            type : ['parapente', 'parachute', 'aviation']
          },
          callback : function(){
            console.log("test callback");
          },
        });

        $.ias({
            container : '.posts',
            item: '.post',
            pagination: '.posts .navigation',
            next: '.next-posts:last',
            loader: '<img src="<?php echo Router::url("css/img/loading.gif"); ?>"/>',
            history : false,
            triggerPageThreshold : 100,
            onPageChange: function(pageNum, pageUrl, scrollOffset) {
                $(".post").DataFilter({
                  div : true,
                  appendTo : $('.posts'),
                  filterTypes : {
                    type : ['parapente', 'parachute', 'aviation']
                  },
                  callback : function(){
                    console.log("test callback");
                  },
                });

                var filterContainer = $(".filterDiv:last").show();
                $(".filterDiv").remove();
                $(".posts").prepend(filterContainer);
            }
            // onPageChange: function() {
            //     console.log("test");
            // }
            // scrollContainer : $(".span13")
            // triggerPageThreshold: 2
        });

    });
</script>