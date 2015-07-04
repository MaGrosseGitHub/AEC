<!-- <title>TEST de title</title> -->

<div class="row-fluid">
<div id="view"></div>
  <!-- <div id="myModal"></div> -->
  <div class="actu col-md-12">
    <div class="page-header">
      <h1><?php echo isset($title)?$title:'Le blog'; ?></h1>
    </div>

    <div id ="posts" class="posts"> 
      <?php foreach ($posts as $k => $v): ?>
      <div class="post" data-date = "<?php echo $v->created; ?>">
        <filter class =  "type" ><?php echo $v->category_id; ?></filter>
      <div class="clearfix">
        <h3><?php echo $v->name; ?>
          <small>,
            <a href="<?php echo Router::url('posts/category/slug:'.$v->category_id); ?>"><?php echo $v->category_id; ?></a>,
            <a href="<?php echo Router::url('users/slug:'.$v->user_id); ?>"><?php echo $v->user_id; ?></a>,
          </small>
        </h3>
        
        <?php echo HTML::getImg("cache/post/".$v->slug.'/'.$v->slug."_150x100.jpg", null, null, null, true); ?>
        <div class="newsPreview"><?php echo substr(strip_tags($v->content),0,300); ?>...</div>
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
      <a class="next-posts" href="<?php echo Router::url('lookFor/posts/index?page='.$nextPage); ?>">Plus de contenu</a>
    <?php endif ?>
    </div> 

      </div>
      <?php endforeach ?>
    </div>

  </div>
  
</div>

<?php //echo HTML::JS("jquery.mixitup.min"); ?>
<?php //echo HTML::JS("jquery.mixitup"); ?>
<script type="text/javascript">
        $(document).ready(function() {

        $('filter').hide();
        $('filterInput').hide();
        prevPageTitle = "Index";


        // $('#posts').mixitup({
        //   targetSelector: '.mix',
        //   filterSelector: '.mixFilter',
        //   sortSelector: '.mixSort',
        //   buttonEvent: 'click',
        //   effects: ['fade'],
        //   multiFilter: true,
        // });

        $(".post").DataFilter({
          div : true,
          appendTo : $('.posts'),
          filterTypes : {
            type : ['parapente', 'parachute', 'aviation']
          }
        });

        $.ias({
            container : '.posts',
            item: '.post',
            pagination: '.posts .navigation',
            next: '.next-posts:last',
            loader: '<img src="<?php echo Router::url("css/img/loading.gif"); ?>"/>',
            history : false,
            triggerPageThreshold : 100,
            onRenderComplete: function(pageNum, pageUrl, scrollOffset) {
                $(".post").DataFilter({
                  // update : false,
                  div : true,
                  appendTo : $('.posts'),
                  filterTypes : {
                    type : ['parapente', 'parachute', 'aviation']
                  }
                });

                var filterContainer = $(".filterDiv:last").show();
                $(".filterDiv").remove();
                $(".posts").prepend(filterContainer);
            }
        });

    });
</script>