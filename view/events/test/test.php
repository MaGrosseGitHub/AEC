<div class="row">
  <div class="span13">

        
    <style type="text/css">

    /*[fmt]0020-000A-3*/
    body{  background:#EEEEEE;  letter-spacing:1px;  font-family:Helvetica; padding:10px;}
    .periods { width : 960px;}
    table{  border-collapse:collapse;} 
    table td{  border:1px solid #A3A3A3;  width:15px;  height:15px;}
    .year{  color:#D90000;  font-size:85px;}
    .relative{  position:relative;}
    .months{}
    .month{  margin-top:12px;}
    .months ul{  list-style:none;  margin:0px;  padding:0px;}
    .months ul li a{  float:left;  margin:-1px;  padding:0px 15px 0px 0px;  color:#888888;  text-decoration:none;  font-size:15px;  font-weight:bold;  text-transform:uppercase;}
    .months ul li a:hover, .months ul li a.active{  color:#D90000;}
    table{  border-collapse:collapse;}
    table td{  border:1px solid #A3A3A3;  width:30px;  height:30px;}
    table td.today{  border:2px solid #D90000;  width:30px;  height:30px;}
    table td.padding{  border:none;}
    table td:hover{  background:#DFDFDF;  cursor:pointer;}
    table th{  font-weight:normal;  color:#A8A8A8;}
    table td .day{  position:absolute;  color:#8C8C8C;  font-weight:bold;  font-size:12pt;}
    table td .events{  position:relative;  width:29px;  height:0px;  margin:-39px 0px 0px;  padding:0px;}
    table td .events li{  width:10px;  height:10px;  float:left;  background:#000;    -moz-border-radius:10px;  -webkit-border-radius:10px;  -khtml-border-radius:10px;  border-radius:10px 10px 10px 10px;  margin-left:6px;  overflow:hidden;  text-indent:-3000px;}
    table td:hover .events{  position:absolute;  left:582px;  top:66px;  width:442px;  list-style:none;  margin:0px;  padding:11px 0px 0px;}
    table td:hover .events li{  height:40px;  line-height:40px;  font-weight:bold;  border-bottom:1px solid #D6D6D6;  padding-left:41px;  text-indent:0;  background:none;  width:500px;}
    table td:hover .events li:first-child{  border-top:1px solid #D6D6D6;}
    table td .daytitle{  display:none;}
    table td:hover .daytitle{  position:absolute;  left:582px;  top:21px;  width:442px;  list-style:none;  margin:0px 0px 0px 16px;  padding:0px;  color:#D90000;  font-size:41px;  display:block;  font-weight:bold;}
    .clear{  clear:both;}
    .red { background: red;}

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
  ?>
<div class="periods all">
              <button class="week">Semaines</button>
              <button class="select prevYear">Previous</button>
              <button class="select nextYear">Next</button>
            <?php foreach ($this->years as $yearKey=>$curYear): ?>
              <div class="months <?php echo $curYear; ?>">
              <div class="year"><?php echo $curYear; ?></div>
                  <ul>
                      <?php foreach ($this->months as $id=>$m): ?>
                           <li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a></li>
                      <?php endforeach; ?>
                  </ul>
              </div>
            <?php endforeach; ?>
            <div class="clear"></div>
            <?php 
            // $dates = current($calendar); 
            foreach ($calendar as $y=>$dates): 
             foreach ($dates as $m=>$days): ?>


               <div class="month relative" id="month<?php echo $m; ?> <?php echo $y; ?>">
               <table>
                   <thead>
                       <tr class = "weekdays">
                           <?php foreach ($this->days as $d): ?>
                                <th><?php echo substr($d,0,3); ?></th>
                           <?php endforeach; ?>
                       </tr>
                   </thead>
                   <tbody>

                       <tr class = "days">
                        <td class = "users">--Users--</td>
                       <?php $end = end($days); 
                       foreach($days as $d=>$w): 
                        ?>
                           <?php $time = strtotime("$year-$m-$d"); ?>
                           <td>
                                <div class="relative">
                                    <div class="day"><?php echo $d; ?></div>
                                </div>
                               <ul class="events">
                                   <?php if(isset($calendar[$time])): 
                                   foreach($calendar[$time] as $e): ?>
                                        <li><?php echo $e; ?></li>
                                   <?php endforeach; endif;  ?>
                               </ul>
                           </td> 
                       <?php 
                       endforeach; ?>
                       </tr>                      
                       
<?php 
                      $users = array();
                      $newEvents = array();
                      $jours = array();
                      for ($i=1; $i <= count($days); $i++) { 
                        $jours[$i] = "<td>i</td>";
                      }
                      
                      $nextMonth = array(); 
                      $newFromDate = "";
                      $newToDate = "";
                      foreach ($events as $k => $v){
                        $newEvents[$v->auteur]['jours'] = $jours; 
                        $newEntry = array(
                            'id' => $v->id, 
                            'description' => $v->description, 
                            'titre' => $v->titre, 
                            'from' => $v->from, 
                            'to' => $v->to
                            );
                        if(date('n', $v->from) != date('n', $v->to) )
                          $newEntry['nextMonth'] = true;
                        $newEvents[$v->auteur]['events'][] = $newEntry;                   
                      }

                        foreach ($newEvents as $user => $event) : 
                       ?>
                       <tr class = "users"> 
                        <td class = "user"><?php echo $user; ?></td>
                        <?php          
                          $interval = false;
                          // $newEvents[$user]['events']['nextMonth'] = "";
                          foreach ($event['events'] as $jour => $eventInfo) { 

                            // debug($eventInfo,$user);
                            $fromMonth = date('n', $eventInfo['from']); 
                            $fromDay = date('d', $eventInfo['from']); 
                            $fromYear = date('Y', $eventInfo['from']); 
                            $toMonth = date('n', $eventInfo['to']); 
                            $toDay = date('d', $eventInfo['to']);
                            $toYear = date('Y', $eventInfo['to']);

                            for ($i=1; $i <= count($days); $i++) { 
                              $time = strtotime("$y-$m-$i");
                              
                              if(isset($eventInfo['nextMonth'])) {
                                $newFromDate = strtotime("01-".($fromMonth+1)."-$y");
                                if($time == $newFromDate)
                                  $interval = true;                                  
                              }                           

                              if($time == $eventInfo['from']) {
                                $interval = true;
                              }

                              if($interval) {                                  
                                $newEvents[$user]["jours"][$i] = '<td class = "red eventId'.$eventInfo['id'].'">0</td>';
                              } 

                              if($time == $eventInfo['to']){
                                $interval = false;
                              }
                              
                            }

                          }

                          for ($s=1; $s <= count($days); $s++) { 
                            echo $newEvents[$user]["jours"][$s];
                          }
                        ?>



                        </tr>
                        <?php endforeach; 
                        ?>
                   </tbody>
               </table>
               </div>
            <?php endforeach; ?>
          <?php endforeach; ?>  
        </div>
        <div class="clear"></div>
  </div>

</div>

<div id="events">
<?php foreach ($events as $user => $curEvent) : 
  ?>
  <div id="eventId<?php echo $curEvent->id; ?>" class = "<?php echo $curEvent->auteur; ?>">

   <h1> <?php echo $curEvent->titre; ?> </h1>
    <br>   
    <p>
    <?php echo $curEvent->description; ?>  
    </p>
  </div>             
 <?php endforeach; ?>
</div>
<div id="test"></div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script type="text/javascript">
        <?php          
          $js_calendar = json_encode($calendar);
          $js_months = json_encode($this->months);
          $js_days = json_encode($this->days);
          echo "var js_calendar = ". $js_calendar . ";\n";
          echo "var js_months = ". $js_months . ";\n";
          echo "var js_days = ". $js_days . ";\n";
        ?>
              
              
        var date = new Date();
        jQuery(function($){

          function htmlTree(type, selector, depth) {
            
            for (var i = 0; i < depth; i++){
              if(type == "parent")
                selector = selector.parent(); 
              else if(type == "child")   
                selector = selector.child()
              else
                return false;
            };
            return selector;
          }

          //Gestion des années              
          $('[class^="months "]').hide();
          var yearsArray = $('[class^="months "]');
          var disabledButton;

          var currentYear = date.getFullYear();
          var curYear = currentYear
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

            var newYear = $('[class^="months '+prevNextYear+'"]');
            var newMonth = $('[id^="month'+curMonth+" "+prevNextYear+'"]');
            
            prevYear.hide();
            prevMonth.hide();
            newYear.show();
            newMonth.show();

            curYear = prevNextYear;

            return false; 
          });

          //Gestion du calendrier des mois
          $(".weekdays").hide();
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

          //Gestion des description des evenements
          var eventsDiv = $("#events");
          var eventId, eventIdDiv;
          $(eventsDiv).hide();
          $('[id^="eventId"]').hide();
          var eventTd = $(".red");
          var curEvent;
          $(eventTd).click(function(){              
            eventId = $(this).attr('class').replace('red ','');
            eventIdDiv = $("#"+eventId);
            if(eventIdDiv != curEvent) {
              $(eventsDiv).show();
              $(curEvent).toggle("slide", { direction: "left" });
              $(eventIdDiv).toggle("slide", { direction: "left" });
              curEvent = eventIdDiv;
            }

            return false;
          });

          //Gestion des evenements utilisateurs

          ///////////////////////////////////////////////////////////////////////

          var curUser;
          $('.user').click(function() {
            // var user = $(this).text();
            // var userDiv = $("."+user);
            // $(eventsDiv).show();
            // if(userDiv != curUser) {
            //   $(curUser).toggle("slide", { direction: "left" });
            //   $(userDiv).toggle("slide", { direction: "left" });
            //   curUser = userDiv;
            // }
            $(".all").hide();            
            $('#test').load('http://localhost/POO3/webroot/events/lookFor/user2');          
            $('[class^="months "]').hide();
            var yearsArray = $('[class^="months "]');
            var disabledButton;

            var currentYear = date.getFullYear();
            var curYear = currentYear
            var curYearDiv = $('[class^="months '+curYear+'"]');
            curYearDiv.show();  
          });

          ///////////////////////////////////////////////////////////////////////
          // $('.week').click(function(){

          //   var tbodyMonths = new Array();
          //   var tbodyWeeks = new Array();
          //   var curMonth;
          //   for (var i = 1; i <= 12; i++) {
          //     curMonth = $('#month'+i+' tbody');
          //     tbodyMonths[i] = curMonth;
          //   }

          //   for (var i = 1; i <= 12; i++) {
          //     curMonth = $('#month'+i+' tbody');
          //     curTd = $('#month'+i+' .days td');
              
          //     var newTbody = "<tbody><tr>";                  
          //     $.each( curTd, function( key, value ) {
          //       var curDay = $(value).text();
          //       if(curDay != "--Users--") {
          //         var curWeekDay = js_calendar['2013'][i][parseInt(curDay)];
          //         if(curDay == 1 && i != 1) {
          //           newTbody += "</tr><tr>"; 
          //           if(curWeekDay != 1) {
          //             newTbody += '<td colspan="'+(curWeekDay-1)+'" class="padding"></td>';
          //           }

          //         }
          //         newTbody += "<td>";
          //         newTbody += $(value).html()
          //         newTbody += "</td>";
          //         if(curWeekDay == 7) {
          //           newTbody += "</tr><tr>"; 
          //         }
          //         // if(key%7 == 0 && key != 0) {
          //         //  newTbody += "</tr><tr>";                    
          //         // }
          //       }
          //     });
          //     newTbody += "</tr></tbody>";   
          //     tbodyWeeks[i] = newTbody;
          //   }

          //   curMonth = $('#month'+current+' tbody');

          //   $(".users").hide();
          //   $(".weekdays").show();
          //   for (var i = 1; i <= 12; i++) {
          //     curMonth = $('#month'+i+' tbody');
          //     curMonth.replaceWith(tbodyWeeks[i]);
          //   }
          // });


        // $('#test').load('http://localhost/POO3/webroot/events/lookFor/user2');

        });

        ///////////////////////////////////////////////////////////////////////////////////

              // curMonth.html("");
              // curMonth.html(tbodyWeeks[current]);

              // console.log($('td'));
              // console.log(curMonth);
              // alert($('#month'+current+' td:eq(7)').text());
              // alert($('#month'+current+' .days').html());
              // curTr = $('tbody .days');
              // curTd = $('tbody td');
              // var newTable = "<tr>";                  
              // $.each( curTd, function( key, value ) {
              //   // alert( key + ": " + value );
              //   if($(value).text() == 1) {
              //    newTable += "</tr><tr>";   
              //   }
              //   newTable += "<td>";
              //   newTable += $(value).html()
              //   newTable += "</td>";
              //   if(key%7 == 0 && key != 0) {
              //    newTable += "</tr><tr>";                    
              //   }
              // });
              // console.log(newTable);
              // $('tbody .days').html("");
              // $('tbody .days').html(newTable);
              // alert("test");
              // alert(typeof $('#month'+current+' td').eq(7))
              // $('<td><span class="jump">Test</span></td>').insertAfter($('#month'+current+' td:eq(7)'));
              // alert(curMonth.html());
              // var curMonth = $('#month'+current+' .jump');
              // $('Test </tr> test').insertAfter(curMonth);
              // curMonth.html("</tr><tr>");
              // alert(curMonth.html());
              // curMonth.show();
              // var saut = "</tr><tr>";
              // td = document.createElement("tr");
                // curMonth.parent().after(saut);
                // $(t).insertAfter(curMonth.parent());
              // $( ".inner" ).after(td);
              // alert(current);

                  // curMonth[2].after( "</td><td>" );
              // for(var i =0; i<curMonth.length; i++) {
              //   if(i%7 == 0 && i != 0) {
              //     console.log(curMonth[i]);
              //     curTd = curMonth[i];
              //     // alert(curTd.parent());
              //     // alert(curTd);
              //     // curTd.after( "</td><td>" );
              //     // $( ".inner" ).after( "</td><td>" );
              //   }
              // }
        </script>

<div class="container">
<h2>Greetings</h2>
<div class="inner">Hello</div>
<div class="inner">Goodbye</div>
<div class="inner2"></div>
</div>