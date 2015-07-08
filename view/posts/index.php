<!-- <title>TEST de title</title> -->
<?php echo HTML::CSS("View/Posts/index"); ?>
<span id="menuSelected">3</span>
<div class="row">
<div id="view"></div>
  <!-- <div id="myModal"></div> -->
  <div class="actu col-md-12">
    <div class="page-header">
      <h1><?php echo isset($title)?$title:'Le blog'; ?></h1>
    </div>

    <div id ="posts" class="posts"> 
    
      <div class="container">
        <section class="grid3d vertical" id="grid3d">
          <div class="grid-wrap">
            <div class="grid">
            <ul class="trucmuche cs-style-4">
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/1.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/2.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/3.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/4.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/5.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              <li>
                <figure>
                  <div><?php echo HTML::getImg("posts/6.jpg"); ?></div>
                  <figcaption>
                    <h3>Safari</h3>
                    <span>Jacob Cummings</span>
                    <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
                  </figcaption>
                </figure>
              </li>
              
            </ul>
              <!-- <figure><?php echo HTML::getImg("posts/1.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/5.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/8.jpg"); ?></figure>
              <figure><?php  echo HTML::getImg("posts/2.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/4.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/3.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/9.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/6.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/7.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/1.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/5.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/8.jpg"); ?></figure>
              <figure><?php  echo HTML::getImg("posts/2.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/4.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/3.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/9.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/6.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/7.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/1.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/5.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/8.jpg"); ?></figure>
              <figure><?php  echo HTML::getImg("posts/2.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/4.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/3.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/9.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/6.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/7.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/1.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/5.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/8.jpg"); ?></figure>
              <figure><?php  echo HTML::getImg("posts/2.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/4.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/3.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/9.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/6.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/7.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/1.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/5.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/8.jpg"); ?></figure>
              <figure><?php  echo HTML::getImg("posts/2.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/4.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/3.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/9.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/6.jpg"); ?></figure>
              <figure><?php echo HTML::getImg("posts/7.jpg"); ?></figure> -->
            </div>
          </div><!-- /grid-wrap -->
          <div class="content">
            <div data-url = "<?php echo Router::url("lookFor/posts/view/id:39/slug:lorem-ipsum"); ?>">
              <p class="dummy-text"></p>            
            </div>
            <div>
              <div class="dummy-img"></div>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
            </div>
            <div>
              <div class="dummy-img"></div>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
            </div>
            <div>
              <div class="dummy-img"></div>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
            </div>
            <div>
              <div class="dummy-img"></div>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
            </div>
            <div>
              <div class="dummy-img"></div>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
            </div>
            <div>
              <div class="dummy-img"></div>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
            </div>
            <div>
              <div class="dummy-img"></div>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
            </div>
            <div>
              <div class="dummy-img"></div>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
              <p class="dummy-text">The only people for me are the mad ones, the ones who are mad to live, mad to talk, mad to be saved, desirous of everything at the same time, the ones who never yawn or say a commonplace thing, but burn, burn, burn like fabulous yellow roman candles exploding like spiders across the stars.</p>
            </div>
            <span class="loading"></span>
            <span class="icon close-content"></span>
          </div>
        </section>
      </div><!-- /container -->


      <?php //foreach ($posts as $k => $v): ?>
      <!-- <div class="post" data-date = "<?php //echo $v->created; ?>">
        <filter class =  "type" ><?php //echo $v->category_id; ?></filter>
      <div class="clearfix">
        <h3><?php //echo $v->name; ?>
          <small>,
            <a href="<?php //echo Router::url('posts/category/slug:'.$v->category_id); ?>"><?php //echo $v->category_id; ?></a>,
            <a href="<?php //echo Router::url('users/slug:'.$v->user_id); ?>"><?php //echo $v->user_id; ?></a>,
          </small>
        </h3>
        
        <?php //echo HTML::getImg("cache/post/".$v->slug.'/'.$v->slug."_150x100.jpg", null, null, null, true); ?>
        <div class="newsPreview"><?php //echo substr(strip_tags($v->content),0,300); ?>...</div>
      </div>
      <p style="text-align:right">
        <a class = "ajax" href="<?php //echo Router::url("lookFor/posts/view/id:{$v->id}/slug:$v->slug"); ?>">
          Lire la suite &rarr;
        </a>
      </p>
      <p>&nbsp;</p> 
 -->
    <!-- <div class="navigation" style = "display : none;">
    <?php /*
      $nextPage = $curPage+1;
      if ($curPage < $page): */
      ?> 
      <a class="next-posts" href="<?php //echo Router::url('lookFor/posts/index?page='.$nextPage); ?>">Plus de contenu</a>
    <?php //endif ?>
    </div>  -->

      <!-- </div> -->
      <?php //endforeach ?>
    <!-- </div> -->

  </div>
  
</div>

<?php //echo HTML::JS("jquery.mixitup.min"); ?>
<?php //echo HTML::JS("jquery.mixitup"); ?>
<?php echo HTML::JS("//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"); ?>
<?php echo HTML::JS("View/Post/classie"); ?>
<?php echo HTML::JS("View/Post/helper"); ?>
<?php echo HTML::JS("View/Post/grid3d"); ?>

<script type="text/javascript">
  menuSelected = 3;
  $(document).ready(function() {
    new grid3D( document.getElementById( 'grid3d' ) );

    $(window).resize(function() {
      // This will execute whenever the window is resized
      // $(window).height(); // New height
      // $(window).width(); // New width
      changeGridOrientation();
    });

    changeGridOrientation();
    function changeGridOrientation(){      
      if($(window).width() < 770){
        if($("#grid3d").hasClass("vertical")){
          $("#grid3d").removeClass("vertical").addClass("horizontal")
        }
      } else {
        if($("#grid3d").hasClass("horizontal")){
          $("#grid3d").removeClass("horizontal").addClass("vertical")
        }
      }
    }

    // $.ias({
    //     container : '.posts',
    //     item: '.post',
    //     pagination: '.posts .navigation',
    //     next: '.next-posts:last',
    //     loader: '<img src="<?php echo Router::url("css/img/loading.gif"); ?>"/>',
    //     history : false,
    //     triggerPageThreshold : 100,
    //     onRenderComplete: function(pageNum, pageUrl, scrollOffset) {
    //         $(".post").DataFilter({
    //           // update : false,
    //           div : true,
    //           appendTo : $('.posts'),
    //           filterTypes : {
    //             type : ['parapente', 'parachute', 'aviation']
    //           }
    //         });

    //         var filterContainer = $(".filterDiv:last").show();
    //         $(".filterDiv").remove();
    //         $(".posts").prepend(filterContainer);
    //     }
    // });

  });
</script>