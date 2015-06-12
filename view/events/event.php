<?php     
        $title_for_layout = "Evenements : ".$userEvent->titre;

        $id = $userEvent->id;
        // $slug = makeSlug($userEvent->titre);

        $date = new DateTime();

        echo "Commentaires <br/>";
        echo '<div class = "participer">participer</div>';
  ?>
<div id="nbParticipation"><?php echo $Participation; ?></div>
<div id="participer">
 <form id = "participate" action="<?php echo Router::url('lookFor/events/participate/'.$id); ?>" method="post">
  <?php 
    if(Cookies::CheckCookie('userData')) {
      $userData = Cookies::read('userData');
      $userData = Encrypt::DecryptData($userData,true);
    } else {
      $userData['nom'] = "";
      $userData['prenom'] = "";
      $userData['email'] = "";
      $userData['tel'] = "";
    }

    // $this->Form->required = true; 
    echo $this->Form->input('nom','nom', array('inputValue'=>$userData['nom']));
    echo $this->Form->input('prenom','prenom', array('inputValue'=>$userData['prenom']));
    echo $this->Form->input('email','email', array('type'=>'email','inputValue'=>$userData['email']));
    echo $this->Form->input('tel','Téléphone', array('inputValue'=>$userData['tel']));
    echo $this->Form->input('id_event','hidden', array('inputValue'=>$id)); 
   ?>
  <div class="actions">
    <input type="submit" class="btn primary" value="Envoyer">
  </div>
</form>
  <div id="reponse"></div>

</div>

<div id="informations">
  <div id="slider">

  <img src="<?php echo Router::webroot("img/slide1.jpg"); ?>">
  <img src="<?php echo Router::webroot("img/slide2.jpg"); ?>">
  <img src="<?php echo Router::webroot("img/slide3.jpg"); ?>">
  <img src="<?php echo Router::webroot("img/slide4.jpg"); ?>">
  </div>
  <div id="map-canvas"></div>
  <div id="location">
    <div id="lat">48.9407429</div>
    <div id="lng">2.3557019</div>
  </div>
<h1 class = "tittle"> <?php echo $userEvent->titre; ?> </h1>
   <h3> <?php echo $userEvent->auteur; ?> </h3>
   <h3> <?php
          $date->setTimestamp($userEvent->fromDate);
          echo $date->format('Y-m-d H:i') . "\n"; ?> </h3>
   <h3> <?php
          $date->setTimestamp($userEvent->toDate);
          echo $date->format('Y-m-d H:i') . "\n"; ?> </h3>
    <br>   
    <p>
    <?php echo $userEvent->description; ?>  
    </p>

</div>
<div id="commentaires">
  <?php
  // echo "e_$userEvent->id , $userEvent->titre";
    $comments = new Comments(array("id" => "e_$userEvent->id", "slug" =>$userEvent->titre, "url" => Router::webroot("events/event/$userEvent->id")));

  ?>
</div>


<!-- <a href="http://foo.com/bar.html#disqus_thread">Link</a> -->

<!-- <a href="http://example.com/article1.html#disqus_thread" data-disqus-identifier="article_1_identifier">First article</a> -->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=FR&libraries=geometry,weather"></script>
<script src="<?php echo Router::webroot("js/jquery.nivo.slider.js"); ?>" type="text/javascript"></script>

  <script type="text/javascript">
    jQuery(function($){

      //Title and history
      newPageTitle = "<?php echo $title_for_layout; ?>";
      $('title').text(newPageTitle);

      //participate
      $("#participer").hide();
      $('.participer').click(function(){
        $("#participer").toggle(500);
        return false; 
      });


      $('#participate').on('submit', function() {
         $.ajax({
            type: $(this).attr('method'),
            // dataType: 'json',
            // contentType: 'application/json',
            url: $(this).attr('action'),
            data: $(this).serialize(), 
            success: function(response) {
                  response = $.trim(response)
                  response = $.parseJSON(response);
                if(typeof response.confirm != "undefined" && typeof response.count != "undefined") {
                  // console.log(response.count);
                  // console.log(response.confirm);
                  $("#reponse").html(response.confirm);
                  $("#nbParticipation").html(response.count);
                } else {
                  $.each(response, function(name, value) {
                      $("#reponse").html($("#reponse").html() + "<br>" + value);
                  });
                }
            },
            error: function (xhr, status, error) {
              console.log(status, error); 
            }, 
            complete: function (xhr, status) {
             console.log(status); 
           }
        });

        return false;
      });
      
      //slider
      $('#slider').nivoSlider({        
        effect: 'fade',    
        // effect: 'sliceDown,sliceDownLeft,sliceUp,sliceUpLeft,sliceUpDown,sliceUpDownLeft,fold,fade,random,slideInRight,slideInLeft,boxRandom,boxRain,boxRainReverse,boxRainGrow,boxRainGrowReverse',    
        // effect: 'random',               // Specify sets like: 'fold,fade,sliceDown'
        slices: 30,                     // For slice animations
        boxCols: 8,                     // For box animations
        boxRows: 4,                     // For box animations
        animSpeed: 1500,                 // Slide transition speed
        pauseTime: 5000,                // How long each slide will show
        // startSlide: 0,                  // Set starting Slide (0 index)
        directionNav: false,             // Next & Prev navigation
        // controlNav: true,               // 1,2,3... navigation
        // controlNavThumbs: false,        // Use thumbnails for Control Nav
        pauseOnHover: true,             // Stop animation while hovering
        // manualAdvance: false,           // Force manual transitions
        // prevText: 'Prev',               // Prev directionNav text
        // nextText: 'Next',               // Next directionNav text
        randomStart: false,             // Start on a random slide
        // beforeChange: function(){},     // Triggers before a slide transition
        // afterChange: function(){},      // Triggers after a slide transition
        // slideshowEnd: function(){},     // Triggers after all slides have been shown
        // lastSlide: function(){},        // Triggers when last slide is shown
        // afterLoad: function(){}
      });

      //maps      
      var map
      google.maps.visualRefresh = true;
      var mapDiv = $("#map-canvas")[0];
      var markerLatLng = new google.maps.LatLng(48.9407429, 2.3557019);

      function initialize() {
        var mapOptions = {
          zoom: 14,
          center: markerLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          disableDefaultUI: true
        };
        map = new google.maps.Map(mapDiv,
            mapOptions);

        var marker = new google.maps.Marker({
          position: map.getCenter(),
          map: map,
          title: newPageTitle
        });
      }

      // google.maps.event.addDomListener(window, 'load', initialize);
      initialize();
    });
  </script>

    <style>
      #map-canvas {
        width : 300px;
        height: 300px;
        margin: 0px;
        padding: 0px
      }
    </style>