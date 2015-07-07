<div class="row">
	<div class="span13">

        
		<style type="text/css">

		/*[fmt]0020-000A-3*/
		/*body{  background:#EEEEEE;  letter-spacing:1px;  font-family:Helvetica; padding:10px;}
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
    .red { background: red;}*/

		</style>
    
	<?php 
        // debug($calendar, "calendar"); 
        // debug($event, "event"); 
        // debug($calendar, "calendar"); 
        // debug($curYear);
        // debug($year);
        // $timestamp = strtotime('07-09-2013');
        // echo $timestamp;
  ?>

<div id="trouver"><?php echo $user; ?></div>
<div class="periods">
            <!-- <div class="year"><?php echo $curYear; ?></div> -->
            <div class="months">
                <ul>
                    <?php foreach ($this->months as $id=>$m): ?>
                         <li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="clear"></div>
            <?php $dates = current($calendar); ?>
            <?php foreach ($dates as $m=>$days): ?>
               <div class="month relative" id="month<?php echo $m; ?>">
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
                           <?php $time = strtotime("$year-$m-$d"); ?>
                           <?php if($d == 1 && $w != 1): ?>
                                <td colspan="<?php echo $w-1; ?>" class="padding"></td>
                           <?php endif; ?>
                           <td<?php if($time == strtotime(date('Y-m-d'))): ?> class="today" <?php endif; ?>>
                                <div class="relative">
                                    <div class="day"><?php echo $d; ?></div>
                                </div>
                               <div class="daytitle">
                                   <?php echo $this->days[$w-1]; ?> <?php echo $d; ?>  <?php echo $this->months[$m-1]; ?>
                               </div>
                               <!-- <ul class="events">
                                   <?php if(isset($events[$time])): foreach($events[$time] as $e): ?>
                                        <li><?php echo $e; ?></li>
                                   <?php endforeach; endif;  ?>
                               </ul> -->
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
        </div>
        <div class="clear"></div>

  </div>

</div>
        <div class="clear"></div>
  </div>

</div>
        <script type="text/javascript">
        var date = new Date();
            jQuery(function($){

              var eventsDiv = $("#events");
              $(eventsDiv).hide();
              $('[id^="eventId"]').hide();

              $(".weekdays").hide();
              $('.month').hide();
              var current = date.getMonth()+1;
              $('.month:eq('+(current-1)+')').show();
              $('.months a:eq('+(current-1)+')').addClass('active');
              $('.months a').click(function(){
                var month = $(this).attr('id').replace('linkMonth','');
                if(month != current){
                    $('#month'+current).toggle("slide", { direction: "left" });
                    $('#month'+month).delay(400).toggle("slide", { direction: "right" });
                    $('.months a').removeClass('active'); 
                    $('.months a#linkMonth'+month).addClass('active'); 
                    current = month;
                }
                return false; 
              });

              var eventTd = $(".red");
              var curEvent;
              $(eventTd).click(function(){              
                var eventId = $(this).attr('class').replace('red ','');
                var eventIdDiv = $("#"+eventId);
                $(eventsDiv).show();
                if(eventIdDiv != curEvent) {
                  $(curEvent).toggle("slide", { direction: "left" });
                  $(eventIdDiv).toggle("slide", { direction: "left" });
                  curEvent = eventIdDiv;
                }
              });

        </script>