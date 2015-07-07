<?php $title_for_layout = "Galerie"; ?>
<?php echo HTML::CSS("component"); ?>
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

.file .photo, .albumImg .photoAlbum {
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
.file:hover .photo, .albumImg:hover .photoAlbum  {
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

.grayscale {
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

.grayscaleLeave {
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

.file{
  transition: margin-top 350ms ease; 
  -webkit-transition: margin-top 350ms ease;
}

.albumThumbnails a, img {
  display : inline;
}

</style>



<style>

  #sliderContainer{
    background : rgba(61,61,61,1); 
    height: 100px;
    width : 100%;
    position : absolute; 
    bottom : 0px; 
    left : 0px; 
  }

  #showSlider {
    width : 30px; 
    height : 30px; 
    background : red; 
    position : absolute; 
    top : -30px; 
    left : 50px;
    cursor : pointer;
  }

  .albumSlider {
    height: 100px;
    width : 100%;
    overflow: hidden;
  }

  .albumThumbnails {
    width : 100%;
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap;
  }

  .albumSliderControls {
    height : 100%;
    width : 50px;
    background: rgba(255,0,0,0.5);
    position: absolute;
    top: 0px;
    cursor : pointer;
  }

  #albumSliderLeft{
    left: 0px;
  }

  #albumSliderRight{
    right: 0px;
  }

  .imgBorder{
    border : 3px solid red;
  }
</style>

<style>
    #diapoControls{
    height : 31px;
    width : 100%;
    background : #232323;
    color : white;
    padding: none;
    margin: none;
    font-family: 'calibri';
    /*display : none;*/
  }

  #diapoControls button {
    text-decoration: none;
    margin : none;
    padding : 0 10px 0 0;
    height : 29px;
    border : none;
    border-right : white solid 1px;
    background : #232323;
    color : #FFF;
  }

  #diapoControls #nbSlide,#diapoCaption {
    display : inline-block;
    height : 31px;
    border : none;
    border-right : white solid 1px;
  }

  #diapoCaption {
    width : 100px;
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
  <li class="file grid cs-style-7 albumImg" style="top : 20px; z-index : 100; display : none;">
    <figure>                    
      <div class="imgTrigger">
        <a href="#" class="mdTrigger album" style="display : block;">
          <img src="#" class="photoAlbum" height="135px" width="180px" slug="#">
        </a> 
      </div>
      <figcaption class="imgCaption">
        <h3>#</h3>
        <span class = "author">#</span>
        <a href="#" class="mdTrigger hastip" title="">
          view 
        </a>
      </figcaption>
    </figure>
  </li><!-- /.empty grid li -->

</div><!-- /.modal -->

<div class="row">
  <div class="galerie col-md-12">
    <div class="galleryFilters"></div>
    <ul id="og-grid" class="og-grid filelist">   

          <?php 

            $zIndex = 100;
            $albumsArray = array();
            $playIcon = HTML::getImg("play.svg", true, false, 'style = "width : 70px; height : 70px; position : absolute; top : 48%; right : 0%" alt="A sample SVG button." onerror="this.removeAttribute(\'onerror\'); this.src=\'buttonA.png\'"');
            foreach ($images as $imgId => $image): 
              if($image->album == "" || $image->type == "album"):
                $img = "";
                $type = "";
                if($image->type == "album") {
                  $zIndex++;
                  if($image->album != "") {
                    echo '<li class="file album albumDiv grid cs-style-7 bb-custom-grid" style = "top : 20px; z-index : '.$zIndex.';"><div class = "expanderDiv" style = "display : inline; z-index : '.($zIndex).';">
                            <figure class = "feuilles">';
                    $albumImgs = explode(',', $image->album);
                    $tempAlbum = array();
                    foreach ($albumImgs as $imgKey => $albumImg) {
                      $jumpIteration = false;       
                      $albumImgInfo = pathinfo($albumImg);

                      $id = $image->id;

                      preg_match_all("/\[(.*?)\]/",$albumImg,$matches);
                      if(!empty($matches[0])) { 
                        $videoUrl = explode("+", $matches[1][0]);
                        $service = $videoUrl[1];
                        $videoId = $videoUrl[0];
                        $thumb = "";
                        if(count( $videoUrl) > 2)
                          $thumb = $videoUrl[2];
                        $slug = 'video!'.$image->user.'!'.$image->name.'!'.$service.'!'.$videoId;
                        $videoUrl = explode("!", $slug);              
                        $videoInfo = $this->GetVideoInfo($slug);
                        $albumVideoUrl = Router::url("medias/view/id:$id/slug:$slug");
                        $tempAlbum['url'] = $albumVideoUrl;

                        if(empty($thumb) || !file_exists("img/".$thumb)) {
                          $thumb = $videoInfo['imgInfo']->thumb; 
                          $tempAlbum['phpThumb'] = $thumb;
                          $tempAlbum['thumb'] = $thumb;
                        } else {
                          $tempAlbum['phpThumb'] = $thumb;
                          $thumb = Router::webroot("img/".$thumb);
                          $tempAlbum['thumb'] = $thumb;
                        }                      
                        $tempAlbum['videoInfoAll'] = $videoInfo;
                        $tempAlbum['videoInfo'] = $videoInfo['imgInfo'];
                        $tempAlbum['slug'] = $slug;
                        $tempAlbum['user'] = $image->user;
                        $tempAlbum['type'] = 'video';
                        $tempAlbum['eventType'] = $image->eventType;
                        $tempAlbum['date'] = $image->date;
                        // $videoData = array(
                        //                 "link" => $videoInfo['imgInfo']->link,
                        //                 "iframe" => $videoInfo['imgInfo']->iframe
                        //               );
                        // $videoData = json_encode($videoData);
                        // $tempAlbum['videoData'] = $videoData;
                        $tempAlbum['link'] = $videoInfo['imgInfo']->link;
                        $tempAlbum['iframe'] = $videoInfo['imgInfo']->iframe;
                        $tempAlbum['playIcon'] = Router::webroot("css/img/play.svg");
                        $dir = "tmp/Medias/Video/".$videoInfo['service']."/".$videoInfo['video'];
                        if (!file_exists($dir) || !is_dir($dir)) {
                          $jumpIteration = true;       
                        }                      

                      } else {
                        $imgExt = $albumImgInfo['extension'];
                        $minImg = str_replace(".".$imgExt, "", $albumImgInfo['basename']).'_150x100.'.$imgExt;
                        $albumImgThumb = str_replace($albumImgInfo['basename'], $minImg, $albumImg);
                        
                        $slug = $image->user.'!'.$image->name.'!'.$albumImgInfo['filename'];
                        $albumImgUrl = Router::url("medias/view/id:$id/slug:$slug");

                        $tempAlbum['origin'] = Router::webroot("img/".$albumImg);
                        $tempAlbum['dirname'] = $albumImgInfo['dirname'];
                        $tempAlbum['basename'] = $albumImgInfo['basename'];
                        $tempAlbum['extension'] = $albumImgInfo['extension'];
                        $tempAlbum['filename'] = $albumImgInfo['filename'];
                        $tempAlbum['url'] = $albumImgUrl;
                        $tempAlbum['thumb'] = Router::webroot("img/$albumImgThumb");
                        $tempAlbum['phpThumb'] = $albumImgThumb;
                        $tempAlbum['slug'] = $slug;
                        $tempAlbum['user'] = $image->user;
                        $tempAlbum['type'] = 'img';
                        $tempAlbum['eventType'] = $image->eventType;
                        $tempAlbum['date'] = $image->date;
                        // $tempAlbum['thumb'] = HTML::getImg($albumImgUrl, false, false, 'class = "photo" height="135px" width ="180px" slug = "'.$slug.'"', true);
                      }
                      if(!$jumpIteration)
                        $albumsArray[$image->name.'_'.$image->user][] = $tempAlbum;
                      else
                        continue;
                    } 
                    $nbImgs = count($albumImgs);
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
                } elseif($image->type == "img") {
                  // echo '<div class="file">';
                  echo '<li class="file grid cs-style-4">
                            <figure>';
                  $img = $image->file;
                  $type = "img"; 
                } elseif($image->type == "video") {
                  // echo '<div class="file">'; 
                  echo '<li class="file grid cs-style-4">
                            <figure>'; 
                  $img = explode(',', $image->name);
                  if(count($img) == 1){
                    $img = $img[0];
                    $thumb_notexist = true;  
                  } elseif(count($img > 1)) {
                    $thumb = $img[1];
                    $img = $img[0];
                    $thumb_notexist = false;  
                    if(!file_exists("img/".$thumb)){
                      $thumb_notexist = true; 
                    } 
                  }     
                  if($image->file=='youtube')
                  {
                    $iframe = 'http://www.youtube.com/embed/'.$img.'';
                    $link = "http://www.youtube.com/watch?v=$img";
                    if($thumb_notexist == true)
                    {
                      $thumb = 'http://img.youtube.com/vi/'.$img.'/2.jpg';
                    }
                  }
                  elseif($image->file=='vimeo')
                  {
                    $iframe = 'http://player.vimeo.com/video/'.$img.'?title=0&amp;byline=0&amp;portrait=0';
                    $link = "https://vimeo.com/$img";
                    if($thumb_notexist == true)
                    {
                      $ctx = stream_context_create(
                        array(
                          'http'=> array(
                                'timeout' => 5, // 1 200 Seconds = 20 Minutes
                            )
                        )
                      );
                      if(@file_get_contents("http://vimeo.com/api/v2/video/".$img.".php", false, $ctx)) {
                        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$img.".php"));
                        $thumb = $hash[0]["thumbnail_medium"];
                      } else {
                        $thumb = Router::webroot("css/img/noPic.png");
                      }
                    }
                  }
                  elseif($image->file=='dailymotion')
                  {
                    $iframe = 'http://www.dailymotion.com/embed/video/'.$img;
                    $link = "www.dailymotion.com/video/$img";
                    if($thumb_notexist == true)
                    {
                      $thumb = 'http://www.dailymotion.com/thumbnail/225x150/video/'.$img;
                    }
                  }
                  $type = "video"; 
                  $videoId = $img;
                  if($thumb_notexist)
                    $img = $thumb;
                  else
                    $img = Router::webroot('img/'.$thumb);
                  $videoData = array(
                                  "link" => $link,
                                  "iframe" => $iframe
                                );
                  $videoData = json_encode($videoData);
                }

                if($img != "nofile.png" || ($image->album != "" && $image->type == "album")){
                  $id = $image->id;
                  $originImg = $img;
                  $imgInfo = pathinfo($img);
                  $imgExt = (isset($imgInfo['extension']) ? $imgInfo['extension'] : '');
                  if($image->type != 'video') {
                    $minImg = str_replace(".".$imgExt, "", $imgInfo['basename']).'_150x100.'.$imgExt;
                    $minImgGray = "grayscale_".$minImg;
                    $imgGray = str_replace($imgInfo['basename'], $minImgGray, $img);
                    $img = str_replace($imgInfo['basename'], $minImg, $img);
                    $img = Router::webroot('img/'.$img);
                    $slug = $image->user.'!'.$imgInfo['filename'];
                  } else {
                    $minImg = $img;
                    $slug = 'video!'.$image->user.'!'.$image->file.'!'.$videoId;
                  }

                  $imgUrl = Router::url("medias/view/id:$id/slug:$slug");
                }

            ?>
                    <div class = "imgTrigger">
                      <?php if ($image->type == "album"): ?>
                      <div class="bb-bookblock">
                        <?php 
                          if(count($albumImgs) >= 5){
                            $randImgs = array();
                            for($i = 0; $i < 4; $i++){
                              $randImg = RandAlbumImgs($albumImgs, $randImgs);
                              array_push($randImgs, $randImg);  
                              $albumLiThumb = $albumsArray[$image->name.'_'.$image->user][$randImg]['phpThumb'];                     
                              if(!preg_match("#^http#", $albumLiThumb))
                                $albumLiThumb = Router::webroot('img/'.$albumLiThumb);
                          ?>
                          <div class="bb-item">
                            <!-- <a href = "<?php //echo $image->name.'_'.$image->user; ?>" class="gridTrigger" style = "display : block;"> -->
                            <a href = "#" class="gridTrigger" style = "display : block;">
                            <?php echo HTML::getImg('loading.gif', true, false, 'data-src="'.$albumLiThumb.'" class = "photo" slug = "'.$albumsArray[$image->name.'_'.$image->user][$randImg]['slug'].'"', true); ?>
                            </a>
                          </div>
                          <?php
                            }
                          } else {
                            debug(count($albumImgs));
                            for($i = 0; $i < count($albumImgs); $i++){
                              $albumLiThumb = $albumsArray[$image->name.'_'.$image->user][$i]['phpThumb'];                     
                              if(!preg_match("#^http#", $albumLiThumb))
                                $albumLiThumb = Router::webroot('img/'.$albumLiThumb);
                          ?>
                          <div class="bb-item">
                            <!-- <a href = "<?php //echo $image->name.'_'.$image->user; ?>" class="gridTrigger" style = "display : block;"> -->
                            <a href = "#" class="gridTrigger" style = "display : block;">
                              <?php echo HTML::getImg('loading.gif', true, false, 'data-src="'.$albumLiThumb.'" class = "photo" slug = "'.$slug.'"', true); ?>
                            </a>
                          </div>
                          <?php
                            }
                          }
                        ?>
                      </div>
                      <?php elseif($image->type == "video") : ?>
                      <a href = "<?php echo $imgUrl; ?>" class="mdTrigger video" style = "display : block;">
                        <!-- <span class="videoData" style = "display : none;"><?php //echo $videoData; ?></span> -->
                        <?php echo HTML::getImg('loading.gif', true, false, 'data-src="'.$img.'" class = "photo" slug = "'.$slug.'"', true); ?>
                        <!-- <div id="videoicon" >play</div> -->
                        <?php echo $playIcon; ?>
                      </a> 
                      <?php else : ?>
                      <a href = "<?php echo $imgUrl; ?>" class="mdTrigger" style = "display : block;">
                        <?php echo HTML::getImg('loading.gif', true, false, 'data-src="'.$img.'" class = "photo" slug = "'.$slug.'"', true); ?>
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
                      <span class = "author"><?php echo $image->user.'-'.$image->eventType; ?></span>
                      <?php if ($image->type != "album"): ?>
                        <a href = "<?php echo $imgUrl; ?>" class="gridTrigger hastip" title = "TEST de tootltipster"> view </a>
                      <?php else : ?>
                        <a href = "<?php echo $imgUrl; ?>" class="gridTrigger hastip" title = "TEST de tootltipster"> view </a>
                        <nav class="albumNav">
                          <span class="bb-current"></span>
                          <?php 
                            if(count($albumImgs) >= 5) {
                              for($i = 0; $i < 3; $i++){
                                echo '<span></span>';
                              }
                            } else {
                              for($i = 0; $i < (count($albumImgs)-1); $i++){
                                echo '<span></span>';
                              }
                            }
                          ?>
                        </nav>
                    <?php endif ?>
                    </figcaption>
                  </figure></a>
                <?php if ($image->type == "album"): ?>
                </div>
                <span id="albumObjInfo" style = "display : none;"> <?php echo json_encode($albumsArray[$image->name.'_'.$image->user]); ?> </span>
                <?php endif ?>
                <filter class = "user"><?php echo $image->user; ?></filter>
                <filter class = "club"><?php echo $image->user; ?></filter>
                <filter class = "type"><?php echo $image->eventType; ?></filter>
                <filter class =  "date filterSort"><?php echo $image->date; ?></filter>
                <filter class =  "comments filterSort"><?php echo $image->date; ?></filter>
              </li>

            <?php endif ?>
          <?php endforeach ?>

      <?php 
        $nextPage = $curPage+1;
        if ($nextPage <= $page && !$isAlbum): 
        ?> 
      <div class="navigation">
        <a class="next-posts" href="<?php echo Router::url('lookFor/medias/index?page='.$nextPage); ?>">Afficher Plus de contenu</a>
      </div> 
      <?php endif ?>
    </ul><!-- end filelist -->

    </div><!-- end galerie -->
  </div><!-- end col12 -->
</div><!-- end row -->

<span id="diaporamaDivs" style = "display : none;">
  <div id="diapoControls" class = "inactive" style = "display : none;">
    <button id = "start">&#9654;</button>
    <button id = "stop" style = "display : none;">&#8214;</button>
    <div id="nbSlide">1/..</div>
    <div id="diapoCaption">caption</div>
    <button id = "thumbNavDisplay">&#59231;</button>
    <!-- style="z-index : 1300;opacity: 100; position : absolute; left : 130px;" -->
    <select name="diapoFit" id="diapoFit">
      <option value="contain">contain</option>
      <option value="cover">cover</option>
      <option value="scaledown">scaledown</option>
      <option value="none">none</option>
    </select>
    <button class="close">X</button>
  </div>

  <div id="diaporamaControls">
    <a id = "albumDiapo" class = "albumDiapo">Diaporama</a>
    <button class = "displayDiapoSet" >Settings</button>
    <div id="diapoSettings" style = "display : none;">
      <input type="text" class = "diapoDuration" placeholder = "Duration, ex : 5 = 5 secondes">
      <button class="diapoSettings loopDiapo">Repeat</button>
      <button class="diapoSettings randomDiapo">Random</button>
      <button class="diapoSettings onlyImgDiapo">Only Img</button>
      <button class="diapoSettings onlyVideoDiapo">Only Vid</button>
    </div>
    <br>
  </div>
</span>

<?php echo HTML::JS("grid"); ?>
<?php echo HTML::JS("jquery.unveil.min"); ?>
<?php echo HTML::JS("fotorama.min"); ?>
<?php echo HTML::CSS("fotorama/fotorama"); ?>
    <script type="text/javascript">
    
        var curViewedAlbum, scrollToolsDiv = '<div class="scrollTools"><a href="#" id="up" class = "buttonUp"></a><a href="#" id="down" class = "buttonDown"></a></div>';  
        var sliderDisplayed = false, fotorama, fotoramaData = [], fotoramaDataImg = [], fotoramaDataVid = [];   
        var phpIsAlbum = "<?php echo ($isAlbum) ? 'true' : 'false'; ?>";
        phpIsAlbum = (phpIsAlbum === 'true');
        //var albumsObject = <?php //echo json_encode($albumsArray); ?>; 
        // console.log(albumsObject);

        $(document).ready(function() {

            $("li img").unveil(200, function(){
              $(this).load(function() {
                $(this).css('width', '180px').css('height', '135px');
              });
            });
            Grid.init();
            
            var urlOrigin = location.href;
            var viewportHeight, viewportWidth, modalWidth, modalHeight, modalLeft, divideLeft, originModalWidth = 0;
            var curViewedImg, fullscreen = false, firstModal = true;
            var $prevNone = false, $nextNone = false;
            var $albumThumbnails, $albumThumbs, $saveAlbumThumbnails, $saveAlbumThumbs;
            var fotoramaActive = false;
            // $('.modal-content').css('width', modalWidth+'px');
            // $('.modal-content').css('height', modalHeight+'px');
            // $('.modal-content').css('margin-left', '-'+modalLeft+'px');
            
            // $('img.imgLightbox').css('width', modalWidth);
            // $('img.imgLightbox').css('max-height', modalHeight);

            //hover effects
            $('li.grid').live('mouseenter', function(){ 
                if($(this).hasClass('album')){
                  $(this).find(":first-child").removeClass('feuilles');

                  var $navImgs; 
                  $(this).find('a.gridTrigger:first').find('img.photo:first').removeClass('grayscaleLeave').addClass('grayscale');
                  $(this).find("nav.albumNav").live('mouseenter', function(){
                    $navImgs = $(this).parents('li.grid').find('img.photo').attr('width', '180px').attr('height', '135px');
                    $navImgs.attr('style', '-webkit-filter : grayscale(0); -moz-filter : grayscale(0); -ms-filter : grayscale(0); -o-filter : grayscale(0); filter : grayscale(0)').removeClass('grayscale').addClass('grayscaleLeave');
                  }).live('mouseleave', function(){
                    $navImgs = $(this).parents('li.grid').find('img.photo')
                    $navImgs.removeAttr('style').removeClass('grayscale').addClass('grayscaleLeave');
                  }); 

                }                                        
            }).live('mouseleave', function(){
                if($(this).hasClass('album')){
                  $(this).find('a.gridTrigger:first').find('img.photo:first').removeClass('grayscale').addClass('grayscaleLeave');
                  if($(this).hasClass('albumDiv')){
                    $(this).find("figure:first").addClass('feuilles'); 
                  }
                }                    
            });

            //modal trigger
            $('a.mdTrigger, figcaption').live('click', function(event){

                var parentLi = $(this).closest('li');
                var isAlbum = $(this).closest('li').hasClass('albumDiv');
                if(isAlbum){
                  $(this).closest('li').find('a.gridTrigger').first().trigger('click');
                  return false;
                }

                if (document.compatMode === 'BackCompat') {
                    viewportHeight = document.body.clientHeight;
                    viewportWidth = document.body.clientWidth;
                } else {
                    viewportHeight = document.documentElement.clientHeight;
                    viewportWidth = document.documentElement.clientWidth;
                }            

                modalHeight = viewportHeight*0.9;
                modalWidth = viewportWidth*0.9;

                var imgLinkTrigger = $(this);
                if($(this).hasClass('imgCaption')){
                  imgLinkTrigger = $(this).parent().find('a.mdTrigger');
                }
                var inAlbum = imgLinkTrigger.hasClass('album');
                curViewedImg = $(this).closest('li');
                if(!curViewedImg.length && $(this).hasClass('inExpandedAlbum')){
                  // curViewedImg = curViewedAlbum;
                  // console.log($albumThumbs);
                  // console.log($($albumThumbs).find("a[href='"+imgLinkTrigger.attr("href")+"']").closest('li'));
                  curViewedImg = $($albumThumbs).find("a[href='"+imgLinkTrigger.attr("href")+"']").closest('li');
                }
                if(inAlbum && !curViewedImg.length){
                  albumThumbsLink = $(this).attr("href");
                  curViewedImg = $(this).parents("body").find("div.albumThumbs:first").find('a[href="'+albumThumbsLink+'"]').closest('li.albumImg');
                }

                $("#imgModal").modal();
                if((exists(inAlbum) && !inAlbum)){
                  curViewedAlbum = parentLi;
                  $(".modal-body").html("");
                  $(".modal-body").empty();
                } else {
                  $("div.imgLightbox").html("");
                  $("div.imgLightbox").empty();
                  $("div#comments").html("");
                  $("div#comments").empty();
                }
                $('#disqus_thread').html("");
                $('#disqus_thread').empty();

                $('.modal-content').css('height', (modalHeight-30)+'px');
                $('.modal-body').css('height', (modalHeight-150)+'px');

                if(!fullscreen){
                  LoadModalContent(imgLinkTrigger, inAlbum);
                } else{
                  LoadModalContentFull(imgLinkTrigger, inAlbum);
                }

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

                $inAlbum = $(this).find('div.modal-body').find('div.imgLightbox').hasClass('albumLightbox');
            });
            $(".modal-content").on( "resizestop", function() {
              $inAlbum = $(this).find('div.modal-body').find('div.imgLightbox').hasClass('albumLightbox');

              var $albumSliderWidth = $('.imgLightbox').find('.albumSlider').width();
              var $sliderReelWidth = $('.imgLightbox div.albumSlider').find('img').length * $('.imgLightbox div.albumSlider').find('img').width();
              if($albumSliderWidth < $sliderReelWidth){
                $('div#albumSliderRight').show();
              } else {
                $('div#albumSliderRight').hide();
              }

              if($('.fotorama').length){ 
                console.log($('.modal-body').height());
                console.log($('.modal-body').width());               
                fotorama.resize({
                    width : $('.modal-body').width(),
                    height : $('.modal-body').height()-100
                });
              }

            });

            //prev next
            $('a#prevImg, a#nextImg').live('click', function(){
              PrevNextImg($(this));
              return false;
            });

            //prev next keyboard
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

                    isVideo = $('.imgLightbox').hasClass('video');
                    if(isVideo){
                      $('iframe').attr('height', '100%').attr('width', '85%');
                      $('iframe').css('position','absolute');
                      $('iframe').css('top',0);
                      $('iframe').css('bottom',0);
                      $('iframe').css('left',0);
                      $('iframe').css('right',0);
                      $('iframe').css('margin','auto');
                      $('a.reelSize').hide();
                    }

                    if(!$('.albumSlider').hasScrollBar()){
                      $('div#albumSliderRight').hide();
                      $('div#albumSliderLeft').hide();
                    } else {
                      $('div#albumSliderRight').show();
                      if($('.albumThumbnails').scrollLeft() != 0){
                        $('div#albumSliderLeft').show();
                      }
                    }
                  } else{ 
                    $('.originalImg').removeAttr('style');
                    $('.imgLightbox').parent().removeClass('fullscreenDiv');
                    $('.imgLightbox').addClass('col-md-9');

                    $('#loader').removeAttr('style');
                    $('#loaderWhite').removeAttr('style');
                    $('#loader').hide();
                    $('#loaderWhite').hide();

                    if(!$('.imgLightbox').find('.albumSlider').hasScrollBar()){
                      $('div#albumSliderRight').hide();
                      $('div#albumSliderLeft').hide();
                    } else {
                      $('.imgLightbox').find('div#albumSliderRight').show();
                      if($('.albumThumbnails').scrollLeft() != 0){
                        $('div#albumSliderLeft').show();
                      }
                    }

                  }
                  var $albumSliderWidth = $('.imgLightbox').find('.albumSlider').width();
                  var $sliderReelWidth = $('.imgLightbox div.albumSlider').find('img').length * $('.imgLightbox div.albumSlider').find('img').width();
                  if($albumSliderWidth < $sliderReelWidth){
                    $('div#albumSliderRight').show();
                  } else {
                    $('div#albumSliderRight').hide();
                  }

                }
              });

            });

            //close
            $('#imgModal').live('hide.bs.modal', function () {                
                if(fotoramaActive){
                  $('.modal-body').css('background', '#FFF');
                  if(exists(fotorama)){
                    $('#diapoControlsInactive').attr('id', 'diapoControls');
                    fotorama.destroy();
                  }
                }

                $('.row').removeClass('blur');  
                sliderDisplayed = false;      
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

                $('body').animate({
                    scrollTop: (curViewedImg.offset().top - 80)
                });
            });

            function PrevNextImg(elem){
              if($(elem).attr('id') == "prevImg"){
                if($prevNone){
                  return false;
                }
                if(curViewedImg.prev().hasClass('albumDiv')){
                  curViewedImg = curViewedImg.prev();
                  PrevNextImg(elem);
                  return false;
                }
                prevInAlbum = curViewedImg.prev().hasClass('albumImg');
                if(!fullscreen){
                  LoadModalContent(curViewedImg.prev().find('a.mdTrigger'), prevInAlbum);
                } else{
                  LoadModalContentFull(curViewedImg.prev().find('a.mdTrigger'), prevInAlbum);
                }
                curViewedImg = curViewedImg.prev();
              } else if($(elem).attr('id') == "nextImg"){
                if($nextNone){
                  return false;
                }
                if(curViewedImg.next().hasClass('albumDiv')){
                  curViewedImg = curViewedImg.next();
                  PrevNextImg(elem);
                  return false;
                }
                nextInAlbum = curViewedImg.next().hasClass('albumImg');
                if(!fullscreen){
                  LoadModalContent(curViewedImg.next().find('a.mdTrigger'), nextInAlbum);
                } else{
                  LoadModalContentFull(curViewedImg.next().find('a.mdTrigger'), nextInAlbum);
                }
                curViewedImg = curViewedImg.next();
              }
            }

            function LoadModalContentFull(imgLinkTrigger, inAlbum){
              isVideo = imgLinkTrigger.hasClass('video');
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
                
                if(!exists($albumThumbnails)) {
                  if($( 'div.og-expander-inner' ).find('div.albumThumbnails').length){
                    $albumThumbnails = $( 'div.og-expander-inner' ).find('div.albumThumbnails').html();
                  } else if($('div.albumThumbnails').length){
                    $albumThumbnails = $('div.albumThumbnails').html();
                  } 
                }

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
                      
                if(exists(inAlbum) && inAlbum){
                  $('div.imgLightbox').after('<div class="albumThumbnails"></div>');
                  $('.modal-body').find('div.albumThumbnails').html($albumThumbnails);
                  $('div.modal-body').find('.albumThumbnails').wrap( '<div class="albumSlider"></div>' );
                  $('.modal-body').find("div.albumSlider").append('<div id = "albumSliderLeft" class = "albumSliderControls"></div>');
                  $('.modal-body').find("div.albumSlider").append('<div id = "albumSliderRight" class = "albumSliderControls"></div>'); 

                  $('.modal-body').find('div.imgLightbox').append($('.albumSlider'));
                  $('div.modal-body').find('.albumSlider').wrap( '<div id="sliderContainer"></div>' ); 
                  $('.modal-body').find('#sliderContainer').append('<div id="showSlider"></div>');
                  $('.modal-body').find('div.imgLightbox').addClass('albumLightbox');
                  if(!sliderDisplayed){
                    $("div#sliderContainer").css('height', '0px');
                    $("div.albumSlider").hide();
                  } 
                  var $albumSliderWidth = $('.imgLightbox').find('.albumSlider').width();
                  var $sliderReelWidth = $('.imgLightbox div.albumSlider').find('img').length * $('.imgLightbox div.albumSlider').find('img').width();
                  if($albumSliderWidth < $sliderReelWidth){
                    $('div#albumSliderRight').show();
                  } else {
                    $('div#albumSliderRight').hide();
                  }
                  
                  $('div.albumSlider a[href="'+imgUrl+'"]').find('img.photoAlbum').addClass('imgBorder');
                  $('div.albumSlider a[href="'+imgUrl+'"]').find('img.photoAlbum').addClass('imgBorder');

                  if(!$('#diaporamaControls').length){
                    var diaporamaControlsDiv = $('#diaporamaControls').html();
                    $('.modal-body').find('div#comments .user').prepend(diaporamaControlsDiv);

                    if(loopDiapo){
                      $('.modal-body').find('button.loopDiapo').css('color', 'red');
                    }
                    if(shuffleDiapo){
                      $('.modal-body').find('button.randomDiapo').css('color', 'red');
                    }
                    if(onlyImgDiapo){
                      $('.modal-body').find('button.onlyImgDiapo').css('color', 'red');
                    }
                    if(onlyVideoDiapo){
                      $('.modal-body').find('button.onlyVideoDiapo').css('color', 'red');
                    }
                    $(diaporamaControlsDiv).find('diapoDuration').val(diapoDuration/1000);
                  }
                }
                $('.prevButton, .nextButton').show();
                if(isVideo){
                  $('.imgLightbox').addClass('video');
                  $('iframe').attr('height', '100%').attr('width', '85%');
                  $('iframe').css('position','absolute');
                  $('iframe').css('top',0);
                  $('iframe').css('bottom',0);
                  $('iframe').css('left',0);
                  $('iframe').css('right',0);
                  $('iframe').css('margin','auto');
                  $('a.reelSize').hide();
                }

                  // $('#loader').hide();
                $prevNone = false, $nextNone = false;
                if(!$(curViewedImg).prev().length){
                  $('a#prevImg').hide();
                  $prevNone = true;
                } else if(!$(curViewedImg).next().length){
                  $(document).scrollTop($(document).height());
                  $('a#nextImg').hide();
                  $nextNone = true;
                }else{
                  $('a#prevImg').show();
                  $('a#nextImg').show();
                }
              });
            }

            function LoadModalContent(imgLinkTrigger, inAlbum){
                
                isVideo = imgLinkTrigger.hasClass('video');

                $('.modal-body').fadeTo(500, 0.5);
                if($('.modal-body').find('#loader').length){
                  $('.modal-body').find('#loader').remove();
                }
                $('#loader').clone().appendTo($('.modal-body'));
                $('.modal-body').find('#loader:last').show();
                $('.modal-body').find('#loader:last').css('position','absolute');
                $('.modal-body').find('#loader:last').css('top','50%');
                $('.modal-body').find('#loader:last').css('bottom',0);
                $('.modal-body').find('#loader:last').css('left','50%');
                $('.modal-body').find('#loader:last').css('right',0);
                $('.modal-body').find('#loader:last').css('margin','auto');

                $('.row').addClass('blur');   
                var imgUrl = imgLinkTrigger.attr("href");
                var formatedUrl = imgUrl.replace('media/view', 'lookFor_media');  
                // if(isHistoryAvailable){
                //   history.replaceState({key : $("title").text(), 'url' : imgUrl}, $("title").text(), imgUrl);
                // }
                
                $.get(formatedUrl, function(data){
                  var lightbox = $.trim(data);
                  lightbox = $(lightbox).find('#lightbox');

                  if(!exists(inAlbum) || (exists(inAlbum) && !inAlbum) ){
                    $(".modal-body").html("");
                    $(".modal-body").empty();
                    $(".modal-body").html(lightbox.html()); 
                  } else {
                    $("div.imgLightbox").html("");
                    $("div.imgLightbox").empty();
                    $("div.imgLightbox").remove();
                    $("div#comments").html("");
                    $("div#comments").empty();
                    $("div#comments").remove();
                    if($('.albumThumbnails').find('div.albumSlider').length){
                      $('.modal-body').find("div.albumThumbnails").html("");
                      $('.modal-body').find("div.albumThumbnails").empty();
                      $('.modal-body').find("div.albumThumbnails").remove();
                    }
                    $(".modal-body").append(lightbox.html()); 
                  }
                  $('#disqus_thread').html("");
                  $('#disqus_thread').empty();
                  $('.modal-body').hide().fadeTo(1000, 1);


                  $('.modal-body').find('div.imgLightbox').removeClass('col-md-12');
                  $('.modal-body').find('div.imgLightbox').addClass('col-md-9');
                  $('.modal-body').find('div#comments').addClass('col-md-3'); 
                  
                  if(exists(inAlbum) && inAlbum){
                    $albumThumbnails = $( 'div.og-expander-inner' ).find('div.albumThumbnails').html();
                    $albumThumbs = $( 'div.og-expander-inner' ).find('div.albumThumbs').html();
                    if(!exists($albumThumbnails) || !$albumThumbnails.length){                  
                      $albumThumbnails = $saveAlbumThumbnails;
                      $albumThumbs = $saveAlbumThumbs;
                    } else {
                      $saveAlbumThumbnails = $albumThumbnails;
                      $saveAlbumThumbs = $albumThumbs;
                    }
                    $('div.imgLightbox').after('<div class="albumThumbnails"></div>');
                    $('.modal-body').find('div.albumThumbnails').html($albumThumbnails);
                    $('div.modal-body').find('.albumThumbnails').wrap( '<div class="albumSlider"></div>' );
                    $('.modal-body').find("div.albumSlider").append('<div id = "albumSliderLeft" class = "albumSliderControls"></div>');
                    $('.modal-body').find("div.albumSlider").append('<div id = "albumSliderRight" class = "albumSliderControls"></div>'); 
                    $('div#albumSliderLeft').hide();

                    $('.modal-body').find('div.imgLightbox').append($('.albumSlider'));
                    $('div.modal-body').find('.albumSlider').wrap( '<div id="sliderContainer"></div>' ); 
                    $('.modal-body').find('#sliderContainer').append('<div id="showSlider">/\\</div>');
                    $('.modal-body').find('div.imgLightbox').addClass('albumLightbox');
                    if(!sliderDisplayed){
                      $("div#sliderContainer").css('height', '0px');
                      $("div.albumSlider").hide();
                    } else {
                      $('div#showSlider').text("\\/");
                    }
                    var $albumSliderWidth = $('.imgLightbox').find('.albumSlider').width();
                    var $sliderReelWidth = $('.imgLightbox div.albumSlider').find('img').length * $('.imgLightbox div.albumSlider').find('img').width();
                    if($albumSliderWidth < $sliderReelWidth){
                      $('div#albumSliderRight').show();
                    } else {
                      $('div#albumSliderRight').hide();
                    }

                    $('div.albumSlider a[href="'+imgUrl+'"]').find('img.photoAlbum').addClass('imgBorder');
                    $('.modal-body').find('div.albumThumbnails').animate({
                      scrollLeft: ($('div.albumSlider a[href="'+imgUrl+'"]').find('img.photoAlbum').offset().left-150)
                    });

                    var diaporamaControlsDiv = $('#diaporamaControls').html();
                    $('.modal-body').find('div#comments .user').prepend(diaporamaControlsDiv);

                    if(loopDiapo){
                      $('.modal-body').find('button.loopDiapo').css('color', 'red');
                    }
                    if(shuffleDiapo){
                      $('.modal-body').find('button.randomDiapo').css('color', 'red');
                    }
                    if(onlyImgDiapo){
                      $('.modal-body').find('button.onlyImgDiapo').css('color', 'red');
                    }
                    if(onlyVideoDiapo){
                      $('.modal-body').find('button.onlyVideoDiapo').css('color', 'red');
                    }
                    $(diaporamaControlsDiv).find('diapoDuration').val(diapoDuration/1000);


                  } 
                  $('.prevButton, .nextButton').show();
                  if(isVideo){
                    $('.imgLightbox').addClass('video');
                    $('iframe').attr('height', '100%').attr('width', '85%');
                    $('a.reelSize').hide();
                  }

                  $('.modal-body').find('div.imgLightbox').css('height', ($('.modal-body').height())+'px');
                  $('.originalImg').css('position','absolute');
                  $('.originalImg').css('top',0);
                  $('.originalImg').css('bottom',0);
                  $('.originalImg').css('left',0);
                  $('.originalImg').css('right',0);
                  $('.originalImg').css('margin','auto');

                  $('.modal-body').find('div#comments').css('height', ($('.modal-body').height())+'px');
                  $('.modal-body').find('div#comments').css('overflow-y', 'scroll');
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
                    nice[0].doScrollTop(margin,150);
                  });
                  $('.modal-body').find("#up").click(function () {
                    if(margin != 0) {
                      margin -= 250;
                    }
                    nice[0].doScrollTop(margin,150);
                  });

                  $("div#"+niceScrollObjectId).css("top", "100px");
                  $("div.nicescroll-rails").css("top", "100px");

                  $prevNone = false, $nextNone = false;
                  if(!$(curViewedImg).prev('li.grid').length){
                    $('a#prevImg').hide();
                    $prevNone = true;
                  } else if(!$(curViewedImg).next('li.grid').length){
                    $(document).scrollTop($(document).height());
                    $('a#nextImg').hide();
                    $nextNone = true;
                  }else{
                    $('a#prevImg').show();
                    $('a#nextImg').show();
                  }

                  // $('.modal-body').find('#loader:last').hide();
                });

                if($('.modal-content').width() != originModalWidth && !firstModal){
                  //reinitialise window width everytime a new content is loaded or changed
                  // $('.modal-content').width(originModalWidth);
                  // $('.modal-body').width(originModalWidth-2);
                }
            }

            //show/hide slider event
            $("div#showSlider").live('click', function(){
              if(!sliderDisplayed){            
                $("div.albumSlider").show('slide', { direction: 'down' }, 400);
                $("div#sliderContainer").animate({
                  height: "100px"
                }, 500);
                $('div#showSlider').text("\\/");
                $('div#albumSliderLeft').hide();

                var $albumSliderWidth = $('.imgLightbox').find('.albumSlider').width();
                var $sliderReelWidth = $('.imgLightbox div.albumSlider').find('img').length * $('.imgLightbox div.albumSlider').find('img').width();
                if($albumSliderWidth < $sliderReelWidth){
                  $('div#albumSliderRight').show();
                } else {
                  $('div#albumSliderRight').hide();
                }
                sliderDisplayed = true;  
              } else {      
                $("div#sliderContainer").animate({
                  height: "0px"
                }, 500);
                $("div.albumSlider").hide('slide', { direction: 'down' }, 400);
                $('div#showSlider').text("/\\");
                sliderDisplayed = false;  
              }
              return false;
            });

            //album slider controls
            $('.albumSliderControls').live('mouseenter', function(){
              $scrollAmount = 60;
              $lastScrollLeft = 0;
              $sameScrollTime = 0;
              if($(this).attr('id') == "albumSliderLeft") {
                $scrollAmount *= -1;
              }  
              this.iid = setInterval(function() {
                $('.albumThumbnails').animate({
                    scrollLeft: ($('.albumThumbnails').scrollLeft() + $scrollAmount)
                }, 95);
                if($('.albumThumbnails').scrollLeft() == 0){ 
                  $('div#albumSliderLeft').hide();
                  $('div#albumSliderRight').show(); 
                } else {
                  $('div#albumSliderLeft').show(); 
                  $('div#albumSliderRight').show(); 
                }   

                if($lastScrollLeft == $('.albumThumbnails').scrollLeft() + $scrollAmount){
                  $sameScrollTime += 1;
                  if($sameScrollTime >= 2){
                    $('div#albumSliderRight').hide();
                  }
                }
                $lastScrollLeft = $('.albumThumbnails').scrollLeft() + $scrollAmount;

              }, 100);
            }).live('mouseleave', function(){
              this.iid && clearInterval(this.iid);
            });

            //slideshow functions
            var fotoramaActive = true, loadControls = true, restartDiapo = false, closeFotorama = false, loopDiapo = false, shuffleDiapo = false, onlyVideoDiapo = false, onlyImgDiapo = false, diapoDuration = 5000, fotoramaFullS = false;
              
            $('button.displayDiapoSet').live('click', function(){
              $('#diapoSettings').toggle(500);
            });     
            $('button.diapoSettings').live('click', function(){
              diapoSetting = $(this).attr('class').split(" ")[1];
              if(diapoSetting == "loopDiapo") {
                loopDiapo = !loopDiapo;
              } else if(diapoSetting == "randomDiapo"){
                shuffleDiapo = !shuffleDiapo;
              }else if(diapoSetting == "onlyImgDiapo"){
                onlyImgDiapo = !onlyImgDiapo;                
                onlyVideoDiapo = false;
              }else if(diapoSetting == "onlyVideoDiapo"){
                onlyVideoDiapo = !onlyVideoDiapo;
                onlyImgDiapo = false;
              }

              if(rgb2hex($(this).css('color')) == '#ff0000') {
                $(this).css('color', 'black');
              } else {
                $(this).css('color', 'red');
              }
            });            

            $('.albumDiapo').live('click', function(){

              var diapoDuration = $('.diapoDuration').val()
              diapoDuration = diapoDuration.replace(/\D/g, '');
              if(diapoDuration > 0 && diapoDuration < 30) {
                diapoDuration = parseInt(diapoDuration)*1000;
              } else if(diapoDuration > 0 && diapoDuration > 30) {
                diapoDuration = 30000;
              } else {
                diapoDuration = 5000;
              }

              //find start img
              var diapoImg = $('.modal-body').find('a.slugUrl').attr('href').replace(location.origin, '');
              diapoImg = $('.modal-body').find('.albumThumbnails').find('a[href="'+diapoImg+'"]');

              var diapoImgIndex = diapoImg.attr('data-index');
              console.log(diapoImgIndex);

              //init
              $('.modal-body').height($('.modal-body').height()+101);

              usedFotoramadata = fotoramaData;

              if(onlyImgDiapo) {
                usedFotoramadata = fotoramaDataImg;
              }
              if(onlyVideoDiapo) {
                usedFotoramadata = fotoramaDataVid;
              }

              if(shuffleDiapo) {
                usedFotoramadata = shuffleArray(usedFotoramadata);
              }

              var $diapo = $('.modal-body').fotorama({
                                            nav: 'thumbs',
                                            allowfullscreen : 'native',
                                            shuffle : true,
                                            fit : 'contain',
                                            keyboard : true,
                                            width : $('.modal-body').width(),
                                            height : $('.modal-body').height()-30,
                                          });
              fotorama = $diapo.data('fotorama');
              fotorama.load(usedFotoramadata);
              if(loopDiapo){                
                  fotorama.setOptions({
                    loop : true
                  });
              }
              fotorama.show(diapoImgIndex);
              fotorama.startAutoplay(diapoDuration);

              $('.modal-body').css('background', '#232323');
              $('#diapoControls:last').clone().prependTo($('.modal-body')).show().removeAttr('class');
              $('#diapoControls.inactive').attr('id', 'diapoControlsInactive');
              $('#diapoControls #stop').show();
              $('#diapoControls #start').hide();
              $('.fotorama__caption').hide();
              $('.fotorama__nav-wrap').hide();
              $('.modal-header').hide();
              $('.modal-footer').hide();

              //buttons
              $('#diapoControls #start').on('click', function () {
                $(this).hide();
                $('#diapoControls #stop').show();
                fotorama.startAutoplay(diapoDuration);
              });
              $('#diapoControls #stop').on('click', function () {
                fotorama.stopAutoplay();
                $(this).hide();
                $('#diapoControls #start').show();
              });
              $('#diapoControls #diapoFit').on('change', function(){
                if(typeof fotorama != "undefined"){
                  fotorama.setOptions({
                    fit : $(this).val()
                  });
                }
              });
              $('#diapoControls #thumbNavDisplay').on('click', function () {
                $('.fotorama__nav-wrap').toggle();  
                $diapoThumbSpace = -30;
                if($('.fotorama__nav-wrap').is(':visible')) {
                  $diapoThumbSpace = -100;
                }            
                fotorama.resize({
                    width : $('.modal-body').width(),
                    height : $('.modal-body').height()+$diapoThumbSpace
                });   
              });
              $('#diapoControls .close').on('click', function () {
                CloseFotorama();
              });
              $('.fotorama__stage__frame').on('click', function () {
                fotorama.startAutoplay(diapoDuration);
              });

              $('.fotorama__nav__frame').on('click', function(){
                fotorama.startAutoplay(diapoDuration);
              })

              //events
              $('.fotorama').on('fotorama:load ', function(){
                if(loadControls){
                  $(".fotorama__nav").append('<div id = "albumSliderLeft" class = "albumSliderControls"></div>');
                  $(".fotorama__nav").append('<div id = "albumSliderRight" class = "albumSliderControls"></div>'); 
                  loadControls = false;
                }
                $('#nbSlide').text((fotorama.activeIndex + 1) + '/' + fotorama.size);
                if(typeof fotorama.activeFrame.caption != "undefined") {
                  $('#diapoCaption').show();
                  $('#diapoCaption').html(fotorama.activeFrame.caption);
                } else {
                  $('#diapoCaption').hide();
                }
              });

              $('.fotorama').on('fotorama:show ', function(){
                $('.fotorama__caption').hide();
                if(typeof fotorama.activeFrame.video != "undefined"){
                  fotorama.stopAutoplay();
                  fotorama.playVideo();
                }
                if(typeof fotorama.activeFrame.caption != "undefined") {
                  $('#diapoCaption').show();
                  $('#diapoCaption').html(fotorama.activeFrame.caption);
                } else {
                  $('#diapoCaption').hide();
                }

                if(restartDiapo){
                  fotorama.startAutoplay(diapoDuration);
                  restartDiapo = false;
                }
                $('#nbSlide').text((fotorama.activeIndex + 1) + '/' + fotorama.size);
              });

              $('.fotorama').on('fotorama:showend', function (e, fotorama) {
                if (fotorama.size - fotorama.activeIndex === 1) {     
                  closeFotorama = true;
                } else if(fotorama.size - fotorama.activeIndex === fotorama.size && closeFotorama){
                  closeFotorama = false;
                  if(!loopDiapo) {
                    CloseFotorama();
                  }
                }
              });

              $('.fotorama').on('fotorama:unloadvideo ', function(){
                restartDiapo = true;
                if (fotorama.size - fotorama.activeIndex === 1) {
                  if(!loopDiapo){
                    CloseFotorama();
                  } else {
                    fotorama.show({
                      index: 0, // The second frame.
                      // time: 500 // Half-second transition.
                    });
                  }
                } else {
                  fotorama.show(fotorama.activeIndex + 1);
                }
              });

              $('.fotorama').on('fotorama:fullscreenenter', function(){
                fotoramaFullS = true;
              });
              $('.fotorama').on('fotorama:fullscreenexit', function(){
                fotoramaFullS = false;
              });

              function CloseFotorama() {
                diapoIndexChanged = false;
                if(diapoImgIndex != fotorama.activeIndex) {
                  diapoImgIndex = fotorama.activeIndex;
                  diapoImg = $('.modal-body').find('.albumThumbnails a[data-index="'+diapoImgIndex+'"]');
                  diapoIndexChanged = true;
                }

                //compare if the image displayed in fotorama is tha same as the one displayed in the modal window
                //if not, update modal
                //
                //check if fotorama is in full screen mode, if true, exit fullscreen
                //recalculate modal dimensions (using the same function as when opening the modal) 
                //and resize the modal to normal size

                fotorama.destroy();
                $('#diapoControlsInactive').attr('id', 'diapoControls');
                $('.modal-body').css('background', '#FFF');  
                $('.modal-body').height($('.modal-body').height()-101);              
                $('.modal-header').show();
                $('.modal-footer').show();
                if(diapoIndexChanged) {
                  diapoImg = $('.modal-body').find('.albumThumbnails a[data-index="'+diapoImgIndex+'"]');
                  diapoImg.trigger('click');
                }

              }

            });

            function filterCallbackFunction(){
              $('span.og-close:last').trigger('click');
            }

            //Filter function
            $(".filelist li").DataFilter({
              div : true,
              appendTo : $('div.galleryFilters'),
              callbackEvent : ['click', 'keyup'],
              callback : [function(){
                filterCallbackFunction();
              }, function(){
                filterCallbackFunction();
              }]
            });

            //infinite ajax scroll loader
            if(!phpIsAlbum){
              $.ias({
                  container : '.filelist',
                  item: '.file',
                  pagination: '.galerie .navigation',
                  next: '.next-posts:last',
                  loader: '<img src="<?php echo Router::url("css/img/loading.gif"); ?>"/>',
                  history : false,
                  triggerPageThreshold : 10,
                  trigger : "Afficher plus de contenu.",
                  noneleft : '<div class= "iasNoContent">Plus aucun contenu disponible.</div',
                  onRenderComplete : function(items){
                    if($(curViewedImg).next().length){
                      $('a#nextImg').show();
                      $nextNone = true;
                    }

                    $("li img").unveil(200, function(){
                      $(this).load(function() {
                        $(this).css('width', '180px').css('height', '135px');
                      });
                    });

                    Page.init();
                    Grid.addItems($('li.albumDiv'));

                    var hideGridPreview = false;

                    $('filter').hide();
                    $('filterInput').hide();

                    $(".filelist li").DataFilter({
                      div : true,
                      appendTo : $('div.galleryFilters'),
                      callbackEvent : ['click', 'keyup'],
                      reAddText : true,
                      callback : [function(){
                        if(hideGridPreview){
                          filterCallbackFunction();
                        }
                      }, function(){
                        if(hideGridPreview){
                          filterCallbackFunction();
                        }
                      }]
                    });                 

                    var filterContainer = $(".filterDiv:last").show();
                    $(".filterDiv").hide();
                    $('div.galleryFilters').prepend(filterContainer);
                    $(".filterDiv:last").show();
                    hideGridPreview = true;
                  }
              });
            }

        });

    </script> 
         
<script>
  // this is important for IEs
  var polyfilter_scriptpath = "<?php echo Router::webroot('js/modal/'); ?>";
</script>
<?php echo HTML::JS("modal/cssParser"); ?>
<?php echo HTML::JS("modal/css-filters-polyfill"); ?>
<?php echo HTML::JS("jquery.fullscreen"); ?>

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

    Page.init();
  })();
</script>
<script>
</script>

  

