<style>

@font-face {
  font-family: "iconvault";
  src: url(<?php echo Router::webroot("css/glyphs/ForecastFont/iconvault_forecastfont.eot"); ?>);
  src: url(<?php echo Router::webroot("css/glyphs/ForecastFont/iconvault_forecastfont.eot?#iefix"); ?>) format("embedded-opentype"),
       url(<?php echo Router::webroot("css/glyphs/ForecastFont/iconvault_forecastfont.woff"); ?>) format("woff"),
       url(<?php echo Router::webroot("css/glyphs/ForecastFont/iconvault_forecastfont.ttf"); ?>) format("truetype"),
       url(<?php echo Router::webroot("css/glyphs/ForecastFont/iconvault_forecastfont.svg#iconvault"); ?>) format("svg");
  font-weight: normal;
  font-style: normal;
}     

[class^="icon-"],
[class*=" icon-"] {
  font-family: 'iconvault';
  font-weight: normal;
  font-style: normal;
  text-decoration: inherit;
  -webkit-font-smoothing: antialiased;
  font-size: 6em;

}

@media only screen and (min-width: 479px) and (max-width: 678px){
[class^="icon-"],
[class*=" icon-"] {
  font-family: 'iconvault';
  font-weight: normal;
  font-style: normal;
  text-decoration: inherit;
  -webkit-font-smoothing: antialiased;}
}


/* -----BaseCloud----- */

    .basecloud:before  {
    font-family: 'iconvault';
    font-size:6em;
    content: '\f105';
    position:absolute;
    color:rgb(204, 204, 204);
    }
    
    
    
/* -----windyraincloud----- */

    .windyraincloud:before  {
    font-family: 'iconvault';
    font-size:6em;
    content: '\f111';
    position:absolute;
    color:rgb(204, 204, 204);
    }
    
/* -----Windysnowcloud----- */

    .windysnowcloud:before  {
    font-family: 'iconvault';
    font-size:6em;
    content: '\f109';
    position:absolute;
    color:rgb(204, 204, 204);
    }

/* -----Basethundercloud----- */

    .basethundercloud:before  {
    font-family: 'iconvault';
    font-size:6em;
    content: '\f105';
    position:absolute;
    color:#000;

    }


/* -----Thunder----- */

    .icon-thunder::before  {
    content: "\f114";
    position:absolute;
    color:rgb(255, 165, 0);
    }

/* -----Sunny----- */

    .icon-sunny::after {
    content: "\f101";
    color:rgb(255, 165, 0);
    position: absolute;
    }


/* -----Drizzle----- */

    .icon-drizzle::before  {
    content: "\f10a";
    color: #82b2e4;
    position: absolute;
}

/* -----Hail----- */

    .icon-hail::before {
    content: "\f10f";
    position:absolute;
    color:rgb(204, 204, 204);}

/* -----Showers----- */

    .icon-showers::before  {
    content: "\f104";
    position:absolute;
    color:#82b2e4;
}

/* -----Rainy----- */

    .icon-rainy::before {
    content: "\f107";
    position:absolute;
    color:#4681c3;
    }

/* -----Snowy----- */

    .icon-snowy::before  {
    content: "\f10b";
    position:absolute;
    color:#acd3f3;
    }

/* -----Frosty----- */

    .icon-frosty::before {
    content: "\f102";
    position:absolute;
    color:#85d8f7;
    }

/* -----Windy----- */

    .icon-windy::before  {
    content: "\f115";
    position:absolute;
    color:rgb(204, 204, 204);
    }

/* -----WindyRain----- */

    .icon-windyrain::before {
    content: "\f10e";
    position:absolute;
    color:#acd3f3;
    }

/* -----WindySnow----- */

    .icon-windysnow::before {
    content: "\f103";
    position:absolute;
    color:#acd3f3;
    }

/* -----Sleet----- */

    .icon-sleet::before  {
    content: "\f10c";
    position:absolute;
    color:#acd3f3;
    }

/* -----Moon----- */

    .icon-moon::after {
    content: "\f10d";
    color:rgb(255, 165, 0);
    position: absolute;
    }

/* -----Night----- */

    .icon-night::after {
    content: "\f100";
    position:absolute;
    color:rgb(255, 165, 0);
    }


/* -----Sun----- */

    .icon-sun::after {
    content: "\f113";
    color:rgb(255, 165, 0);
    position: absolute;
    }

/* -----Cloud----- */

    .icon-cloud::after {
    content: "\f106";
    color:rgb(204, 204, 204);
    position: absolute;
    }


/* -----Sunrise----- */

    .icon-sunrise:before  {
    content: '\f112';
    color:rgb(255, 165, 0);
    position: absolute;
    }

/* -----Sunset----- */

    .icon-sunset:before  {
    content: '\f110';
    color:#f96f23;
    position: absolute;
    }

/* -----Mist----- */

    .icon-mist:before  {
    content: '\f108';
    color:rgb(204, 204, 204);
    position: absolute;
    }


</style>

<style>
  .noHover{
    color:rgb(204, 204, 204);
  }
  .noHover:after{
    color:inherit;
  }
  .noHover:before{
    color:inherit;
  }

  #moutain {
      position : relative;
  }
  #moutainStep {
      height : 43px;
      position : absolute;
      width : 129px;
      border : 1px solid rgba(255,0,0,0.5);
  }

  #moutainStep:hover {
      background : red;
      opacity : 0.3;
  }

  #moutain .active {
      background : red;
      opacity : 0.5;
  }

  .icoTop {
      top : 0;
  }
  .icoMid{
      top : 43px;
  }
  .icoBottom{
      top : 86px;
  }

  #moutainHide{
    height : 129px;
    position : absolute;
    top : 0px;
    width : 129px;
    background : white;
    opacity : 0.5;
    display : none;
  }
</style>
<div id="weather">
  <p>Pour fermer cette fenêtre, il suffit de fermer la fenêtre d'information du marqueur sur la carte</p>
  <div id="WeatherArrows">
    <button class="arrowLeft">left</button>
    <button class="arrowRight">right</button>
  </div>
  <div id="today">
    <div class="weatherControls">
      <div id="moutainArrows">
        <button class="arrowUp">Up</button>
        <button class="arrowDown">Down</button>
      </div>
      <div id="moutain">    
          <!-- <img src="mountain.svg" onerror="this.onerror=null; this.src='image.png'" width = "129px"> -->
          <!-- getImg($url,$css = null,$custom = null, $options = null, $notExistImg = false) -->
          <?php echo HTML::getImg('mountain.svg', true, null, ' onerror="this.onerror=null; this.src=\'image.png\'" width = "129px"'); ?>
          <div id = "moutainStep" class="icoTop active"></div>
          <div id = "moutainStep" class="icoMid"></div>
          <div id = "moutainStep" class="icoBottom"></div>
          <div id = "moutainHide"></div>
      </div>
      <div class="summary">
        <div class="sumIcon"><?php echo $weatherSummary->weatherCode; ?></div>
        <div class="sumTemp"><?php echo $weatherSummary->temp_C; ?>°C</div>
        <div class="sumRain"><?php echo $weatherSummary->precipMM; ?>mm</div>
        <div class="sumWindSpeed"><?php echo $weatherSummary->windspeedKmph; ?>Km/h</div>
        <div class="sumWindDir"><?php echo $weatherSummary->winddir16Point; ?></div>
        <div class="sumCloudCov"><?php echo $weatherSummary->cloudcover; ?> DS</div>
        <div class="sumHumidity"><?php echo $weatherSummary->humidity; ?> DS</div>
        <div class="sumPressure"><?php echo $weatherSummary->pressure; ?> DS</div>
        <div class="sumVisibility"><?php echo $weatherSummary->visibility; ?> DS</div>
      </div>
    </div>
    <hr>
  </div>
  <div class="detailed weatherSlider">
    <?php for ($v=0; $v < 3; $v++) { 
      $moutainStep = $moutainSteps[$v];
    ?> 
      <div class="<?php echo $moutainSteps[$v]; ?>">
        <table>            
          <?php for ($i=0; $i < 10; $i++) { 
          ?>
            <tr class="<?php echo $detailedClassArr[$i]; ?>">
              <?php for ($k=0; $k < 8; $k++) { 
              ?>
                <?php if (in_array($detailedClassArr[$i], $marineComponents)): ?>
                  <td><?php echo $weatherMarine[$k]->$detailedInfoArr[$i]; ?></td>
                <?php elseif(in_array($detailedClassArr[$i], $skiComponents)): 
                  $moutainStepData = $weatherSki[$k]->$moutainStep;
                  $moutainStepData = reset($moutainStepData);
                ?>
                   <td><?php echo $moutainStepData->$detailedInfoArr[$i]; ?></td>
                <?php endif ?>
              <?php
              } ?>
            </tr>    
          <?php
          } ?>
          <?php  ?>
        </table>
        <hr>
      </div>
    <?php
    } ?>
    <?php  ?>
  </div>
  <div id="nextDays" class="weatherSlider">
    <table>
      <?php for ($i=0; $i < 7; $i++) { 
      ?>
        <tr class="<?php echo $nextDaysClassArr[$i]; ?>">
          <?php for ($k=0; $k < 5; $k++) { 
          ?>
            <?php if ($nextDaysClassArr[$i] != "weekDay" && $nextDaysClassArr[$i] != "days"): ?>
              <td><?php echo $weatherNextDays[$k]->$nextDaysInfoArr[$i]; ?></td>
            <?php elseif($nextDaysClassArr[$i] == "days"): ?>
              <td><?php echo date('d/m', strtotime($weatherNextDays[$k]->$nextDaysInfoArr[$i])); ?></td>
            <?php elseif($nextDaysClassArr[$i] == "weekDay"): ?>
              <td><?php echo substr($weekDays[(date('N', strtotime($weatherNextDays[$k]->$nextDaysInfoArr[$i])) -1)], 0, 3).'.'; ?></td>
            <?php endif ?>
          <?php
          } ?>
        </tr>    
      <?php
      } ?>
    </table>
  </div>
</div>

<script>  
  jQuery(function($){

    //hide night or day icons depending on time of day
    //organize icons and hovers
    $('#today .summary').find('div.sumIcon span.iconNight, span.icon-moon').hide();
    $('#nextDays .nextDaysIcon').find('span.iconNight, span.icon-moon').hide();
    $('#nextDays .nextDaysIcon').find('span.iconNight, span.icon-moon').hide();
    $('#weather .detailed').find('span.weatherTime').each(function(){
      var timeIndex = $(this).closest('tr').find('td').index($(this).parent());
      var iconRow = $(this).closest('tr');
      var iconTd = iconRow.prev('tr.icons').find('td:eq(' + timeIndex + ')');
      if($(this).text() >= 19 || $(this).text() == "01"){
        iconTd.find('span.iconDay, span.icon-sun').hide();
      } else {
        iconTd.find('span.iconNight, span.icon-moon').hide();
      }
      iconTd.css('font-size','8px');
      iconTd.find('span').each(function(){
        $(this).addClass('noHover');
        $(this).hover(function(){
          $(this).removeClass('noHover');
        }, function(){
          $(this).addClass('noHover');
        })
      });
    });
    $('#nextDays .nextDaysIcon').css('font-size','8px');
    $('#nextDays .nextDaysIcon').find('span').each(function(){
        $(this).addClass('noHover');
        $(this).hover(function(){
          $(this).removeClass('noHover');
        }, function(){
          $(this).addClass('noHover');
        });
    });
    $('#today .summary').find('div.sumIcon span').addClass('noHover');
    $('#today .summary').find('div.sumIcon').hover(function(){
      $(this).find('span').removeClass('noHover');
    }, function(){
      $(this).find('span').addClass('noHover');
    });

    //hide and create slider for detailed forcast    
    $('#weather .detailed').find('div.bottom, div.mid').hide();
    curDetailWeather = $('#today .icoTop');
    $('#today #moutainStep').click(function(){
      curDetailWeather.removeClass('active');
      curDiv = curDetailWeather.attr('class').split(" ")[0].replace("ico", "").toLowerCase();
      curDiv = $('#weather .detailed').find('div.'+curDiv).hide();
      curDetailWeather = $(this);
      curDetailWeather.addClass('active');
      weatherDiv = $(this).attr('class').split(" ")[0].replace("ico", "").toLowerCase();
      weatherDiv = $('#weather .detailed').find('div.'+weatherDiv).show();

      if(curDetailWeather.prev('div#moutainStep').length) {
        $("#today #moutainArrows").find('button.arrowUp').removeAttr('disabled');
      } else {
        $("#today #moutainArrows").find('button.arrowUp').attr('disabled','disabled');
      }
      if(curDetailWeather.next('div#moutainStep').length) {
        $("#today #moutainArrows").find('button.arrowDown').removeAttr('disabled');
      } else {
        $("#today #moutainArrows").find('button.arrowDown').attr('disabled','disabled');
      }
    });

    $("#today #moutainArrows").find('button.arrowUp').attr('disabled','disabled');
    $("#today #moutainArrows").find('button').click(function(){
      if($(this).hasClass('arrowUp') && curDetailWeather.prev('div#moutainStep').length){
        curDetailWeather.prev('div#moutainStep').trigger('click');
      }
      if($(this).hasClass('arrowDown') && curDetailWeather.next('div#moutainStep').length){
        curDetailWeather.next('div#moutainStep').trigger('click');
      }
    });

    //hide and create slider for next days' forcasts
    $("#weather #nextDays").hide();
    $("#weather #WeatherArrows").find('button.arrowLeft').attr('disabled','disabled');
    curDisplayedWeather = $("#weather div.detailed");
    $("#weather #WeatherArrows").find('button').click(function(){
      if(curDisplayedWeather.hasClass('detailed')){
        $("#today #moutainArrows").hide();
        $("#today #moutainHide").show();
      } else {
        $("#today #moutainArrows").show();
        $("#today #moutainHide").hide();
      }
      if($(this).hasClass('arrowLeft') && curDisplayedWeather.prev('div.weatherSlider').length){
        curDisplayedWeather.hide();
        curDisplayedWeather = curDisplayedWeather.prev('div.weatherSlider');
        curDisplayedWeather.show();
      }
      if($(this).hasClass('arrowRight') && curDisplayedWeather.next('div.weatherSlider').length){
        curDisplayedWeather.hide();
        curDisplayedWeather = curDisplayedWeather.next('div.weatherSlider');
        curDisplayedWeather.show();
      }
      
      if(curDisplayedWeather.prev('div.weatherSlider').length) {
        $("#weather #WeatherArrows").find('button.arrowLeft').removeAttr('disabled');
      } else {
        $("#weather #WeatherArrows").find('button.arrowLeft').attr('disabled','disabled');
      }
      if(curDisplayedWeather.next('div.weatherSlider').length) {
        $("#weather #WeatherArrows").find('button.arrowRight').removeAttr('disabled');
      } else {
        $("#weather #WeatherArrows").find('button.arrowRight').attr('disabled','disabled');
      }
    });

    //hide date and show it on hover over week day
    $('div#nextDays tr.days').hide();
    curDayValue = "";

    //hack to correct weird behavior with trigger('hover') in other function
    $('div#nextDays tr.weekDay').find('td').click(function(){
      curDayValue = $(this).text();
      weekDayIndex = $(this).parent().find('td').index($(this));
      var dayTd = $(this).parent().next('tr.days').find('td:eq(' + weekDayIndex + ')');
      $(this).text(dayTd.text());
    }).dblclick(function(){
      $(this).text(curDayValue);
    });
    //end of hack

    $('div#nextDays tr.weekDay').find('td').hover(function(){
      curDayValue = $(this).text();
      weekDayIndex = $(this).parent().find('td').index($(this));
      var dayTd = $(this).parent().next('tr.days').find('td:eq(' + weekDayIndex + ')');
      $(this).text(dayTd.text());
    }, function(){
      $(this).text(curDayValue);
    });


    //add color to temperature rows
    $('div.detailed tr.temp').find('td').each(function(){
      var temp = $(this).text();
      $(this).css('background', (temperatureColor(temp)) );
    });

    $('div#nextDays tr.temperatureMin, tr.temperatureMax').find('td').each(function(){
      var temp = $(this).text();
      $(this).css('background', (temperatureColor(temp)) );
    });

    function temperatureColor(temp) {        
      temp = parseInt(temp);
      // Map the temperature to a 0-1 range
      var a = (temp + 50)/100;
      a = (a < 0) ? 0 : ((a > 1) ? 1 : a);
      
      // Scrunch the green/cyan range in the middle
      var sign = (a < .5) ? -1 : 1;
      if(temp <= 7){
          a = sign * Math.pow(2 * Math.abs(a - .5), .75)/2 + .3;
      } else {
          a = sign * Math.pow(2.2 * Math.abs(a - .5), .6)/2 + .57;
      }
      
      // Linear interpolation between the cold and hot
      var h0 = 259;
      var h1 = 12;
      var h = (h0) * (1 - a) + (h1) * (a);
      
      return pusher.color("hsv", h, 75, 90).hex6();
    };

    //trigger hover over rows
    $('div#nextDays tr').find('td').hover(function(){
      tdIndex = $(this).parent().find('td').index($(this));
      $(this).parents('table').find('tr.weekDay td:eq('+tdIndex+')').trigger('click');
      $(this).parents('table').find('tr.nextDaysIcon td:eq('+tdIndex+')').find('span').each(function(spanKey, spanValue){
        $(spanValue).triggerHandler('mouseover');
      });
    }, function(){
      $(this).parents('table').find('tr.weekDay td:eq('+tdIndex+')').triggerHandler('dblclick');
      $(this).parents('table').find('tr.nextDaysIcon td:eq('+tdIndex+')').find('span').each(function(spanKey, spanValue){
        $(spanValue).triggerHandler('mouseleave');
      });
    });

    $('div.detailed tr').find('td').hover(function(){
      tdIndex = $(this).parent().find('td').index($(this));
      $(this).parents('table').find('tr.icons td:eq('+tdIndex+')').find('span').each(function(spanKey, spanValue){
        $(spanValue).triggerHandler('mouseover');
      });
    }, function(){
      $(this).parents('table').find('tr.icons td:eq('+tdIndex+')').find('span').each(function(spanKey, spanValue){
        $(spanValue).triggerHandler('mouseleave');
      });
    });

    $('div#today').hover(function(){
      $(this).find('div.sumIcon').find('span').removeClass('noHover');
    }, function(){
      $(this).find('div.sumIcon').find('span').addClass('noHover');
    });

  });
</script>