<?php $title_for_layout = "Galerie"; ?>

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
.modal-wide .modal-body {
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

.feuilles{
  /*height:500px;*/
  /*background:#FFF;*/
  box-shadow:
  0 1px 1px rgba(0,0,0,0.40), /* Le premier shadow */
    0 10px 0 -5px #F7F7F7, /* La seconde feuille */
    0 11px 1px -5px rgba(0,0,0,0.40), /* Le second shadow */
      0 22px 0 -12px #F7F7F7, /*La troisieme feuille */
      0 23px 1px -12px rgba(0,0,0,0.40); /* Le trosieme shadow */
      
-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.40), 0 10px 0 -5px #F7F7F7, 0 11px 1px -5px rgba(0,0,0,0.40), 0 22px 0 -12px #F7F7F7, 0 23px 1px -12px rgba(0,0,0,0.40);

-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.40), 0 10px 0 -5px #F7F7F7, 0 11px 1px -5px rgba(0,0,0,0.40), 0 22px 0 -12px #F7F7F7, 0 23px 1px -12px rgba(0,0,0,0.40);  
}
</style>

    <!-- <div class="md-content" style = "overflow-y : scroll;"> -->
      <!-- <h3><button class="md-close" style="font-size: 1.5em;">x</button> Galerie </h3> -->
        
<!-- Modal -->
<div class="modal modal-wide fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div><!-- /.modal -->

<div class="row">
  <div class="col-md-12">

  <ul class="grid cs-style-4">
        <li>
          <figure>
            <div><img src="<?php echo Router::webroot("images/5.png"); ?>" alt="img05"></div>
            <figcaption>
              <h3>Safari</h3>
              <span>Jacob Cummings</span>
              <a href="http://dribbble.com/shots/1116775-Safari">Take a look</a>
            </figcaption>
          </figure>
        </li>
      </ul>

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
                    echo '<div class="file albumDiv feuilles">';
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
                  $id = $image->id;
                  $imgInfo = pathinfo($img);
                  $imgExt = $imgInfo['extension'];
                  $minImg = str_replace(".".$imgExt, "", $imgInfo['basename']).'_150x100.'.$imgExt;
                  $minImgGray = "grayscale_".$minImg;
                  $imgGray = str_replace($imgInfo['basename'], $minImgGray, $img);
                  $img = str_replace($imgInfo['basename'], $minImg, $img);
                  
                  $slug = $image->user.'!'.$imgInfo['filename'];
                  $imgUrl = Router::url("medias/view/id:$id/slug:$slug");
                  // $imgUrl = Router::url("lookFor/medias/view/id:$id/slug:$slug");
                }

            ?>
                  <a href = "<?php echo $imgUrl; ?>" class="photo mdTrigger" style = "display : block;">
                    <?php echo HTML::getImg($img, false, false, 'height="100" width ="150px" slug = "'.$slug.'"', true); ?>
                  </a> 
      						<div class="actions">
                    <!-- Image/Album name -->
                     <div class="imgName"> 
                        <?php echo $image->id; ?>
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
            var urlOrigin = location.href;
            var viewportHeight;
            var viewportWidth;
            if (document.compatMode === 'BackCompat') {
                viewportHeight = document.body.clientHeight;
                viewportWidth = document.body.clientWidth;
            } else {
                viewportHeight = document.documentElement.clientHeight;
                viewportWidth = document.documentElement.clientWidth;
            }            

            var modalHeight = viewportHeight*0.9;
            var modalWidth = $(document).width()*0.9;
            var divideLeft = (viewportWidth - viewportHeight)/10;
            divideLeft = ((1920/viewportWidth)*-3);
            var modalLeft = (modalWidth/divideLeft) * -1;
            // $('.modal-content').css('width', modalWidth+'px');
            // $('.modal-content').css('height', modalHeight+'px');
            // $('.modal-content').css('margin-left', '-'+modalLeft+'px');
            
            // $('img.imgLightbox').css('width', modalWidth);
            // $('img.imgLightbox').css('max-height', modalHeight);

           $('button.mdTrigger').find('img').live('hover', function(){
                $(this).addClass('grayscale');             
            }).live('mouseout', function(){
                $(this).removeClass('grayscale');             
            });

            $('a.mdTrigger').on('click', function(){  
                // $('.modal-body').css('height', modalHeight+'px');
                $('.row').addClass('blur');   
                var imgUrl = $(this).attr("href");
                var formatedUrl = imgUrl.replace('media/view', 'lookFor_media');          
                if(isHistoryAvailable){
                  history.replaceState({key : $("title").text(), 'url' : imgUrl}, $("title").text(), imgUrl);
                }
                $.get(formatedUrl, function(data){
                  var lightbox = $.trim(data);
                  lightbox = $(lightbox).find('#lightbox');
                  $(".modal-body").append(lightbox.html());
                });

                $("#imgModal").modal();

                return false;
            });

            $('.imgLightbox').find('img').live('click', function(){
              console.log("CLICK");
              $('.imgLightbox').fullScreen();

              $('imgLightbox').css('width', viewportWidth);
              $('imgLightbox').css('height', viewportHeight);
            })

            $('#imgModal').on('hide.bs.modal', function () {
                $('.row').removeClass('blur');        
                if(isHistoryAvailable){
                  history.replaceState({key : $("title").text(), 'url' : urlOrigin}, $("title").text(), urlOrigin);
                }
                $(".modal-body").html("");
                $(".modal-body").empty();
                $('#disqus_thread').html("");
                $('#disqus_thread').empty();
            })

            $.ias({
                container : '.galerie',
                item: '#filelist',
                pagination: '#filelist .navigation',
                next: '.next-posts:last',
                loader: '<img src="<?php echo Router::url("css/img/loading.gif"); ?>"/>',
                history : false,
                triggerPageThreshold : 100
            });
        });
    </script> 

<script>
  // this is important for IEs
  var polyfilter_scriptpath = "<?php echo Router::webroot('js/modal/'); ?>";
</script>
<?php //echo HTML::JS("modal/classie"); ?>
<?php //echo HTML::JS("modal/modalEffects"); ?>
<?php echo HTML::JS("modal/cssParser"); ?>
<?php echo HTML::JS("modal/css-filters-polyfill"); ?>
<?php echo HTML::JS("jquery.fullscreen"); ?>

  

