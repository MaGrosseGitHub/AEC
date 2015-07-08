<!-- CSS Files -->

<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** Dependencies ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
    <?php 

    // echo HTML::CSS("normalize"); 
    echo HTML::CSS("normalize_update"); 
    // echo HTML::CSS("component"); //CSS used by the medias page
    // echo HTML::CSS("Flick/Flick");

    ?>
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="//twitter.github.com/bootstrap/assets/css/bootstrap-1.2.0.min.css"> -->
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/flick/jquery-ui.css">-->
    <?php     
    // echo HTML::CSS("bootstrap/bootstrap.min");
    // echo HTML::CSS("bootstrap/bootstrap_flat"); 
    // echo HTML::CSS("//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"); 
    
    echo HTML::CSS("bootstrap/flatstrap.updated.min");
    
    echo HTML::CSS("bootstrap/bootstrap-select.min");
    echo HTML::CSS("selectivity/selectivity-full.min");

    echo HTML::CSS("notification");
    echo HTML::CSS("redactor/css/redactor", true,"JS"); 


    echo HTML::CSS("validate/validationEngine.jquery"); 
    echo HTML::CSS("validate/template"); 
    echo HTML::CSS("validate/customMessages"); 
    ?>

<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- **************************************     Layout   ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->

<?php echo HTML::CSS("View/Layout/Default/main"); ?>
<?php echo HTML::CSS("View/Layout/default/menu"); ?>

<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- **************************************    Inline    ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<style type="text/css">

/* RESET */
*, *:after, *:before { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
body, html { font-size: 100%; padding: 0; margin: 0;}

/* Clearfix hack by Nicolas Gallagher: //nicolasgallagher.com/micro-clearfix-hack/ */
.clearfix:before, .clearfix:after { content: " "; display: table; }
.clearfix:after { clear: both; }

/* Importing Fonts */
@import url(//fonts.googleapis.com/css?family=Lato:300,400,700);
@import url(//fonts.googleapis.com/css?family=Open+Sans:300,400,700);
@import url(//fonts.googleapis.com/css?family=Pacifico:400);
@import url(//fonts.googleapis.com/css?family=Merriweather:400,700|Open+Sans:400,300,600);

body {
    font-family: 'Lato', Calibri, Arial, sans-serif;
    background: #f9f9f9; /* #F1F4F9*/
    color: #333;
}

.ui-datepicker { 
    font-size: 9pt !important; 
}

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
    
.checked {
  color : green;
}

.unchecked {
  color : red;
}

.required:after { 
    color: #d00;
    content: "*";
    position: absolute;
    margin-right: 8px;
    top:12px;
    right : 15px;
    font-family: 'Glyphicons Halflings';
    font-weight: normal;
    font-size: 14px; 
}

#triggerUpperMenu1 {
  position : absolute;
  left : 0;
  top : 300px;
}
#triggerUpperMenu2 {
  position : absolute;
  left : 0;
  top : 330px;
}
</style>