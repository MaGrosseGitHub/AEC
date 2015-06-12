<?php $title_for_layout = "Evenements : ".ucfirst($user); ?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=FR&libraries=geometry,weather"></script>

<div class="row-fluid">
  <div class="col-md-12">  

    <div class="userPeriods">
      <button class="select prevYear">Previous</button>
      <button class="select nextYear">Next</button>
      <br>
      <br>
      <br>
      <?php foreach ($this->years as $yearKey=>$curYear): ?>
      <div class="<?php echo $user; ?> userMonths <?php echo $curYear; ?>">
        <div><?php echo $curYear; ?></div>
        <!-- <div class="year"><?php echo $curYear; ?></div> -->
        <br>
        <br>
        <br>
        <!-- <ul>
            <?php //foreach ($this->months as $id=>$m): ?>
                 <li><a href="#" id="linkMonth<?php //echo $id+1; ?>"><?php //echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a></li>
            <?php //endforeach; ?>
        </ul>  -->                 
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
        // $dates = current($calendar); 
        foreach ($calendar as $y=>$dates): 
          foreach ($dates as $m=>$days): ?>
        <div class="usermonth relative" id="<?php echo $user; ?> userMonth<?php echo $m; ?> <?php echo $y; ?>">
        <table>
            <thead>
                <tr>
                     <?php foreach ($this->days as $d): ?>
                          <th><?php echo substr($d,0,3); ?></th>
                     <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                 <?php $end = end($days); foreach($days as $d=>$w): ?>
                     <?php $time = strtotime("$y-$m-$d"); ?>
                     <?php if($d == 1 && $w != 1): ?>
                        <td colspan="<?php echo $w-1; ?>" class="padding"></td>
                     <?php endif; ?>

                    <td class="<?php if($time == strtotime(date('Y-m-d'))): ?>today<?php endif; ?>" >
                          <div class="relative">
                              <div class="day"><?php echo $d; ?></div>
                          </div>
                        <div class="daytitle">
                             <?php echo $this->days[$w-1]; ?> <?php echo $d; ?>  <?php echo $this->months[$m-1]; ?>
                        </div>
                        <ul class="userEvents">
                     <?php 
                      if(array_key_exists(''.$m.'', $nextMonth)) {
                        foreach ($nextMonth[$m] as $monthKey => $eventInfo) {
                            if($time == $eventInfo['from'] && $time != $eventInfo['to']){
                              echo '<li class = "eventLi">'.$eventInfo['id'].'</li>';
                            } elseif($time > $eventInfo['from'] && $time < $eventInfo['to']) {
                              echo '<li class = "eventLi">'.$eventInfo['id'].'</li>';
                            } elseif($time == $eventInfo['to']) {
                              echo '<li class = "eventLi">'.$eventInfo['id'].'</li>';
                            }
                        }
                      }
                     ?>
                        </ul>
                    </td>
                    <?php if($w == 7): ?>
                      </tr><tr>
                    <?php endif; ?>
                 <?php endforeach; ?>
                 <?php if($end != 7): ?>
                      <td colspan="<?php echo 7-$end; ?>" class="padding"></td>
                 <?php endif; ?>
                </tr>
            </tbody>
          </table>
        </div>
        <?php endforeach; ?>
      <?php endforeach; ?>  
    </div>
    <div class="clear"></div>

  </div><!-- end col12 -->
</div><!-- end row -->
<div class="clear"></div>

<!-- </div> -->
<div class="row">
  <div class="col-md-12">
    <div id="UserEventsId"> 

      <input type="text" class = "eventTitleSearch" placeholder = "chercher titre" style = "display : none;"> 
      <div id="events">
        <?php foreach ($userEvents as $keyEvent => $curEvent) : 
        ?>
        <div id="eventId<?php echo $curEvent->id; ?>">

          <h1 class = "eventTitle"> <?php echo $curEvent->titre; ?> </h1>
          <h6> 
            <?php echo $curEvent->type; ?> 
            -- Debut : <?php echo date("Y-m-d",$curEvent->fromDate); ?>, 
            Fin : <?php echo date("Y-m-d",$curEvent->toDate); ?>
          </h6>

          <br>   
          <button class="md-event" value = "<?php echo Router::url("lookFor/events/event/id:$curEvent->id/slug:".makeSlug($curEvent->titre)); ?>"> Plus d'info
          </button>
        </div>             
       <?php endforeach; ?>
      </div>
    </div>
  </div><!-- end col12 -->
</div><!-- end row -->

<div id="emptyModal"></div>
<br>
<br>
<br>
<br>
<br>
<br>

  <script type="text/javascript">
    jQuery(function($){
      var date = new Date();

      var curUser = "<?php echo $user; ?>";
      var lastActiveMonth = "<?php echo intval($limitMonth); ?>";
      lastActiveMonth = parseInt(lastActiveMonth);

      //Gestion des années              
      $('[class^="'+curUser+' userMonths "]').hide();
      var yearsArray = $('[class^="'+curUser+' userMonths "]');
      var disabledButton;

      if(yearsArray.length == 1) {
        $('.select').hide();
      }

      var currentYear = date.getFullYear();
      var curYear = currentYear
      var curYearDiv = $('[class^="'+curUser+' userMonths '+curYear+'"]');
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

        var prevYear = $('[class^="'+curUser+' userMonths '+curYear+'"]');
        var prevMonth = $('[id^="'+curUser+' userMonth'+curMonth+" "+curYear+'"]');
        var curRemove = curYear-currentYear;
        var curAdd = (curYear-currentYear)+add;

        var newYear = $('[class^="'+curUser+' userMonths '+prevNextYear+'"]');
        var newMonth = $('[id^="'+curUser+' userMonth'+curMonth+" "+prevNextYear+'"]');

        // $('a#linkMonth'+curMonth+':eq('+curRemove+')').removeClass('active'); 
        // $('a#linkMonth'+curMonth+':eq('+curAdd+')').addClass('active');
        
        if(prevNextYear == currentYear){
          var newMonth = $('[id^="'+curUser+' userMonth'+lastActiveMonth+" "+prevNextYear+'"]');
          $('.userMonths').find('span#monthsFor'+curYear).find('a#linkMonth'+curMonth).removeClass('active'); 
          $('.userMonths').find('span#monthsFor'+prevNextYear).find('a#linkMonth'+lastActiveMonth).addClass('active'); 
          curMonth = lastActiveMonth;
        } else {
          var newMonth = $('[id^="'+curUser+' userMonth1'+" "+prevNextYear+'"]'); 
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
      $('.usermonth').hide();
      var curMonth = date.getMonth()+1;
      var curMonthDiv = $('[id^="'+curUser+' userMonth'+curMonth+" "+curYear+'"]');
      curMonthDiv.show();
      $('.userMonths a:eq('+(curMonth-1)+')').addClass('active');
      $('.userMonths a').click(function(){
        var month = $(this).attr('id').replace('linkMonth','');
        if(month != curMonth){
            $('[id^="'+curUser+' userMonth'+curMonth+" "+curYear+'"]').toggle("slide", { direction: "left" });
            $('[id^="'+curUser+' userMonth'+month+" "+curYear+'"]').delay(400).toggle("slide", { direction: "right" });
            $('.userMonths a').removeClass('active'); 
            $('.userMonths a#linkMonth'+month).addClass('active'); 
            curMonth = month;
        }
        return false; 
      });

      // //Gestion des description des evenements
      var eventsClass = $(".event");
      $(eventsClass).click(function(){              
        var thisEvent = $(':nth-child(3)', $(this));
        $("#UserEventsId").html(thisEvent.html());

        return false;
      });

      //Gestion des evenements du jour
      if(!eventIndex){
        var eventsDiv = $("#UserEventsId").find("#events");
      }else{
        var eventsDiv = $("div.index");
      }
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
            eventId = $(LiValue).text();
            eventIdDiv = $("#eventId"+eventId);
            $(eventIdDiv).hide("slide", { direction: "left" });                         
          });
          
          curEventTd = $(this) ;
          erasePrevious = false;
          eraseNewFiltered = false;
        }

        $.each( TdLi, function( LiKey, LiValue ) {
          eventId = $(LiValue).text();
          eventIdDiv = $("#eventId"+eventId);
          var calendarLiClass = $(LiValue).attr("class");
          calendarLiClass = calendarLiClass.split(" ");
          if($(this).html()  != curEventTd.html()) {
            $(eventsDiv).show();
            $(eventIdDiv).show("slide", { direction: "left" });
          }                            
        });
        return false;
      });

      //Gestion des modals des evenements
      if(!eventIndex){        
        // $(".titleSearch").offset($(".filterDiv").find(".filterText").offset());
        $(".eventTitleSearch").show();
        $(".eventTitleSearch").keyup(function(){
          console.log($(this).val());
          var titleSearch = $(this).val();
          $("h1.eventTitle").each(function(){
            $elemSearch = $(this).text();
            console.log($elemSearch);
            eventsDiv.show();
            if(fuzzy_match($elemSearch, titleSearch)){
              $(this).parent().show();
            } else{
              $(this).parent().hide();
              console.log($(this).parent());
            }

            if(titleSearch == "" || titleSearch == " "){
              eventsDiv.hide();
            }
          });
        });

        $('#emptyModal').css('overflow-y', 'scroll');
        $('#emptyModal').css('height', '500px');
        $(".md-event").click(function() {
          curMdTrigger = $(this);
          $("#loader").show(); 
          var curHash = $(this).attr("value");
          prevPageTitle = $('title').text();          
          $('#descEvent').html('');
          $('#descEvent').empty();
          $('#disqus_thread').html("");
          $('#disqus_thread').empty();
          $('#emptyModal').load(curHash, function(){
            $("#loader").hide();
          }); 

          $('#descEvent').ajaxStop ( function(){
            var marker = new google.maps.Marker({
              position: map.getCenter(),
              map: map,
              title: newPageTitle
            });
          });

          $("#emptyModal").niceScroll(); // First scrollable DIV 
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
          
          var nice = $("#emptyModal").getNiceScroll();
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
      }

    });
  </script>