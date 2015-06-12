﻿	<!-- CSS Files -->
    <!-- <link rel="stylesheet" href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css"> -->
    <?php 

    echo HTML::CSS("normalize"); 
    echo HTML::CSS("component"); 
    echo HTML::CSS("Flick/Flick");

    ?>
    <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap-1.2.0.min.css"> -->
    <!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.css">-->
    <?php     
    // echo HTML::CSS("bootstrap/bootstrap.min");
    // echo HTML::CSS("bootstrap/bootstrap_flat"); 
    // echo HTML::CSS("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"); 
    
    echo HTML::CSS("bootstrap/flatstrap.min");
    echo HTML::CSS("bootstrap/bootstrap-select.min");
    echo HTML::CSS("notification");
    echo HTML::CSS("redactor/css/redactor", true,"JS"); 


    echo HTML::CSS("validate/validationEngine.jquery"); 
    echo HTML::CSS("validate/template"); 
    echo HTML::CSS("validate/customMessages"); 
    ?>

<style type="text/css">
    .ui-datepicker { font-size: 9pt !important; }
</style>

<style type="text/css">
/* RESET */
*, *:after, *:before { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
body, html { font-size: 100%; padding: 0; margin: 0;}

/* Clearfix hack by Nicolas Gallagher: http://nicolasgallagher.com/micro-clearfix-hack/ */
.clearfix:before, .clearfix:after { content: " "; display: table; }
.clearfix:after { clear: both; }
</style>

<style>
    /* Importing Fonts */
    @import url(http://fonts.googleapis.com/css?family=Lato:300,400,700);
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:300,400,700);
    @import url(http://fonts.googleapis.com/css?family=Pacifico:400);
    @import url(http://fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans:400,300,600);

    body {
        font-family: 'Lato', Calibri, Arial, sans-serif;
        background: #f9f9f9;
        color: #333;
    }

    /* Header Style */
    /*.codrops-top {
        line-height: 24px;
        font-size: 11px;
        background: #fff;
        background: rgba(255, 255, 255, 0.5);
        text-transform: uppercase;
        z-index: 9999;
        position: relative;
        box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
    }

    .codrops-top a {
        padding: 0px 10px;
        letter-spacing: 1px;
        color: #333;
        display: inline-block;
    }

    .codrops-top a:hover {
        background: rgba(255,255,255,0.8);
        color: #000;
    }

    .codrops-top span.right {
        float: right;
    }

    .codrops-top span.right a {
        float: left;
        display: block;
    }*/
</style>

<style>
    .tooltipsy {
        border-radius: 5px; 
        border: 1px solid #cccccc;
        background: #ededed;
        color: #666666;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 16px;
        padding: 8px 10px;
    }
    .tooltipsy:after {
        top: 100%;
        left: 50%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-color: rgba(237, 237, 237, 0);
        border-top-color: #ededed;
        border-width: 10px;
        margin-left: -10px;
    }
</style>

<style>
  
    .buttonUp {
        background-image: url(<?php echo HTML::getImg('mCSB_buttons.png', true, true); ?>);
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
        top : -20px;
        width: 16px;
    }
    .buttonDown {
        background-image: url(<?php echo HTML::getImg('mCSB_buttons.png', true, true); ?>);
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


    label.error {
        /* remove the next line when you have trouble in IE6 with labels in list */
        /*color : #e51b00*/
        position:relative;
        display : block;
        margin:1em 0 3em;
        color:#FFF;
        background:#D71B00; /* default background for browsers without gradient support */
        /* css3 */
        background:-webkit-linear-gradient(#D71B00 43%, #ba1600 100%);
        background:-moz-linear-gradient(#D71B00 43%, #ba1600 100%);
        background:-o-linear-gradient(#D71B00 43%, #ba1600 100%);
        background:linear-gradient(#D71B00 43%, #ba1600 100%);

        border: 1px solid #9f1300;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        box-shadow: rgba(0, 0, 0, 0.65) 0 2px 7px,
                            inset rgba(255, 60, 60, 1) 0 1px 0px;
        color: #f3f3f3;
        font-family: 'helvetica neue', arial, sans-serif;
        font-style : italic;
        font-weight: bold;
        font-size: 0.9em;
        width : auto;
        -webkit-font-smoothing: antialiased;
        /*line-height: 0.7em;   */
        padding: 3px 10px 2px 10px;
        text-shadow: #901100 0 -1px 0;
        top: -7px;
        left : -250px;
    }


    label.error:after {
        position: absolute;
        display: block;
        content: "";  
        border-color: transparent transparent #D71B00 transparent;
        border-style: solid;
        border-width: 10px;
        height:0;
        width:0;
        position:absolute;
        top:-19px;
        left:1em;
    }
</style>

<!-- CSS pour NivoSlider -->
<style type="text/css">
    .nivoSlider{position:relative}
    .nivoSlider img{position:absolute;top:0px;left:0px}
    .nivoSlider a.nivo-imageLink{position:absolute;top:0px;left:0px;width:100%;height:100%;border:0;padding:0;margin:0;z-index:6;display:none}
    .nivo-slice{display:block;position:absolute;z-index:5;height:100%}
    .nivo-box{display:block;position:absolute;z-index:5}
    .nivo-caption{position:absolute;left:0px;bottom:0px;background:#000;color:#fff;opacity:0.8;width:100%;z-index:8}
    .nivo-caption p{padding:5px;margin:0}
    .nivo-caption a{display:inline !important}
    .nivo-html-caption{display:none}
    .nivo-directionNav a{position:absolute;top:45%;z-index:9;cursor:pointer}
    .nivo-prevNav{left:0px}
    .nivo-nextNav{right:0px}
    .nivo-controlNav {display : none;} /*//////////////////////////////////////////////////////////////////////////////////////*/
    .nivo-controlNav a{position:relative;z-index:9;cursor:pointer}
    .nivo-controlNav a.active{font-weight:bold}

    .nivo-controlNav a{width:7px;height:7px;display:inline-block;background:url(<?php echo Router::webroot("css/img/sprite.png"); ?>) -7px -6px no-repeat;text-indent:3000px;margin-left:10px;-moz-transition-duration:0s;-webkit-transition-duration:0s;-o-transition-duration:0s;transition-duration:0s}
    .nivo-controlNav a:hover, .nivo-controlNav a.active{background-position:0px -6px}
</style>

<style>
    
.checked {
  color : green;
}

.unchecked {
  color : red;
}
</style>