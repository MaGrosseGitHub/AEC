
  <div class="md-modal md-effect-1" id="modal-1">
    <div class="md-content" style = "
  overflow : scroll; 
  height: 500px;">
      <h3>Modal Dialog</h3>
      <div>
        <div id="descEvent"></div>
        <button class="md-close">Close me!</button>
      </div>
    </div>
  </div>

  <div class="md-overlay"></div>

<div class="row">
  <div class="span13">

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
    .userMonth{  margin-top:12px;}
    .userMonths ul{  list-style:none;  margin:0px;  padding:0px;}
    .userMonths ul li a{  float:left;  margin:-1px;  padding:0px 15px 0px 0px;  color:#888888;  text-decoration:none;  font-size:15px;  font-weight:bold;  text-transform:uppercase;}
    .userMonths ul li a:hover, .userMonths ul li a.active{  color:#D90000;}
    table{  border-collapse:collapse;}
    table td{  border:1px solid #A3A3A3;  width:30px;  height:30px;}
    table td.event{  border:2px solid #0080FF;  width:30px;  height:30px;}
    table td.padding{  border:none;}
    table td:hover{  background:#DFDFDF;  cursor:pointer;}
    table th{  font-weight:normal;  color:#A8A8A8;}
    table td .day{  position:absolute;  color:#8C8C8C;  font-weight:bold;  font-size:12pt;}
    table td .userEvents{  position:relative;  width:20px;  height:0px;  margin:-9px 0px 0px;  padding:0px;}
    table td .userEvents li{  width:5px;  height:5px;  float:left;  background:#000;    -moz-border-radius:5px;  -webkit-border-radius:5px;  -khtml-border-radius:5px;  border-radius:5px 5px 5px 5px;  margin-left:2px;  overflow:hidden;  text-indent:-3000px;}
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

    .checked {
      color : red;
    }

    .unchecked {
      color : blue;
    }

    /*input[type=checkbox], input[type=radio] {
      vertical-align: middle;
      position: relative;
      bottom: 1px;
    }
    input[type=radio] {
      bottom: 2px;
    }*/

    input[type=checkbox], input[type=radio]
    {
        width: 15px;
        height: 15px;
        float: left;
    }
    label
    {
        float: left;
        padding-left: 3px;
    }

    </style>


    <style>
  
.buttonUp {
background-image: url(<?php echo HTML::getImg("mCSB_buttons.png", true, null, true); ?>);
background-position: -80px 0px;
/*background-position: 0px 0px;*/
/*background-position: -32px 0px;*/
/*background-position: -112px 0px;*/
/*background-position: -16px 0px;*/
background-repeat: no-repeat;
color: rgb(238, 238, 238);
/*color: rgb(51, 51, 51);*/
/*color: rgb(34, 34,34);*/
/*color: rgb(34, 34,34);*/
cursor: pointer;
display: block;
font-family: Verdana, Geneva, sans-serif;
font-size: 13px;
height: 20px;
/*line-height: 20px;*/
margin-bottom: 0px;
margin-left: 0px;
margin-right: 0px;
margin-top: 0px;
opacity: 0.75;
overflow-x: hidden;
overflow-y: hidden;
position: absolute;
left : -7.5px;
top : 20px;
width: 16px;


}
.buttonDown {
background-image: url(<?php echo HTML::getImg("mCSB_buttons.png", true, null, true); ?>);
background-position: -80px -20px;
/*background-position: 0px -20px;*/
/*background-position: -32px -20px;*/
/*background-position: -112px -20px;*/
/*background-position: -16px -20px;*/
background-repeat: no-repeat;
color: rgb(238, 238, 238);
cursor: pointer;
display: block;
font-family: Verdana, Geneva, sans-serif;
font-size: 13px;
height: 20px;
line-height: 20px;
margin-bottom: 0px;
margin-left: 0px;
margin-right: 0px;
margin-top: 0px;
opacity: 0.75;
overflow-x: hidden;
overflow-y: hidden;
position: absolute;
left : -7.5px;
bottom : -20px;
width: 16px;
}

</style>

    <div class="page-header">
      <h1><?php echo isset($title)?$title:'Events'; ?></h1>
    </div>
  <?php 
        // debug($calendar, "calendar"); 
        // debug($events, "events"); 
        // debug($calendar, "calendar"); 
        // debug($curYear);
        // debug($year);
        // $timestamp = strtotime('07-09-2013');
        // echo $timestamp;
        

        // $nextMonth = array(); 
        // $usersArray = array("Users"); 
        // $intervalArray = array(); 
        // $newFromDate = "";
        // $newToDate = "";

        // $test = 0;
        // $test2 = 0;
        // foreach ($events as $k => $v){
        //   $newEntry = array(
        //       'id' => $v->id, 
        //       'auteur' => $v->auteur,
        //       // 'description' => $v->description, 
        //       'titre' => $v->titre, 
        //       'type' => $v->type,
        //       'from' => $v->fromDate, 
        //       'to' => $v->toDate
        //       );
        //   if($test == 0 || $test >= $v->toDate){
        //     $test = $v->toDate;
        //   }
        //   if($test2 == 0 || $test2 >= $v->fromDate){
        //     $test2 = $v->fromDate;
        //   }
        //   if(date('n', $v->fromDate) != date('n', $v->toDate) )
        //     $newEntry['nextMonth'] = true;
        //   $newEvents[$v->auteur]['events'][] = $newEntry; 
        //   $newEventsEntry = count($newEvents[$v->auteur]['events'])-1;
        //   // $CheckEvents[$v->fromDate] = $v->auteur.'===>'.$newEventsEntry;
        //   $intervalArray[$v->auteur.'==>'.$newEventsEntry] = $v->toDate;
        //   if(!in_array($v->auteur, $usersArray))
        //     array_push($usersArray, $v->auteur); 
        // }


  ?>
              <button class="back">All</button>
<div class="periods all" id = "periods">
              <button class="select prevYear">Previous</button>
              <button class="select nextYear">Next</button>
              <!-- <button class="filtre aviation checked">aviation</button>
              <button class="filtre parapente checked">parapente</button>
              <button class="filtre parachute checked">parachute</button> -->

<div class = "test">Lorem ipsum Enim enim exercitation occaecat laboris sint exercitation eiusmod in mollit ut voluptate non in cupidatat adipisicing in ut deserunt sit in nulla incididunt minim Duis sunt quis adipisicing sunt.</div>

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
                           <li><a href="javascript:void(0)"><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a></li>
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
                                          <filter class =  "club">'.$currentEvent['titre'].'</filter>
                                          <filter class =  "date filterSort"></filter>
                                          <filter class =  "test filterSort">'.$currentEvent['type'].'</filter>
                                        </li>';
                                  } elseif($time > $currentEvent['from'] && $time < $toDate && $currentEvent['to'] == $toDate) {
                                    // echo "<li>".$newEvents[$eventUser]['events'][$eventKey]['description']."</li>";
                                    echo '<li class = "eventLi '.$currentEvent['type'].'"><span id="eventId">'.$currentEvent['id'].'</span>  
                                          <filter class =  "user">'.$currentEvent['auteur'].'</filter>
                                          <filter class =  "type">'.$currentEvent['type'].'</filter>
                                          <filter class =  "club">'.$currentEvent['titre'].'</filter>
                                          <filter class =  "date filterSort"></filter>
                                          <filter class =  "test filterSort">'.$currentEvent['type'].'</filter>
                                        </li>';
                                  } elseif($time == $toDate) {
                                    // echo "<li>".$newEvents[$eventUser]['events'][$eventKey]['description']."</li>";
                                    echo '<li class = "eventLi '.$currentEvent['type'].' '.$currentEvent['auteur'].'"><span id="eventId">'.$currentEvent['id'].'</span> 
                                          <filter class =  "user">'.$currentEvent['auteur'].'</filter>
                                          <filter class =  "type">'.$currentEvent['type'].'</filter>
                                          <filter class =  "club">'.$currentEvent['titre'].'</filter>
                                          <filter class =  "date filterSort"></filter>
                                          <filter class =  "test filterSort">'.$currentEvent['type'].'</filter>
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

   <h1> <?php echo $curEvent->titre; ?> </h1>
   <h6> <?php echo $curEvent->type; ?> -- Debut : <?php echo date("Y-m-d",$curEvent->fromDate); ?>, Fin : <?php echo date("Y-m-d",$curEvent->toDate); ?></h6>
   <h3> <?php echo $curEvent->auteur; ?> </h3>
    <br>   
        <button class="md-trigger" data-modal="modal-1" value = "<?php echo Router::webroot("lookFor/events/event/$curEvent->id"); ?>">Plus d'info</button>
  </div>             
 <?php endforeach; ?>
</div>

<div id="emptyDiv"></div>  

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
      // console.log(prevNextYear-curRemove);
      // console.log(prevNextYear-curAdd);

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
    $("#events").hide(); 
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


    //Gestion des Filtres
    $(".userEvents li").DataFilter({
      div : true,
      appendTo : $('div.test'),
      filterTypes : {
        test : "list",
        test2 : "text",
        type : "option"
      },
      textParents : {
        user : "tr.users",
        club : 'parentElem'
      }
    });


    //Gestion des evenements du jour
    var filterCookies = $(".userEvents li").GetFilterCookies();
    if(exists(filterCookies) && exists(filterCookies['type'])){
      filtreArray = filterCookies['type'];
    } else {
      filtreArray = ['parapente', 'parachute', 'aviation']
    }

    if(filtreArray.length == 1 && filtreArray[0] == "cookieFilter"){
      filtreArray = ['parapente', 'parachute', 'aviation']
    }

    var eventsDiv = $("#events");
    var eventId, eventIdDiv;
    $(eventsDiv).hide();
    $('[id^="eventId"]').hide();
    var eventTd = $(".eventLi");
    eventTd = eventTd.parents("td");
    var curEventTd = $('#emptyDiv'),calendarLiId,erasePrevious = false;

    $(eventTd).click(function(){
      var TdLi = $(this).find("li");
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
          if(jQuery.inArray( calendarLiClass[1], filtreArray ) != -1 && erasePrevious) { 
            $(eventIdDiv).hide("slide", { direction: "left" });
          } 
          if (jQuery.inArray( calendarLiClass[1], filtreArray ) == -1 && eraseNewFiltered){  
            $(eventIdDiv).hide("slide", { direction: "left" });
          }

        });
        
        curEventTd = $(this) ;
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
          if(jQuery.inArray( calendarLiClass[1], filtreArray ) != -1 && filtreArray.length != 0) {                 
            $(eventIdDiv).show("slide", { direction: "left" });
          } 
        }                            
      });
      return false;
    });

    //Affichage d'un evenement dans une page modal
    $('.md-modal').hide();
    $(".md-trigger").click(function() {
      $('.md-modal').show()
      $("#loader").show(); 
      var curHash = $(this).attr("value");
      $('#descEvent').load($(this).attr("value"), function(){              
        // $('#userEvent').show();
        $("#loader").hide();
        var newHash = "2131/"
        window.location.hash = newHash;
      // console.log($(".md-modal").height());
      // console.log($(document).height());
      // console.log($(window).height());
      }); 

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
      // console.log(nice);
      // console.log(nice[0]);
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

  // $("ul.testReorder li").DataFilter({
  //   div:true,
  //   appendTo : $("ul.testReorder"),
  //   filterTypes : {
  //     test : "toggle"
  //   }
  // })


var end =  +new Date();  // log end timestamp
var diff = end - start;
console.log(diff);

});
</script>

<script>
  $test2 = 5;
  function modalCallback2($param){
    console.log($param);
  }
</script>

<script>
  // this is important for IEs
  var polyfilter_scriptpath = "<?php echo Router::webroot('js/modal/'); ?>";
</script>
<?php echo HTML::JS("modal/classie"); ?>
<?php echo HTML::JS("modal/modalEffects"); ?>
<?php echo HTML::JS("modal/cssParser"); ?>
<?php echo HTML::JS("modal/css-filters-polyfill"); ?>