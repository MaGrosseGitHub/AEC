<?php $title_for_layout = "Evenements"; ?>
  <div class="md-modal md-effect-1" id="modal-1">
    <div class="md-content" style = "
  overflow : scroll; 
  height: 500px;">
      <h3>Evenement</h3>
      <div>
        <div id="descEvent"></div>
        <button class="md-close">Close me!</button>
      </div>
    </div>
  </div>

  <div class="md-overlay"></div>
  <div class="md-history" style = "display : none"></div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=FR&libraries=geometry,weather"></script>

<div class="row-fluid">
  <div class="col-md-12">

    <div class="page-header">
      <h1><?php echo isset($title)?$title:'Events'; ?></h1>
    </div>

              <button class="back">All</button>
<div class="periods all" id = "periods">
              <button class="select prevYear">Previous</button>
              <button class="select nextYear">Next</button>
              <!-- <button class="filtre aviation checked">aviation</button>
              <button class="filtre parapente checked">parapente</button>
              <button class="filtre parachute checked">parachute</button> -->

<div class = "testFiltre">Lorem ipsum Enim enim exercitation occaecat laboris sint exercitation eiusmod in mollit ut voluptate non in cupidatat adipisicing in ut deserunt sit in nulla incididunt minim Duis sunt quis adipisicing sunt.</div>

              <br>
            <?php foreach ($this->years as $yearKey=>$curYear): ?>
              <div id = "months" class="months <?php echo $curYear; ?>">
                <div><?php echo $curYear; ?></div>
                <!-- <div class="year"><?php echo $curYear; ?></div> -->
                <br>
                <span id="monthsFor<?php echo $curYear; ?>">
                    <ul>
                        <?php foreach ($this->months as $id=>$m):?>
                          <?php   if($curYear == $thisYear && ($id+1) >= $limitMonth){ 
                              $lastActiveMonth = intval(($id+1));
                            ?>
                             <li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a></li>
                          <?php } elseif($curYear > $thisYear){ ?>
                             <li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a></li>
                          <?php } else { ?>
                             <li><a class = "inactive" href="javascript:void(0)"><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a></li>
                          <?php } ?>
                        <?php endforeach; ?>
                    </ul>
                </span>
              </div>
            <?php endforeach; ?>
            <div class="clear"></div>
            <?php 
            $dates = current($calendar); 
            foreach ($calendar as $y=>$dates): 
             foreach ($dates as $m=>$days): 
              ?>


               <div class="month relative" id="month<?php echo $m; ?> <?php echo $y; ?>">
               <table>
                   <tbody>

                       <!-- <tr class = "days"> -->
                        <!-- <br><?php echo "$y-$m"; ?><br> -->
                       <?php $end = end($days); 
                      foreach ($usersArray as $arrayKey => $userTd): 
                      ?>
                       <tr class = "<?php echo ($userTd == "Users"  ? "" : "users ".$userTd); ?>"> 
                        <td class = "user"><?php echo $userTd; ?></td>
                      <?php
                        foreach($days as $d=>$w):
                          $class ="";
                        ?>
                           <td>
                         <?php 
                          $time = strtotime("$y-$m-$d"); 
                          if($userTd == "Users") {
                            ?><div class="relative">
                            <div class="day"><?php echo $d; ?></div>
                            </div>
                            <?php
                          }

                          if($userTd != "Users") {
                          ?>                           
                            <ul class="userEvents">
                          <?php

                            if(!empty($intervalArray)) {
                              foreach ($intervalArray as $eventUserKey => $toDate) {
                                $eventInfo = explode("==>", $eventUserKey);
                                $eventUser = $eventInfo[0];
                                $eventKey = $eventInfo[1];
                                if($eventUser == $userTd) {
                                  $currentEvent = $newEvents[$eventUser]['events'][$eventKey];
                                  if($time == $currentEvent['from'] && $time != $toDate){
                                    // echo "<li>".$newEvents[$eventUser]['events'][$eventKey]['description']."</li>";
                                    echo '<li class = "eventLi '.$currentEvent['type'].'"><span id="eventId">'.$currentEvent['id'].'</span> 
                                          <filter class =  "user">'.$currentEvent['auteur'].'</filter>
                                          <filter class =  "type">'.$currentEvent['type'].'</filter>
                                          <filter class =  "title">'.$currentEvent['titre'].'</filter>
                                          <!--<filter class =  "date filterSort"></filter>-->
                                        </li>';
                                  } elseif($time > $currentEvent['from'] && $time < $toDate && $currentEvent['to'] == $toDate) {
                                    // echo "<li>".$newEvents[$eventUser]['events'][$eventKey]['description']."</li>";
                                    echo '<li class = "eventLi '.$currentEvent['type'].'"><span id="eventId">'.$currentEvent['id'].'</span>  
                                          <filter class =  "user">'.$currentEvent['auteur'].'</filter>
                                          <filter class =  "type">'.$currentEvent['type'].'</filter>
                                          <filter class =  "title">'.$currentEvent['titre'].'</filter>
                                          <!--<filter class =  "date filterSort"></filter>-->
                                        </li>';
                                  } elseif($time == $toDate) {
                                    // echo "<li>".$newEvents[$eventUser]['events'][$eventKey]['description']."</li>";
                                    echo '<li class = "eventLi '.$currentEvent['type'].' '.$currentEvent['auteur'].'"><span id="eventId">'.$currentEvent['id'].'</span> 
                                          <filter class =  "user">'.$currentEvent['auteur'].'</filter>
                                          <filter class =  "type">'.$currentEvent['type'].'</filter>
                                          <filter class =  "title">'.$currentEvent['titre'].'</filter>
                                          <!--<filter class =  "date filterSort"></filter>-->
                                        </li>';
                                    unset($intervalArray[$eventUserKey]);
                                  }
                                }
                              }
                            }

                          }

                          
                         ?>
                               </ul>
                           </td> 
                        <?php 
                        endforeach; 
                        echo "</tr>";
                      endforeach; ?>
                       <!-- </tr>                       -->
                      
               <!-- </div> -->
                   </tbody>
               </table>
            </div>
            <?php endforeach; ?>
          <?php endforeach;?> 

          </div>
        <div class="clear"></div>

<div id="userEvent"></div>
<div id="events">
  <?php foreach ($events as $user => $curEvent) : 
  ?>
  <div id="eventId<?php echo $curEvent->id; ?>" class = "<?php echo $curEvent->auteur; ?>">
    <filter><?php echo $curEvent->type; ?></filter>

    <h1> <?php echo $curEvent->titre; ?> </h1>
    <h6> <?php echo $curEvent->type; ?> -- Debut : <?php echo date("Y-m-d",$curEvent->fromDate); ?>, Fin : <?php echo date("Y-m-d",$curEvent->toDate); ?></h6>
    <h3> <?php echo $curEvent->auteur; ?> </h3>
    <br>   
    <button class="md-trigger" data-modal="modal-1" value = "<?php echo Router::url("lookFor/events/event/id:$curEvent->id/slug:".makeSlug($curEvent->titre)); ?>"> Plus d'info
    </button>
  </div>             
 <?php endforeach; ?>
</div>

<div id="emptyDiv"></div>  
<div id="indexMap" style = "display : none;"> <div id="map-canvas"></div> </div>  

  </div>

</div>

    <?php echo HTML::JS("filter"); ?>

  <div class="scrollTools">
    <a href="#" id="up" class = "buttonUp"></a>
    <a href="#" id="down" class = "buttonDown"></a>
  </div>

<script type="text/javascript">   
  jQuery(function($){

    var start = +new Date();  // log start timestamp
    
    var date = new Date();
    var lastActiveMonth = "<?php echo $lastActiveMonth; ?>";
    lastActiveMonth = parseInt(lastActiveMonth);

    //Gestion des années              
    $('[class^="months "]').hide();
    var yearsArray = $('[class^="months "]');
    var disabledButton;

    if(yearsArray.length == 1) {
      $('.select').hide();
    }

    var currentYear = date.getFullYear();
    var curYear = currentYear;
    var curYearDiv = $('[class^="months '+curYear+'"]');
    curYearDiv.show();  

    $('.prevYear').hide();
    $('.select').click(function(){
      disabledButton = $(this);
      var prevNext = $(this).attr('class').replace('select ',"")
      prevNext = prevNext.replace("Year","");

      var add;
      if(prevNext == "prev") {
        add = -1;
      } else {
        add = 1;
      }            
      prevNextYear = curYear+add;

      if(prevNextYear != currentYear){
        $('.prevYear').show();
        $('.nextYear').hide();
      } else {
        $('.prevYear').hide();
        $('.nextYear').show();
      }

      if(prevNextYear > (currentYear+(yearsArray.length-1)) || prevNextYear < currentYear ) {
        $(this).disabled = true;
        return false;
      } else {
        disabledButton.disabled = false;
      }

      var prevYear = $('[class^="months '+curYear+'"]');
      var prevMonth = $('[id^="month'+curMonth+" "+curYear+'"]');
      var curRemove = curYear-currentYear;
      var curAdd = (curYear-currentYear)+add;

      var newYear = $('[class^="months '+prevNextYear+'"]');
      var newMonth = $('[id^="month'+curMonth+" "+prevNextYear+'"]');

      // $('a#linkMonth'+curMonth+':eq('+curRemove+')').removeClass('active'); 
      // $('a#linkMonth'+curMonth+':eq('+curAdd+')').addClass('active');

      if(prevNextYear == currentYear){
        var newMonth = $('[id^="month'+lastActiveMonth+" "+prevNextYear+'"]');  
        // $('a#linkMonth'+curMonth+':eq('+curAdd+')').removeClass('active');
        $('#months').find('span#monthsFor'+curYear).find('a#linkMonth'+curMonth).removeClass('active'); 
        $('#months').find('span#monthsFor'+prevNextYear).find('a#linkMonth'+lastActiveMonth).addClass('active'); 
        curMonth = lastActiveMonth;
      } else {
        var newMonth = $('[id^="month1'+" "+prevNextYear+'"]');  
        $('span#monthsFor'+curYear).find('a#linkMonth'+curMonth).removeClass('active'); 
        $('span#monthsFor'+prevNextYear).find('a#linkMonth1').addClass('active'); 
        curMonth = 1;
      }      

      prevYear.hide();
      prevMonth.hide();
      newYear.show();
      newMonth.show();

      curYear = prevNextYear;

      return false; 
    });

    //Gestion du calendrier des mois
    $('.month').hide();
    var curMonth = date.getMonth()+1;
    var curMonthDiv = $('[id^="month'+curMonth+" "+curYear+'"]');
    curMonthDiv.show();
    $('.months a:eq('+(curMonth-1)+')').addClass('active');
    $('.months a').click(function(){
      var month = $(this).attr('id').replace('linkMonth','');
      if(month != curMonth){
          $('[id^="month'+curMonth+" "+curYear+'"]').toggle("slide", { direction: "left" });
          $('[id^="month'+month+" "+curYear+'"]').delay(400).toggle("slide", { direction: "right" });
          $('.months a').removeClass('active'); 
          $('.months a#linkMonth'+month).addClass('active');
          curMonth = month; 
      }
      return false; 
    });

      
    //Afficher evenements d'un utilisateur en particulier
    $(".back").hide(); 
    $('.user').click(function() {
      $(".back").show(); 
      var user = $(this).text();
      $(".all").hide();       

      // var pathname = $(location).attr('href'); 
      // pathname = pathname.replace("index","");
      // console.log(pathname);
      // var pathnameController = pathname.replace(window.location.origin+"/POO3/webroot/","");
      // pathname = pathname.replace(pathnameController,"");

      var pathname = "<?php echo $_SERVER['PATH_INFO']; ?>"; 
      var pathnameController = pathname.replace("/index","");
      pathname = window.location.href.replace(pathname,""); 
      var lookFor = pathname+"/lookFor"+pathnameController+"/view/"+user;
      $("#loader").show(); 
      $('#userEvent').load(lookFor, function(){              
        $('#userEvent').show();
        $("#loader").hide();
      });
    });

    //Retour à la gestion des evenements          
    $('.back').click(function() {
      $('.all').show();     
      $("#userEvent").empty();       
      $("#userEvent").hide(); 
      $(".back").hide();  
    });

    //Traitement des filtres enregistré
    var filtreArray = [];
    function GetFilterArray(filterCookies){
      if(exists(filterCookies) && exists(filterCookies['type'])){
        filtreArray = filterCookies['type'];
      } else {
        filtreArray = ['parapente', 'parachute', 'aviation']
      }

      if(filtreArray.length == 1 && filtreArray[0] == "cookieFilter"){
        filtreArray = ['parapente', 'parachute', 'aviation']
      }

      return filtreArray;
    }


    //Gestion des Filtres et de leur description
    var TdLi ="", curEventTd = $('#emptyDiv'),calendarLiId,erasePrevious = false, curFilterTd = curEventTd, curLiIds = [];
    $(".userEvents li").DataFilter({
      div : true,
      appendTo : $('div.testFiltre'),
      filterTypes : {
        type : "option"
      },
      textParents : {
        user : "tr.users",
        club : 'parentElem'
      }, callback : function(){
        GetFilterArray($("#emptyDiv").SetFilterCookies());
        if(TdLi != "" && curEventTd != $('#emptyDiv')){
          if(curFilterTd.html() != TdLi.html()){
            curLiIds = [];
            TdLi.find('span#eventId').each(function(){ 
              var curLiId = $(this).text();
              curLiIds.push(curLiId);
            });
            curFilterTd = TdLi;
          }
          $("#events").find('[id^="eventId"]').find('filter').each(function(){
            curDivId = $(this).parent().attr("id").replace("eventId", "");
            if($.inArray(curDivId, curLiIds) != -1){
              if($.inArray($(this).text(), filtreArray ) == -1) {
                $(this).parent().hide("slide", { direction: "left" });
              }  else{
                $(this).parent().show("slide", { direction: "left" });
              }
            }
          });
        }
      }, 
      callbackEvent : 'click'
    });

    //Gestion des evenements du jour
    var filterCookies = $(".userEvents li").GetFilterCookies();
    GetFilterArray(filterCookies);

    var eventsDiv = $("#events");
    var eventId, eventIdDiv;
    $(eventsDiv).hide();
    $('[id^="eventId"]').hide();
    var eventTd = $(".eventLi");
    eventTd = eventTd.parents("td");

    $(eventTd).click(function(){
      TdLi = $(this).find("li");
      if($(this).html()  != curEventTd.html()) {
        erasePrevious = true;
      }
      if(erasePrevious || eraseNewFiltered) {
        $.each( $(curEventTd).find("li"), function( LiKey, LiValue ) {
          var calendarLiClass = $(LiValue).attr("class");
          calendarLiClass = calendarLiClass.split(" ");
          eventId = $(LiValue).find('span#eventId').text();
          eventIdDiv = $("#eventId"+eventId);
          // console.log("remove : "+jQuery.inArray( calendarLiClass[1], filtreArray )+$(eventIdDiv).text())
          if($.inArray( calendarLiClass[1], filtreArray ) != -1 && erasePrevious) { 
            $(eventIdDiv).hide("slide", { direction: "left" });
          } 
          if ($.inArray( calendarLiClass[1], filtreArray ) == -1 && eraseNewFiltered){  
            $(eventIdDiv).hide("slide", { direction: "left" });
          }

        });
        
        curEventTd = $(this);
        erasePrevious = false;
        eraseNewFiltered = false;
      }

      $.each( TdLi, function( LiKey, LiValue ) {
        eventId = $(LiValue).find('span#eventId').text();
        eventIdDiv = $("#eventId"+eventId);
        var calendarLiClass = $(LiValue).attr("class");
        calendarLiClass = calendarLiClass.split(" ");
        if($(this).html()  != curEventTd.html()) {
          $(eventsDiv).show();
          if($.inArray( calendarLiClass[1], filtreArray ) != -1 && filtreArray.length != 0) {                 
            $(eventIdDiv).show("slide", { direction: "left" });
          } 
        }                            
      });

      return false;
    });

    //Affichage d'un evenement dans une page modal
    $('.md-overlay').click(function(){
        window.history.go(-1);
        $('#descEvent').empty();
    })
    $('.md-history').click(function(){
        $('#descEvent').empty();
    })
    
    $('.md-modal').hide();
    $(".md-trigger").click(function() {
      $('.md-modal').show()
      $("#loader").show(); 
      var curHash = $(this).attr("value");
      prevPageTitle = $('title').text();
      formatedUrl = curHash.replace("lookFor_","");
      if(isHistoryAvailable){
        history.pushState({key : $("title").text(), 'url' : curHash}, $("title").text(), formatedUrl);
      }     
      $('#descEvent').load(curHash, function(){
        $("#loader").hide();
      }); 

      // $('#descEvent').ajaxStop ( function(){
      //   var lat = $('div#informations').find("div#location").find("div#lat").text();
      //   var lng = $('div#informations').find("div#location").find("div#lng").text();
      //   indexMap = $('#indexMap').find("#map-canvas");
      //   indexMap = indexMap[0];
      //   initialize(lat, lng, indexMap);
      // });

      $(".md-content").niceScroll(); // First scrollable DIV 
      $("#ascrail2000").css("background-color","rgb(0, 0, 0)");
      $("#ascrail2000").css("background-color","rgba(0, 0, 0, 0.14902)");
      $("#ascrail2000").css("z-index","auto");
      $("#ascrail2000").css("cursor","pointer");
      $("#ascrail2000").css("width","3px");
      $("#ascrail2000").append($(".scrollTools"));

      var scroller = $("#ascrail2000-hr").find("div");
      scroller.css('left', "2px");
      var scrollerHr = $("#ascrail2000").find("div");
      scrollerHr.css('left', "2px");
      
      var nice = $(".md-content").getNiceScroll();
      var margin = 0;
      $("#down").mousedown(function () {
        margin +=250;
        nice[0].doScrollTop(margin,500);
      });
      $("#up").click(function () {
        if(margin != 0) {
          margin -= 250;
        }
        nice[0].doScrollTop(margin,500);
      });

      return false;
    });

var end =  +new Date();  // log end timestamp
var diff = end - start;
console.log(diff);

    //maps 
    // function initialize($lat, $lng, $map) {
    //   var map
    //   google.maps.visualRefresh = true;
    //   var mapDiv = $map;

    //   var markerLatLng = new google.maps.LatLng($lat, $lng);
    //   var mapOptions = {
    //     zoom: 14,
    //     center: markerLatLng,
    //     mapTypeId: google.maps.MapTypeId.ROADMAP,
    //     disableDefaultUI: true
    //   };
    //   map = new google.maps.Map(mapDiv,
    //       mapOptions);

    //   var marker = new google.maps.Marker({
    //     position: map.getCenter(),
    //     map: map,
    //     title: newPageTitle
    //   });
    // }

    // google.maps.event.addDomListener(window, 'load', initialize);
      
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

<script>
  // this is important for IEs
  var polyfilter_scriptpath = "<?php echo Router::webroot('js/modal/'); ?>";
</script>
<?php echo HTML::JS("modal/classie"); ?>
<?php echo HTML::JS("modal/modalEffects"); ?>
<?php echo HTML::JS("modal/cssParser"); ?>
<?php echo HTML::JS("modal/css-filters-polyfill"); ?>