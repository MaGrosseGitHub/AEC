<?php $title_for_layout = "Galerie"; ?>

<style>
    
    .md-modal {
      top: 10%;
      left : 35%;
    }
    
    .file:hover {
      cursor : pointer;
    }
    .file {
      padding: 0 10px;
      border: 1px solid #DFDFDF;
      /*line-height: 70px;*/
      margin-bottom: 10px;
      display : inline-block;
      width : 190px;
      height : 130px;
      }

    .file img {
      margin : 10px;
    }

    .delete, .deleteImg, .addImg {
      position : relative;
      top : -100px;
      left : 120px;
      background: #FFF;
    }

    /*.addToAlbum{
      position : relative;
      top : -130px;
      left : -70px;
      background: #FFF;
    }*/

    .action, .imgName, .delete {
      display : inline-block;
    }

    .imgName{   
      position : relative;
      top : -20px;  
      left : 20px;
      width : 120px;
      height : 20px;
      overflow: hidden;
      background: #FFF;
    }

    .albumDiv{
      background: #FF0;
    }

    .albumEmpty{
      display: none
    }

    .progressbar {
      position: absolute;
      top: 25px;
      right: 5px;
      width: 150px;
      height: 20px;
      background-color: #abb2bc;
      -moz-border-radius: 25px;
      -webkit-border-radius: 25px;
      -o-border-radius: 25px;
      -ms-border-radius: 25px;
      -khtml-border-radius: 25px;
      border-radius: 25px;
      -moz-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5);
      -webkit-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5);
      -o-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5);
      box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5); }
    .progress {
      position: absolute;
      border: 1px solid #4c8932;
      height: 18px;
      width: 10%;
      background: url(<?php echo HTML::getImg("progress.jpg", true, true); ?>) repeat;
      -webkit-animation: progress 2s linear infinite;
      -moz-border-radius: 25px;
      -webkit-border-radius: 25px;
      -o-border-radius: 25px;
      -ms-border-radius: 25px;
      -khtml-border-radius: 25px;
      border-radius: 25px; }

@-webkit-keyframes progress {
  from {
    background-position: 0 0; }

  to {
    background-position: 54px 0; } }

.clear{
  clear : both;
}

#lightbox{
  padding : 0;
  margin : 0;
}

.imgLightbox{  
  background : #232323;
  text-align: center;
}

.imgLightbox img{
  max-width : 100%;
  max-height: 100%;
}

.md-close{
  border : none;
  border-left : 1px solid rgba(129,129,129,0.5);
  background : none;
  font-family: "Segoe UI Light"; 
  text-align: center;
  color : #818181;
  opacity: 0.8;
  height : 1.5em;
  width : 1.25em;
  position : absolute;
  top : -13px;
  right : 0px;
  font-size: 1.5em;
}
</style>
  <!-- <div class="md-modal md-effect-1" id="modal-1">
    <div class="md-content" style = "overflow-y : scroll;">
      <h3><button class="md-close" style="font-size: 1.5em;">x</button> Galerie </h3>
        <div id="lightbox"></div>
    </div>
  </div>

  <div class="md-overlay"></div>
  <div class="md-history" style = "display : none"></div> -->
  <!-- Button to trigger modal -->
 
<!-- Modal -->

 <!-- <a href="#myModal" role="button" class="btn" data-toggle="modal">modal</a> -->
 <a href="#myModal" role="button" id="testButton">modal</a>
<div class="modal hide fade" id = "myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Close</a>
    <a href="#" class="btn btn-primary">Save changes</a>
  </div>
</div>
    <script type="text/javascript">
        var modalOriginPos, hoverImg, hoverImgSrc, imgGray, urlOrigin = location.href;
        $(document).ready(function() {
$("#testButton").click(function(){
  $('#myModal').modal('toggle');
})
            modalOriginPos = $('.md-modal').offset();
            console.log(modalOriginPos);
        });
    </script> 

<div id="test">Lorem ipsum Aliquip et nostrud commodo velit et exercitation non et minim aliquip sed ad aliqua velit elit incididunt in voluptate enim dolor aute consequat incididunt Ut eiusmod reprehenderit Ut quis labore aliqua dolore cupidatat non ea adipisicing amet dolore adipisicing eu anim irure do quis aliqua culpa minim ullamco ut ea velit Duis eiusmod mollit labore sed enim veniam laborum voluptate sunt dolor consectetur enim enim mollit in eu sint in irure magna laboris ea in laboris ea officia culpa velit commodo ut elit esse aliquip sint ut sint eu nostrud eu veniam magna tempor Excepteur laboris dolore ea velit laborum do eu occaecat aliquip elit quis voluptate amet deserunt consequat est irure Excepteur dolor ut exercitation ad esse Excepteur culpa et laborum ut minim magna fugiat occaecat deserunt nulla ea dolor ut anim consequat id pariatur consectetur culpa sit Ut in ex tempor mollit culpa cillum cupidatat mollit id fugiat cupidatat ullamco officia culpa labore commodo pariatur aliquip non magna adipisicing irure sint sed ut qui in veniam exercitation mollit.</div>

<div class="row">
  <div class="col-md-12">
  <div class="galerie">
    <div id="filelist">
    			<?php 
            // debug($albums);
            foreach ($images as $imgId => $image): 
              // debug($image);
              if($image->album == "" || $image->type == "album"):
                $img = "";
                $type = "";
                if($image->type == "album") {
                  if($image->album != "") {
                    echo '<div class="file albumDiv">';
                    $img = explode(",", $image->album);
                    $img = $img[0];
                    $type = 'album'; 
                  } else {
                    echo '<div class="file albumEmpty">';
                    // echo '<div class="file albumEmpty">';
                    $img = "nofile.png";
                  }
                } else {
                  echo '<div class="file">';
                  $img = $image->file;
                  $type = "img"; 
                }

                if($img != "nofile.png" || ($image->album != "" && $image->type == "album")){
                  $imgInfo = pathinfo($img);
                  $imgExt = $imgInfo['extension'];
                  $minImg = str_replace(".".$imgExt, "", $imgInfo['basename']).'_150x100.'.$imgExt;
                  $minImgGray = "grayscale_".$minImg;
                  $imgGray = str_replace($imgInfo['basename'], $minImgGray, $img);
                  $img = str_replace($imgInfo['basename'], $minImg, $img);                  
                }

            ?>
                  <a class = "photo md-trigger" data-modal="modal-1" href="#" style = "display : block;">
                    <?php echo HTML::getImg($img, false, false, 'height="100" width ="150px"', true); ?>
                  </a> 
                  <a class = "photo grayscale md-trigger" data-modal="modal-1" href="#" style = "display : none;">
                    <?php echo HTML::getImg($imgGray, false, false, 'height="100" width ="150px" class = "grayscaleImg style = "display : none;""', true); ?>
                  </a>
      						<div class="actions">
                    <!-- Image/Album name -->
                     <div class="imgName"> 
                      <?php echo $image->id; ?> 
                      <!-- <a href="#myModal" role="button" class="btn" data-toggle="modal">modal</a> -->
                      </div>
      						</div>            
                </div>
            <?php endif ?>
    			<?php endforeach ?>


    <div class="navigation">
    <?php 
      $nextPage = $curPage+1;
      debug($nextPage);
      if ($curPage < $page): 
      ?> 
      <a class="next-posts" href="<?php echo Router::url('lookFor/medias/index?page='.$nextPage); ?>">Plus de contenu</a>
    <?php endif ?>
    </div> 

    </div><!-- end filelist -->
    </div><!-- end galerie -->
  </div><!-- end col12 -->
</div><!-- end row -->

    <script type="text/javascript">
        $(document).ready(function() {
            var viewportHeight;
            var viewportWidth;
            if (document.compatMode === 'BackCompat') {
                viewportHeight = document.body.clientHeight;
                viewportWidth = document.body.clientWidth;
            } else {
                viewportHeight = document.documentElement.clientHeight;
                viewportWidth = document.documentElement.clientWidth;
            }

           //  var modalHeight = viewportHeight-150;
           //  var modalWidth = viewportWidth-250;
           //  console.log(modalWidth);

           //  var modalOriginPos = $('.md-modal').offset();
           //  $('.md-modal').offset({ top: -1000, left: -1000 });
           //  $('.md-content').css('height', modalHeight);
           //  $('.md-content').css('width', modalWidth);
           //  // $('img.imgLightbox').css('max-height', modalHeight);
           //  // $('img.imgLightbox').css('width', modalWidth);

           // $('a.md-trigger').find('img').on('hover', function(){
           //      hoverImg = $(this).attr('src');
           //      imgGray = $(this).parent().next().find('img').attr('src');
           //      $(this).attr('src', imgGray);
           //      // $(this).fadeTo(1000,0.5).attr('src', imgGray).fadeTo(500,1)              
           //  }).on('mouseout', function(){
           //      $(this).attr('src', hoverImg.replace('grayscale_', ''));
           //  });

           //  $('.md-trigger').on('click', function(){
           //      $('.md-modal').offset(modalOriginPos);                
           //      if(isHistoryAvailable){
           //        console.log(urlOrigin);
           //        var formatedUrl = location.href+'testdeurl';
           //        history.replaceState({key : $("title").text(), 'url' : formatedUrl}, $("title").text(), formatedUrl);
           //      }

           //      var img = $(this).find('img');
           //      var imgVal = $(img).attr('src');
           //      imgVal = imgVal.replace("_150x100","");
           //      imgVal = imgVal.replace("grayscale_","");

           //      $("#lightbox").html($('#test').html());
           //      $("#lightbox").prepend('<div class="imgLightbox"><img src = "'+imgVal+'"></div>');

           //      return false;
           //  });

           //  $('.md-close').on('click', function(){    
           //    console.log('close');           
           //      if(isHistoryAvailable){
           //        history.replaceState({key : $("title").text(), 'url' : urlOrigin}, $("title").text(), urlOrigin);
           //      }
           //  });

           //  $('.md-overlay').on('click', function(){     
           //    console.log('close');                     
           //      if(isHistoryAvailable){
           //        history.replaceState({key : $("title").text(), 'url' : urlOrigin}, $("title").text(), urlOrigin);
           //      }
           //  });

            $.ias({
                container : '#filelist',
                item: '.file',
                pagination: '#filelist .navigation',
                next: '.next-posts:last',
                loader: '<img src="<?php echo Router::url("css/img/loading.gif"); ?>"/>',
                history : false,
                triggerPageThreshold : 100
            });
        });
    </script> 
<!--
<script>
  // this is important for IEs
  var polyfilter_scriptpath = "<?php echo Router::webroot('js/modal/'); ?>";
</script>
<?php echo HTML::JS("modal/classie"); ?>
<?php echo HTML::JS("modal/modalEffects"); ?>
<?php echo HTML::JS("modal/cssParser"); ?>
<?php echo HTML::JS("modal/css-filters-polyfill"); ?>-->

  

