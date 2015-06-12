<?php $title_for_layout = "Galerie"; ?>
<!--
<style>
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

@-webkit-keyframes progress {
  from {
    background-position: 0 0; }

  to {
    background-position: 54px 0; } }
</style> -->
<style>
.clear{
  clear : both;
}

#imgModal{
  border : none;
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

/* Modal CSS */

.blur{
  filter: blur(2px);
}

.grayscale{
  filter: grayscale(1);
}

.modal.modal-wide .modal-dialog {
  width: 90%;
}
.modal-wide {
  overflow-y: auto;
}

/*.close{
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
}*/

.fullScreen{
  text-align: center;
  background : #232323;
  padding-left: 25%;
}

.modal-body{
  padding: 0px;
}
.modal-footer{
  margin-top: 0px;
  padding : 10px;
}

.feuilles{
  /*height:500px;*/
  /*background:#FFF;*/
  box-shadow:
  0 1px 1px rgba(0,0,0,0.40),
    0 10px 0 -5px #F7F7F7,
    0 11px 1px -5px rgba(0,0,0,0.40),
      0 22px 0 -12px #F7F7F7,
      0 23px 1px -12px rgba(0,0,0,0.40),
        0 34px 0 -19px #F7F7F7,
        0 35px 1px -19px rgba(0,0,0,0.40);
      
-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.40), 0 10px 0 -5px #F7F7F7, 0 11px 1px -5px rgba(0,0,0,0.40), 0 22px 0 -12px #F7F7F7, 0 23px 1px -12px rgba(0,0,0,0.40), 0 34px 0 -19px #F7F7F7, 0 35px 1px -19px rgba(0,0,0,0.40);

-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.40), 0 10px 0 -5px #F7F7F7, 0 11px 1px -5px rgba(0,0,0,0.40), 0 22px 0 -12px #F7F7F7, 0 23px 1px -12px rgba(0,0,0,0.40), 0 34px 0 -19px #F7F7F7, 0 35px 1px -19px rgba(0,0,0,0.40);
}

.albumNav ul{
  display : inline;
  background: red;
}

.albumNav li{
  display : inline;
  width : 20px;
  height : 20px;
  color : #FFF;
}




.imgLightbox:hover .prevButton, .imgLightbox:hover .nextButton {
  display: inline-block;
}

/*.originalImg:hover ~ .prevButton, .originalImg:hover ~ .nextButton {
  display: inline-block;
}*/

.fullscreenDiv:hover .prevButton, .fullscreenDiv:hover .nextButton{
  display: inline-block;
}

.prevButton, .nextButton{
  height: 100%;
  position : absolute;
  top : 0px;
  padding : 10px;
  width : 70px;
  color : #FFF;
  vertical-align: middle;
  background: rgba(0,0,0,0.2);
  display: none;
}

.prevButton:hover #prevImg img, .nextButton:hover #nextImg img {
  opacity: 1;
}


.prevButton{
  left : 0px;
}

.nextButton{
  right : 0px;
}

#prevImg img, #nextImg img{
  position: absolute;  
  top: 0;  
  bottom: 0;  
  left: 0;  
  right: 0;  
  margin: auto; 
  opacity: 0.2;
  transition: opacity 0.2s;
  -webkit-transition: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  -o-transition: opacity 0.2s;
  -ms-transition: opacity 0.2s;
}
#prevImg img{
  -moz-transform: scaleX(-1);
  -o-transform: scaleX(-1);
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1); 
}

/*img .photo:hover{
  filter: grayscale(1);
}*/

.file .photo {

  -webkit-filter: grayscale(0);
  -moz-filter: grayscale(0);
  -ms-filter: grayscale(0);
  -o-filter: grayscale(0);
  filter: grayscale(0);

  transition:all 1s linear;
  -webkit-transition:all 1s linear;
  -moz-transition:all 1s linear;
  -ms-transition:all 1s linear;
  -o-transition:all 1s linear;
}
.file:hover .photo {
  -webkit-filter: grayscale(1);
  -moz-filter: grayscale(1);
  -ms-filter: grayscale(1);
  -o-filter: grayscale(1);
  filter: grayscale(1);

  transition:all 0.25s linear;
  -webkit-transition:all 0.25s linear;
  -moz-transition:all 0.25s linear;
  -ms-transition:all 0.25s linear;
  -o-transition:all 0.25s linear;
}


</style>
<?php echo HTML::CSS("bookblock"); ?>
    <!-- <div class="md-content" style = "overflow-y : scroll;"> -->
      <!-- <h3><button class="md-close" style="font-size: 1.5em;">x</button> Galerie </h3> -->
        
<!-- Modal -->
<div class="modal modal-wide fade" id="imgModal" style="overflow-y: auto;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Galerie</h4>
      </div>
      <div class="modal-body">
        <!-- <div id="lightbox"></div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

  <!-- /.empty grid li -->
  <li class="file grid cs-style-7" style="top : 20px; z-index : 100; display : none;">
    <figure>                    
      <div class="imgTrigger">
        <a href="#" class="mdTrigger album" style="display : block;">
          <img src="#" class="photo" height="135px" width="180px" slug="#">
        </a> 
      </div>
      <figcaption class="imgCaption">
        <h3>#</h3>
        <span>#</span>
        <a href="#" class="mdTrigger hastip" title="">
          view 
        </a>
      </figcaption>
    </figure>
  </li><!-- /.empty grid li -->

</div><!-- /.modal -->

<div class="row">
  <div class="col-md-12">

<section class="container tooltip" title="Parent container">
    <a href="http://google.com" class="tooltip" title="Get your Google on">Google</a>
  </section>
  <div class="galerie">
    <ul class="filelist">     
    			<?php 

            function RandAlbumImgs($input, $output){
              $randImg = rand(0,(count($input)-1));
              if(!in_array($randImg, $output)){
                return intval($randImg);
              } else {
                return RandAlbumImgs($input, $output);
              }
            }

            $zIndex = 100;
            $albumsArray = array();
            foreach ($images as $imgId => $image): 
              // debug($image);
              $zIndex++;
              if($image->album == "" || $image->type == "album"):
                $img = "";
                $type = "";
                if($image->type == "album") {
                  if($image->album != "") {
                    echo '<li class="file album albumDiv grid cs-style-7 bb-custom-grid" style = "top : 20px; z-index : '.$zIndex.'">
                            <figure class = "feuilles">';
                    $almbumImgs = explode(',', $image->album);
                    $tempAlbum = array();
                    foreach ($almbumImgs as $imgKey => $albumImg) {
                      $albumImgInfo = pathinfo($albumImg);

                      $id = $image->id;
                      $imgExt = $albumImgInfo['extension'];
                      $minImg = str_replace(".".$imgExt, "", $albumImgInfo['basename']).'_150x100.'.$imgExt;
                      $albumImgThumb = str_replace($albumImgInfo['basename'], $minImg, $albumImg);
                      
                      $slug = $image->user.'!'.$image->name.'!'.$albumImgInfo['filename'];
                      $albumImgUrl = Router::url("medias/view/id:$id/slug:$slug");

                      $tempAlbum['origin'] = $albumImg;
                      $tempAlbum['dirname'] = $albumImgInfo['dirname'];
                      $tempAlbum['basename'] = $albumImgInfo['basename'];
                      $tempAlbum['extension'] = $albumImgInfo['extension'];
                      $tempAlbum['filename'] = $albumImgInfo['filename'];
                      $tempAlbum['url'] = $albumImgUrl;
                      $tempAlbum['thumb'] = Router::webroot("img/$albumImgThumb");
                      $tempAlbum['phpThumb'] = $albumImgThumb;
                      $tempAlbum['slug'] = $slug;
                      // $tempAlbum['thumb'] = HTML::getImg($albumImgUrl, false, false, 'class = "photo" height="135px" width ="180px" slug = "'.$slug.'"', true);
                      $albumsArray[$image->name.'_'.$image->user][] = $tempAlbum;
                    } 
                    $nbImgs = count($almbumImgs);
                    $albumsArray[$image->name.'_'.$image->user]['nbImgs'] = $nbImgs;
                    $img = explode(",", $image->album);
                    $img = $img[0];
                    $type = 'album'; 
                  } else {
                    // echo '<div class="file albumEmpty">';
                    echo '<li class="file album albumEmpty grid cs-style-7" style = "top : 20px; z-index : '.$zIndex.'">
                            <figure class = "feuilles">';
                    $img = "nofile.png";
                  }
                } else {
                  // echo '<div class="file">';
                  echo '<li class="file grid cs-style-4">
                            <figure>';
                  $img = $image->file;
                  $type = "img"; 
                }

                if($img != "nofile.png" || ($image->album != "" && $image->type == "album")){
                  $id = $image->id;
                  $originImg = $img;
                  $imgInfo = pathinfo($img);
                  $imgExt = $imgInfo['extension'];
                  $minImg = str_replace(".".$imgExt, "", $imgInfo['basename']).'_150x100.'.$imgExt;
                  $minImgGray = "grayscale_".$minImg;
                  $imgGray = str_replace($imgInfo['basename'], $minImgGray, $img);
                  $img = str_replace($imgInfo['basename'], $minImg, $img);
                  
                  $slug = $image->user.'!'.$imgInfo['filename'];
                  $imgUrl = Router::url("medias/view/id:$id/slug:$slug");
                }

            ?>
                    <div class = "imgTrigger">
                      <?php if ($image->type == "album"): ?>
                      <div class="bb-bookblock">
                        <?php 
                          if(count($almbumImgs) >= 5){
                            $randImgs = array();
                            for($i = 0; $i < 4; $i++){
                              $randImg = RandAlbumImgs($almbumImgs, $randImgs);
                              array_push($randImgs, $randImg);
                          ?>
                          <div class="bb-item">
                            <a href = "<?php echo $image->name.'_'.$image->user; ?>" class="mdTrigger" style = "display : block;">
                              <?php echo HTML::getImg($albumsArray[$image->name.'_'.$image->user][$randImg]['phpThumb'], false, false, 'class = "photo" height="135px" width ="180px" slug = "'.$albumsArray[$image->name.'_'.$image->user][$randImg]['slug'].'"', true); ?>
                            </a>
                          </div>
                          <?php
                            }
                          } else {
                            for($i = 0; $i < count($almbumImgs); $i++){
                          ?>
                          <div class="bb-item">
                            <a href = "<?php echo $image->name.'_'.$image->user; ?>" class="mdTrigger" style = "display : block;">
                              <?php echo HTML::getImg($albumsArray[$image->name.'_'.$image->user][$i]['phpThumb'], false, false, 'class = "photo" height="135px" width ="180px" slug = "'.$slug.'"', true); ?>
                            </a>
                          </div>
                          <?php
                            }
                          }
                        ?>
                      </div>
                      <?php else : ?>
                      <a href = "<?php echo $imgUrl; ?>" class="mdTrigger" style = "display : block;">
                        <?php echo HTML::getImg($img, false, false, 'class = "photo" height="135px" width ="180px" slug = "'.$slug.'"', true); ?>
                      </a> 
                      <?php endif ?>
                        <!-- height="195px" width ="260px" -->
                    </div>
                    <figcaption class = "imgCaption">
                      <h3>
                        <?php 
                          echo ($image->type == "album" ? "$image->name ($nbImgs)" : $image->id);
                        ?>
                      </h3>
                      <span class = "author"><?php echo $image->user; ?></span>
                      <a href = "<?php echo $imgUrl; ?>" class="mdTrigger hastip" title = "TEST de tootltipster"> view </a>
                      <?php if ($image->type == "album"): ?>
                        <nav class="albumNav">
                          <span class="bb-current"></span>
                          <?php 
                            if(count($almbumImgs) >= 5) {
                              for($i = 0; $i < 3; $i++){
                                echo '<span></span>';
                              }
                            } else {
                              for($i = 0; $i < (count($almbumImgs)-1); $i++){
                                echo '<span></span>';
                              }
                            }
                          ?>
                        </nav>
                    <?php endif ?>
                    </figcaption>
                  </figure></a>
                </li>

            <?php endif ?>
    			<?php endforeach ?>

      <?php 
        $nextPage = $curPage+1;
        if ($nextPage < $page): 
        ?> 
      <div class="navigation">
        <a class="next-posts" href="<?php echo Router::url('lookFor/medias/index?page='.$nextPage); ?>">Afficher Plus de contenu</a>
      </div> 
      <?php endif ?>
    </ul><!-- end filelist -->

    </div><!-- end galerie -->
  </div><!-- end col12 -->
</div><!-- end row -->


    <script type="text/javascript">
    
        var scrollToolsDiv = '<div class="scrollTools"><a href="#" id="up" class = "buttonUp"></a><a href="#" id="down" class = "buttonDown"></a></div>';
        $(document).ready(function() {

            
            var urlOrigin = location.href;
            var viewportHeight, viewportWidth, modalWidth, modalHeight, modalLeft, divideLeft, originModalWidth = 0;
            var curViewedImg, fullscreen = false, firstModal = true;
            // $('.modal-content').css('width', modalWidth+'px');
            // $('.modal-content').css('height', modalHeight+'px');
            // $('.modal-content').css('margin-left', '-'+modalLeft+'px');
            
            // $('img.imgLightbox').css('width', modalWidth);
            // $('img.imgLightbox').css('max-height', modalHeight);
             
            var albumsObject = <?php echo json_encode($albumsArray); ?>; 

            $('li.grid').live('mouseenter', function(){
                // $(this).find('img.photo').addClass('grayscale'); 
                if($(this).hasClass('album')){
                  $(this).find(":first-child").removeClass('feuilles');

                  var $navImgs; 
                  $(this).find('img.photo').css('-webkit-filter', 'grayscale(1)');
                  $(this).find("nav.albumNav").live('mouseenter', function(){
                    $navImgs = $(this).parents('li.grid').find('img.photo')
                    $navImgs.css('-webkit-filter', 'grayscale(0)');
                  }).live('mouseleave', function(){
                    $navImgs = $(this).parents('li.grid').find('img.photo')
                    $navImgs.css('-webkit-filter', 'grayscale(1)');
                  }); 
                }                                          
            }).live('mouseleave', function(){
                if($(this).hasClass('album')){
                  $(this).find('img.photo').css('-webkit-filter', 'grayscale(0)');
                  $(this).find("figure").addClass('feuilles'); 
                }                    
            });

            $('a.mdTrigger, figcaption').live('click', function(event){
                var parentLi = $(this).parents('li');
                var isAlbum = parentLi.hasClass('albumDiv');

                if (document.compatMode === 'BackCompat') {
                    viewportHeight = document.body.clientHeight;
                    viewportWidth = document.body.clientWidth;
                } else {
                    viewportHeight = document.documentElement.clientHeight;
                    viewportWidth = document.documentElement.clientWidth;
                }            

                modalHeight = viewportHeight*0.9;
                modalWidth = viewportWidth*0.9;
                // divideLeft = (viewportWidth - viewportHeight)/10;
                // divideLeft = ((1920/viewportWidth)*-3);
                // modalLeft = (modalWidth/divideLeft) * -1;

                // $('.modal').css('min-height', modalHeight+'px');
                // $('.modal').css('max-height', viewportHeight+'px');


                var imgLinkTrigger = $(this);
                if($(this).hasClass('imgCaption')){
                  imgLinkTrigger = $(this).parent().find('a.mdTrigger');
                }
                var inAlbum = imgLinkTrigger.hasClass('album');
                curViewedImg = $(this).parents('li');

                $("#imgModal").modal();
                if((exists(inAlbum) && !inAlbum) || isAlbum){
                  $(".modal-body").html("");
                  $(".modal-body").empty();
                }
                $('#disqus_thread').html("");
                $('#disqus_thread').empty();
                
                $('.modal-content').css('height', (modalHeight-30)+'px');
                $('.modal-body').css('height', (modalHeight-150)+'px');

                LoadModalContent(imgLinkTrigger, isAlbum, inAlbum);

                $(".modal-content").resizable();

                return false;
            });

            //resize
            $(".modal-content").on("resize", function(event, ui) {
                if(firstModal){
                  originModalWidth = $('.modal-content').width();
                  firstModal = false;
                }
                $(this).find('div.modal-body').width(($(this).width())+'px');
                $(this).find('div.modal-body').css('height', ($(this).height()-150)+'px');
                $(this).find('div.modal-body').find('div.imgLightbox').css('height', ($('.modal-body').height())+'px');
                $(this).find('div.modal-body').find('div#comments').css('height', ($('.modal-body').height())+'px');
            });

            //prev next
            $('a#prevImg, a#nextImg').live('click', function(){
              PrevNextImg($(this));
              return false;
            });

            $('#imgModal').keydown(function(e){
                if (e.keyCode == 37) { //left key
                  PrevNextImg("a#prevImg");
                  return false;
                }
                if (e.keyCode == 39) { //right key
                  PrevNextImg("a#nextImg");
                  return false;
                }
            });

            //fullscreen
            $('.imgLightbox').live('click', function(){

              $('.imgLightbox').fullScreen({
                'background' : '#232323',
                'callback' : function(isFull){
                  fullscreen = isFull;
                  if(isFull){
                    $('.imgLightbox').parent().addClass('fullscreenDiv');
                    $('.imgLightbox').removeClass('col-md-9');
                    $('.originalImg').css('position','absolute');
                    $('.originalImg').css('top',0);
                    $('.originalImg').css('bottom',0);
                    $('.originalImg').css('left',0);
                    $('.originalImg').css('right',0);
                    $('.originalImg').css('margin','auto');
                  } else{
                    $('.originalImg').removeAttr('style');
                    $('.imgLightbox').parent().removeClass('fullscreenDiv');
                    $('.imgLightbox').addClass('col-md-9');

                    $('#loader').removeAttr('style');
                    $('#loaderWhite').removeAttr('style');
                    $('#loader').hide();
                    $('#loaderWhite').hide();
                  }

                }
              });

            })

            //close
            $('#imgModal').live('hide.bs.modal', function () {
                $('.row').removeClass('blur');        
                // if(isHistoryAvailable){
                //   history.replaceState({key : $("title").text(), 'url' : urlOrigin}, $("title").text(), urlOrigin);
                // }
                $(".modal-body").html("");
                $(".modal-body").empty();
                $('#disqus_thread').html("");
                $('#disqus_thread').empty();
                $('#loader').removeAttr('style');
                $('#loaderWhite').removeAttr('style');
                $('#loader').hide();
                $('#loaderWhite').hide();
            });

            function PrevNextImg(elem){
              if($(elem).attr('id') == "prevImg"){
                if(curViewedImg.prev().hasClass('cs-style-7')){
                  curViewedImg = curViewedImg.prev();
                  PrevNextImg(elem);
                  return false;
                }
                if(!fullscreen){
                LoadModalContent(curViewedImg.prev().find('a.mdTrigger'));
                } else{
                LoadModalContentFull(curViewedImg.prev().find('a.mdTrigger'));
                }
                curViewedImg = curViewedImg.prev();
              } else if($(elem).attr('id') == "nextImg"){
                if(curViewedImg.next().hasClass('cs-style-7')){
                  curViewedImg = curViewedImg.next();
                  PrevNextImg(elem);
                  return false;
                }
                if(!fullscreen){
                  LoadModalContent(curViewedImg.next().find('a.mdTrigger'));
                } else{
                  LoadModalContentFull(curViewedImg.next().find('a.mdTrigger'));
                }
                curViewedImg = curViewedImg.next();
              }
            }

            function LoadModalContentFull(imgLinkTrigger){
              var imgUrl = imgLinkTrigger.attr("href");
              var formatedUrl = imgUrl.replace('media/view', 'lookFor_media');  

              $("div.imgLightbox").find('img').fadeTo(500, 0.2);
              $('#loaderWhite').clone().appendTo($("div.imgLightbox"));
              $('#loaderWhite:last').show();
              $('#loaderWhite').css('position','absolute');
              $('#loaderWhite').css('top','50%');
              $('#loaderWhite').css('bottom',0);
              $('#loaderWhite').css('left',0);
              $('#loaderWhite').css('right',0);
              $('#loaderWhite').css('margin','auto');

              $.get(formatedUrl, function(data){
                  var lightboxData = $.trim(data);
                  lightboxImg = $(lightboxData).find('.imgLightbox');
                  lightboxComments= $(lightboxData).find('div#comments');

                  $(".imgLightbox").html(""); 
                  $(".imgLightbox").empty(); 
                  $(".imgLightbox").html(lightboxImg.html()); 
                  $('.imgLightbox').hide().fadeTo(1000, 1);
                  $('.imgLightbox').removeClass('col-md-9');

                  $('.originalImg').css('position','absolute');
                  $('.originalImg').css('top',0);
                  $('.originalImg').css('bottom',0);
                  $('.originalImg').css('left',0);
                  $('.originalImg').css('right',0);
                  $('.originalImg').css('margin','auto');

                  $('#disqus_thread').html("");
                  $('#disqus_thread').empty();
                  $("div#comments").html(""); 
                  $("div#comments").empty(); 
                  $("div#comments").html(lightboxComments.html()); 

                  // $('#loader').hide();
                });
            }

            function LoadModalContent(imgLinkTrigger, isAlbum, inAlbum){

                $('.modal-body').fadeTo(500, 0.5);
                $('#loader').clone().appendTo($('.modal-body'));
                $('#loader:last').show();
                $('#loader').css('position','absolute');
                $('#loader').css('top','50%');
                $('#loader').css('bottom',0);
                $('#loader').css('left','50%');
                $('#loader').css('right',0);
                $('#loader').css('margin','auto');

                $('.row').addClass('blur');   
                var imgUrl = imgLinkTrigger.attr("href");
                var formatedUrl = imgUrl.replace('media/view', 'lookFor_media');          
                // if(isHistoryAvailable){
                //   history.replaceState({key : $("title").text(), 'url' : imgUrl}, $("title").text(), imgUrl);
                // }

                if(!isAlbum){

                  $.get(formatedUrl, function(data){
                    var lightbox = $.trim(data);
                    lightbox = $(lightbox).find('#lightbox');

                    if(exists(inAlbum) && !inAlbum){
                      $(".modal-body").html("");
                      $(".modal-body").empty();
                      $(".modal-body").html(lightbox.html()); 
                    } else {
                      $(".modal-body").append(lightbox.html()); 
                    }
                    $('#disqus_thread').html("");
                    $('#disqus_thread').empty();
                    $('.modal-body').hide().fadeTo(1000, 1);

                    $('.modal-body').find('div.imgLightbox').removeClass('col-md-12');
                    $('.modal-body').find('div.imgLightbox').addClass('col-md-9');
                    $('.modal-body').find('div#comments').addClass('col-md-3');

                    $('.modal-body').find('div.imgLightbox').css('height', ($('.modal-body').height())+'px');
                    $('.originalImg').css('position','absolute');
                    $('.originalImg').css('top',0);
                    $('.originalImg').css('bottom',0);
                    $('.originalImg').css('left',0);
                    $('.originalImg').css('right',0);
                    $('.originalImg').css('margin','auto');

                    $('.modal-body').find('div#comments').css('height', ($('.modal-body').height())+'px');
                    // $('.modal-body').find('div#comments').css('overflow-y', 'scroll');
                    $('.modal-body').find('div#comments').niceScroll({
                      cursorwidth : '6px'
                    });
                    var niceScrollObjectId = $('.modal-body').find('div#comments').getNiceScroll();
                    niceScrollObjectId = niceScrollObjectId[0].id;
                    $("#"+niceScrollObjectId).css("background-color","rgba(0, 0, 0, 0.14902)");
                    $("#"+niceScrollObjectId).css("z-index","auto");
                    $("#"+niceScrollObjectId).css("cursor","pointer");
                    $("#"+niceScrollObjectId).css("width","3px");
                    $("#"+niceScrollObjectId).append(scrollToolsDiv);

                    var scroller = $("#"+niceScrollObjectId).find("div");
                    scroller.css('left', "1px");
                    var scrollerHr = $("#"+niceScrollObjectId+"-hr").find("div");
                    scrollerHr.css('left', "3px");

                    var margin = 0;
                    $('.modal-body').find("#down").click(function () {
                      margin +=250;
                      nice[0].doScrollTop(margin,500);
                    });
                    $('.modal-body').find("#up").click(function () {
                      if(margin != 0) {
                        margin -= 250;
                      }
                      nice[0].doScrollTop(margin,500);
                    });

                    $("div#"+niceScrollObjectId).css("top", "100px");
                    $("div.nicescroll-rails").css("top", "100px");

                    if(!$(curViewedImg).prev().length){
                      $('a#prevImg').hide();
                    } else if(!$(curViewedImg).next().length){
                      $(document).scrollTop($(document).height());
                      $('a#nextImg').hide();
                    }else{
                      $('a#prevImg').show();
                      $('a#nextImg').show();
                    }

                    // $('#loader').hide();
                  });
                } else {
                  console.log('ALBUM');
                  // console.log(albumsObject[imgUrl]);

                  $(".modal-body").html("");
                  $(".modal-body").empty();
                  $('#disqus_thread').html("");
                  $('#disqus_thread').empty();
                  $('.modal-body').hide().fadeTo(500, 1);

                  for($image in albumsObject[imgUrl]){
                      if($image != "insert" && $image != "peek" && $image != "nbImgs"){
                        // console.log($image);
                        // console.log(albumsObject[imgUrl][$image]);
                        $imageInfo = albumsObject[imgUrl][$image];

                        $('div.modal li:last').clone().appendTo('.modal-body');
                        $('.modal-body li:last').find('img').attr('src', $imageInfo.thumb);
                        $('.modal-body li:last').show();

                        $('.modal-body li:last').find('a').attr('href', $imageInfo.url);
                      }
                  }
                  $('.modal li:last').hide();
                }

                if($('.modal-content').width() != originModalWidth && !firstModal){
                  $('.modal-content').width(originModalWidth);
                  $('.modal-body').width(originModalWidth-2);
                }
            }

            $.ias({
                container : '.filelist',
                item: '.file',
                pagination: '.galerie .navigation',
                next: '.next-posts:last',
                loader: '<img src="<?php echo Router::url("css/img/loading.gif"); ?>"/>',
                history : false,
                triggerPageThreshold : 50,
                trigger : "Afficher plus de contenu.",
                noneleft : "Plus aucun contenu disponible.",
                onRenderComplete : function(items){
                  if($(curViewedImg).next().length){
                    $('a#nextImg').show();
                  }
                }
            });
        });

    </script> 

                    
<script>
  // this is important for IEs
  var polyfilter_scriptpath = "<?php echo Router::webroot('js/modal/'); ?>";
</script>
<?php echo HTML::JS("modal/cssParser"); ?>
<?php echo HTML::JS("modal/css-filters-polyfill"); ?>
<?php echo HTML::JS("jquery.fullscreen"); ?>
<?php //echo HTML::JS("tailorfit.min"); ?>
<?php echo HTML::JS("jquerypp.custom"); ?>
<?php echo HTML::JS("jquery.bookblock"); ?>
<script type="text/javascript">
  var Page = (function() {
    var $grid = $( '#bb-custom-grid' );

    return {
      init : function() {
        $( 'div.bb-bookblock' ).each( function( i ) {
          
          var $bookBlock = $( this ),
            $nav = $bookBlock.parents('li').find( 'nav.albumNav span' ),
            bb = $bookBlock.bookblock( {
              speed : 600,
              shadows : false
            } );
          // add navigation events
          $nav.each( function( i ) {
            $( this ).on( 'click touchstart', function( event ) {
              var $dot = $( this );
              $nav.removeClass( 'bb-current' );
              $dot.addClass( 'bb-current' );
              $bookBlock.bookblock( 'jump', i + 1 );
              return false;
            } );
          } );
          
          // add swipe events
          $bookBlock.children().on( {
            'swipeleft' : function( event ) {
              $bookBlock.bookblock( 'next' );
              return false;
            },
            'swiperight' : function( event ) {
              $bookBlock.bookblock( 'prev' );
              return false;
            }

          } );
          
        } );
      }
    };

  })();
</script>
<script>
    Page.init();
</script>

  

