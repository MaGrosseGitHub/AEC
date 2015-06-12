<?php $title_for_layout = "Evenements"; ?>
  <div class="md-modal md-effect-1" id="modal-1">
    <div class="md-content" style = "
        overflow : scroll; 
        height: 500px;">
      <h3>Evenement</h3>
      <div>
        <div id="descEvent"></div>
        <button class="md-close">x</button>
      </div>
    </div>
  </div>

  <div class="md-overlay"></div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=FR&libraries=geometry,weather"></script>

<!-- CSS pour events -->
    <style type="text/css">

    /*[fmt]0020-000A-3*/
    .periods { width : 960px;}
    table{  border-collapse:collapse;} 
    table td{  border:1px solid #A3A3A3;  width:20px;  height:20px;}
    .year{  color:#D90000;  font-size:85px; display : block;}
    .relative{  position:relative;}
    .months{}
    .month{  margin-top:12px;}
    .months ul{  list-style:none;  margin:0px;  padding:0px;}
    .months ul li a{  float:left;  margin:-1px;  padding:0px 15px 0px 0px;  color:#888888;  text-decoration:none;  font-size:15px;  font-weight:bold;  text-transform:uppercase;}
    .months ul li a:hover, .months ul li a.active{  color:#D90000;}
    .months ul li a.inactive{  color:#D8D8D8;}
    .userMonth{  margin-top:12px;}
    .userMonths ul{  list-style:none;  margin:0px;  padding:0px;}
    .userMonths ul li a{  float:left;  margin:-1px;  padding:0px 15px 0px 0px;  color:#888888;  text-decoration:none;  font-size:15px;  font-weight:bold;  text-transform:uppercase;}
    .userMonths ul li a:hover, .userMonths ul li a.active{  color:#D90000;}    
    .userMonths ul li a.inactive{  color:#D8D8D8;}
    table{  border-collapse:collapse;}
    table td{  border:1px solid #A3A3A3;  width:30px;  height:30px;}
    table td.event{  border:2px solid #0080FF;  width:30px;  height:30px;}
    table td.padding{  border:none;}
    table td:hover{  background:#DFDFDF;  cursor:pointer;}
    table th{  font-weight:normal;  color:#A8A8A8;}
    table td .day{  position:absolute;  color:#8C8C8C;  font-weight:bold;  font-size:12pt;}
    table td .userEvents{  position:relative;  width:20px;  height:0px;  margin:-9px 0px 0px;  padding:0px;}
    table td .userEvents li{display : block; -moz-border-radius:5px;  -webkit-border-radius:5px;  -khtml-border-radius:5px;  border-radius:5px 5px 5px 5px;  margin-left:2px;  margin-top:2px;  overflow:hidden;  text-indent:-3000px;}
.ends{  width:8px;  height:8px;   background:#000;}
.middle{  width:5px;  height:5px;   background:#000;}
    /*table td .userEvents li{ padding : 0; margin : 0; display : block; width:100%;  height:15px;  background:#F00;  overflow:hidden;  text-indent:-3000px;}*/
    /*table td:hover .userEvents{  position:absolute;  left:582px;  top:66px;  width:442px;  list-style:none;  margin:0px;  padding:11px 0px 0px;}
    table td:hover .userEvents li{  height:100px;  line-height:40px;  font-weight:bold;  border-bottom:1px solid #D6D6D6;  padding-left:41px;  text-indent:0;  background:none;  width:500px;}
    table td:hover .userEvents li:first-child{  border-top:1px solid #D6D6D6;}
    table td:hover .daytitle{  position:absolute;  left:582px;  top:21px;  width:442px;  list-style:none;  margin:0px 0px 0px 16px;  padding:0px;  color:#D90000;  font-size:41px;  display:block;  font-weight:bold;}*/
    table td .daytitle{  display:none;}
    .clear{  clear:both;}
    .red { background: red;}
    .blue { background: blue;}
    .yellow { background: yellow;}
    table td.today{  border:2px solid #D90000;  width:30px;  height:30px;}

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
  top : 13px;
  right : 0px;
  font-size: 1.5em;
}

    /*input[type=checkbox], input[type=radio] {
      vertical-align: middle;
      position: relative;
      bottom: 1px;
    }
    input[type=radio] {
      bottom: 2px;
    }*/

    /*input[type=checkbox], input[type=radio]
    {
        width: 15px;
        height: 15px;
        float: left;
    }
    label
    {
        float: left;
        padding-left: 3px;
    }*/

</style>
<div id="searchResults">
</div>

<div class="row">
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
              <button class="changeColors">couleur</button> 

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
                          <?php   
                            if($curYear == $limitYear && ($id+1) >= $limitMonth) {
                              echo '<li><a href="#" id="linkMonth'.($id+1);
                            } elseif($curYear >= $thisYear && $limitYear != $thisYear){
                              echo '<li><a href="#" id="linkMonth'.($id+1);
                            } else {
                              echo '<li><a class = "inactive" href="javascript:void(0)';
                            } 

                            if(in_array(($id+1), $eventMonths))
                              echo '">'.utf8_encode(substr(utf8_decode($m),0,3)).'*</a></li>';
                            else
                              echo '">'.utf8_encode(substr(utf8_decode($m),0,3)).'</a></li>';
                          ?>
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
                                    echo '<li class = "eventLi '.$currentEvent['type'].' ends"><span id="eventId">'.$currentEvent['id'].'</span> 
                                          <filter class =  "user">'.$currentEvent['auteur'].'</filter>
                                          <filter class =  "type">'.$currentEvent['type'].'</filter>
                                          <filter class =  "title">'.$currentEvent['titre'].'</filter>
                                          <!--<filter class =  "date filterSort"></filter>-->
                                        </li>';
                                  } elseif($time > $currentEvent['from'] && $time < $toDate && $currentEvent['to'] == $toDate) {
                                    // echo "<li>".$newEvents[$eventUser]['events'][$eventKey]['description']."</li>";
                                    echo '<li class = "eventLi '.$currentEvent['type'].' middle"><span id="eventId">'.$currentEvent['id'].'</span>  
                                          <filter class =  "user">'.$currentEvent['auteur'].'</filter>
                                          <filter class =  "type">'.$currentEvent['type'].'</filter>
                                          <filter class =  "title">'.$currentEvent['titre'].'</filter>
                                          <!--<filter class =  "date filterSort"></filter>-->
                                        </li>';
                                  } elseif($time == $toDate) {
                                    // echo "<li>".$newEvents[$eventUser]['events'][$eventKey]['description']."</li>";
                                    echo '<li class = "eventLi '.$currentEvent['type'].' '.$currentEvent['auteur'].' ends"><span id="eventId">'.$currentEvent['id'].'</span> 
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
<div id="events" class = "index">
  <?php foreach ($events as $user => $curEvent) : 
  ?>
  <div id="eventId<?php echo $curEvent->id; ?>" class = "<?php echo $curEvent->auteur; ?>">
    <filter><?php echo $curEvent->type; ?></filter>

    <h1 class = "eventTitle"> <?php echo $curEvent->titre; ?> </h1>
    <h6> <?php echo $curEvent->type; ?> -- Debut : <?php echo date("Y-m-d",$curEvent->fromDate); ?>, Fin : <?php echo date("Y-m-d",$curEvent->toDate); ?></h6>
    <h3> <?php echo $curEvent->auteur; ?> </h3>
    <br>   
    <button class="md-trigger" data-modal="modal-1" value = "<?php echo Router::url("lookFor/events/event/id:$curEvent->id/slug:".makeSlug($curEvent->titre)); ?>"> Plus d'info
    </button>
  </div>             
 <?php endforeach; ?>
</div>

<div id="emptyDiv"></div>

  </div><!-- end col12 -->
</div><!-- end row -->

  <div class="scrollTools">
    <a href="#" id="up" class = "buttonUp"></a>
    <a href="#" id="down" class = "buttonDown"></a>
  </div>

<script type="text/javascript">   
  var curMdTrigger = "";
  eventIndex = true;
  jQuery(function($){
    
    var date = new Date();

    var lastActiveMonth = "<?php echo intval($limitMonth); ?>";
    var limitYear = "<?php echo intval($limitYear); ?>";
    lastActiveMonth = parseInt(lastActiveMonth)
    var urlOrigin = document.location.href;
    var titleOrigin = $('title').text();

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

    var prevLimitYear = true;
    if(limitYear == curYear){
      $('.prevYear').hide();
      prevLimitYear = false;
    }
    if(yearsArray.length > 1 && prevLimitYear && yearsArray.length < 3){
      $('.nextYear').hide();
    }
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

      if((limitYear != prevNextYear && prevNextYear < currentYear) || (prevNextYear != currentYear && limitYear == currentYear)){
        $('.prevYear').show();
        $('.nextYear').hide();
      } else if(prevNextYear == currentYear && prevLimitYear) {
        $('.prevYear').show();
        if(yearsArray.length < 3){
          $('.nextYear').hide();
        } else {
          $('.nextYear').show();
        }
      } else if(prevNextYear > currentYear) {
        $('.prevYear').show();
        $('.nextYear').hide();
      } else {
        $('.prevYear').hide();
        $('.nextYear').show();
      }

      if(prevNextYear > (currentYear+(yearsArray.length-1)) || (prevNextYear < currentYear && !prevLimitYear) ) {
        $(this).disabled = true;
        return false;
      } else {
        disabledButton.disabled = false;
      }

      var prevYear = $('[class^="months '+curYear+'"]');
      var prevMonth = $('[id^="month'+curMonth+" "+curYear+'"]');
      // var curRemove = curYear-currentYear;
      // var curAdd = (curYear-currentYear)+add;

      var newYear = $('[class^="months '+prevNextYear+'"]');
      var newMonth = $('[id^="month'+curMonth+" "+prevNextYear+'"]');

      // $('a#linkMonth'+curMonth+':eq('+curRemove+')').removeClass('active'); 
      // $('a#linkMonth'+curMonth+':eq('+curAdd+')').addClass('active');

      if(prevNextYear <= currentYear){
        var thisLastActiveMonth = lastActiveMonth;
        if(prevNextYear == currentYear){
          thisLastActiveMonth = date.getMonth()+1;
        }
        var newMonth = $('[id^="month'+thisLastActiveMonth+" "+prevNextYear+'"]'); 
        $('#monthsFor'+curYear).find('a#linkMonth'+curMonth).removeClass('active');
        $('#monthsFor'+prevNextYear).find('a#linkMonth'+curMonth).removeClass('active'); 
        $('#monthsFor'+prevNextYear).find('a#linkMonth'+thisLastActiveMonth).addClass('active'); 
        curMonth = thisLastActiveMonth;
      } else {
        var newMonth = $('[id^="month1'+" "+prevNextYear+'"]');  
        $('#monthsFor'+curYear).find('a#linkMonth'+curMonth).removeClass('active'); 
        $('#monthsFor'+prevNextYear).find('a#linkMonth'+curMonth).removeClass('active'); 
        $('#monthsFor'+prevNextYear).find('a#linkMonth1').addClass('active'); 
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
    $('#monthsFor'+curYear).find('a#linkMonth'+curMonth).addClass('active');
    $('.months a').click(function(){
      if($(this).hasClass('inactive')){
        return false;
      }
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
      textParents : {
        user : "tr.users",
        club : 'parentElem'
      }, callback : [function(){
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
      }, function(titleSearch){        
        $("h1.eventTitle").each(function(){
          $elemSearch = $(this).text();
          eventsDiv.show();
          if(fuzzy_match($elemSearch, titleSearch)){
            $(this).parent().show();
            foundErrors = true;
          } else{
            $(this).parent().hide();
          }

          if(titleSearch == "" || titleSearch == " "){
            eventsDiv.hide();
          }
        });
      }], 
      callbackEvent : ['click', 'keyup']
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
    $('.md-overlay, .md-close').click(function(){
        if(isHistoryAvailable){
          history.replaceState({key : $("title").text(), 'url' : urlOrigin}, $("title").text(), urlOrigin);
        }     
        $('title').text(titleOrigin);
        $('#descEvent').empty();
    })
    
    $('.md-modal').hide();
    $(".md-trigger").click(function() {
      curMdTrigger = $(this);
      $('.md-modal').show()
      $("#loader").show(); 
      var curHash = $(this).attr("value");
      prevPageTitle = $('title').text();
      formatedUrl = curHash.replace("lookFor_","");
      if(isHistoryAvailable){
        history.replaceState({key : $("title").text(), 'url' : curHash}, $("title").text(), formatedUrl);
      }     
      $('#descEvent').html('');
      $('#descEvent').empty();
      $('#disqus_thread').html("");
      $('#disqus_thread').empty();
      $('#descEvent').load(curHash, function(){
        $("#loader").hide();
      }); 

      // $('#descEvent').ajaxStop ( function(){
      //   console.log($(this).html());
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

    //Gestion des couleurs des events
    $('button.changeColors').click(function(){
      var LiTextArray = [];
      var LiEventColor = [];
      var LastParent = "";
      $('li.eventLi').find('span#eventId').each(function(){
        var curParent = $(this).parents('ul');
        var curLiText = $(this).text();
        var curLiColor = getRandomColor();
        var LiArrayPos = $.inArray(curLiText, LiTextArray);
        if(LiArrayPos != -1){
          $(this).parent().css('background', '#'+LiEventColor[LiArrayPos]);
        }else {
          $(this).parent().css('background', '#'+curLiColor);
          LiTextArray.push(curLiText);
          LiEventColor.push(curLiColor);
        }
        if($(curParent).html() != $(LastParent).html()){
          LastParent = curParent;
        } else{
          $(curParent).find('span#eventId').each(function(spanKey, LiSpans){
            var test = $.inArray($(LiSpans).text(), LiTextArray);
            if(test > LiArrayPos) {
              var $selected = $(LiSpans).parent();
              var $parent = $selected.parents('ul');
              $selected.remove();
              $selected.appendTo($parent);
            }
          });
        }
      });
    });
    $('button.changeColors').trigger( "click" );
      
  });
</script>

<script>
  // this is important for IEs
  var polyfilter_scriptpath = "<?php echo Router::webroot('js/modal/'); ?>";
</script>
<?php echo HTML::JS("modal/classie"); ?>
<?php echo HTML::JS("modal/modalEffects"); ?>
<?php echo HTML::JS("modal/cssParser"); ?>
<?php echo HTML::JS("modal/css-filters-polyfill"); ?>