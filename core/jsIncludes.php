    <!-- JS Files -->

<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** Dependencies ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
    <!--<script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>   -->

    <!-- lines for Adaptive images -->
    <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
    <!-- test lines for Adaptive images -->
    <!--  <script type="text/javascript">document.cookie='resolution='+Math.max(320,480)+'; expires=; path=/';</script> -->
    <!-- test lines for Adaptive images -->
    <!--<script type="text/javascript">document.cookie='resolution='+Math.max(window.innerWidth,window.innerHeight)+'; expires=; path=/';</script>-->
    <!-- Use this line instaead for retina (and dpi screens) users -->
    <!-- <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script> -->
    <!-- CSS alternative to js -->
    <!-- <style>
        @media only screen and (max-device-width: 479px) {
         html { background-image:url(ai-cookie.php?maxwidth=479); } }
        @media only screen and (min-device-width: 480px) and (max-device-width: 767px) {
         html { background-image:url(ai-cookie.php?maxwidth=767); } }
        @media only screen and (min-device-width: 768px) and (max-device-width: 991px) {
         html { background-image:url(ai-cookie.php?maxwidth=991); } }
        @media only screen and (min-device-width: 992px) and (max-device-width: 1381px) {
         html { background-image:url(ai-cookie.php?maxwidth=1381); } }
        @media only screen and (min-device-width: 1382px) {
         html { background-image:url(ai-cookie.php?maxwidth=unknown); } }
    </style> -->
    <!-- lines for Adaptive images -->
    <script> 
    var isHistoryAvailable, prevPageTitle = "", eventIndex = false, prevIndex = false;
    </script>

    <?php 

    // echo HTML::JS("//code.jquery.com/jquery.min.js");
    echo HTML::JS("//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js");
    echo HTML::JS("//code.jquery.com/jquery-migrate-1.2.1.min.js");
    // echo HTML::JS("//code.jquery.com/ui/1.10.3/jquery-ui.js");
    echo HTML::JS("//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js");
    echo HTML::JS("//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js");
    echo HTML::JS("//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js");

    // echo HTML::JS("jquery/jquery.min");   
    // echo HTML::JS("jquery/jquery-migrate-1.2.1.min");
    // echo HTML::JS("jquery/jquery-ui");
    // echo HTML::JS("modernizr.custom");
    // echo HTML::JS("underscore.min");
    
    echo HTML::JS("//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js");
    // echo HTML::JS("bootstrap/bootstrap.min"); //Bootstrap with modal and dropdown and tooltips and collapse and scrollapsy and tabs (with transitions) only
    // echo HTML::JS("bootstrap/bootstrap.modal"); 
    echo HTML::JS("bootstrap/bootstrap-select.min"); //custom bootstrap for select inputs
    echo HTML::JS("selectivity/selectivity-full.min"); 

    echo HTML::JS("jsFunctions"); 
    echo HTML::JS("jquery.cookie");  
    echo HTML::JS("notification");


    echo HTML::JS("validate/validationEngine");
    echo HTML::JS("validate/languages/jquery.validationEngine-fr");

    echo HTML::JS("main"); 
    echo HTML::JS("jquery.nicescroll.min"); 
    echo HTML::JS("jquery-ias");
    echo HTML::JS("tooltipsy.min");
    echo HTML::JS("datepicker-fr");  //**  
    echo HTML::JS("redactor/langs/fr");  //** 
    echo HTML::JS("redactor/redactor");   //**
    // echo HTML::JS("filter");
    echo HTML::JS("toucheffects");
    // echo HTML::JS("jquery.stringToSlug.min");
    ?>  


<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- **************************************    Layout    ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->

    <?php //echo HTML::JS("View/Layout/Default/search/uisearch"); ?>
    <?php echo HTML::JS("View/Layout/Default/search/search"); ?>

<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- **************************************    Inline    ******************************************* -->
<!-- ************************************** ************ ******************************************* -->
<!-- ************************************** ************ ******************************************* -->

<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<script type="text/javascript">

    // "js/html5shiv.js"
    //"js/html5shiv-printshiv.js" 
    //"js/css3-mediaqueries.js" 
    
    $(document).ready(function() {

        //menus related code
        $('.underline_m').on("hover", function(){
        var quebecWidth = $(this).children('a').width() + 10;
        var elemPos = $(this).children('a').position().left + 5;
        $(this).parent().children('.quebec').css({
                                                  width : quebecWidth,
                                                  left: elemPos
                                                });
        }).on('mouseleave', function(){
            $(this).parent().children('.quebec').css({
                                                  width : 0,
                                                  left: 0
                                                });
        });

        function addMenuSelected(){
            var selectedMenu  = 1;
            if($("#menuSelected").length != 0 && $("#menuSelected").html() != ""){
                $("#menuSelected").hide();
                selectedMenu = $("#menuSelected").text();
            }
            if(exists(menuSelected)){            
                selectedMenu = $("#menuSelected").text();
            }
            var elem = $('.underline_m').children("a[menu-data='"+selectedMenu+"']");
            if(!elem.hasClass("selected")) {
                $('.underline_m').children("a[menu-data='"+selectedMenu+"']").addClass("selected");                
            }
            return $('.underline_m').children("a[menu-data='"+selectedMenu+"']");
        }

        function changeMenuBorderSize(){      
          if($(window).width() < 1190){
            $('.underline_m').children("a.selected").css("border-width", "0px");
          } else {
            var elem = addMenuSelected();
            elem.css("border-width", "5px")
          }
        }

        addMenuSelected();
        changeMenuBorderSize();

        $(window).resize(function() {
          changeMenuBorderSize();
        });
        //end of menu code

        // $('filter').hide();
        // $('filterInput').hide();

        $('#loader').hide();
        $('#loaderWhite').hide();
        if($('.selectpicker').length){
            $('.selectpicker').selectpicker(); 
        }

        $('.hastip').tooltipsy();

        if($( ".datepicker" ).length){
            $( ".datepicker" ).datepicker({
                dateFormat : 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                defaultDate : $(this).val(),
                yearRange: "-100:+10",
            });
        }

        // setTimeout(function(){
        //     $.setNotif();
        //     $("#notifications").css("top", ($(document).scrollTop()+20)+'px');
        // },500);
        $.setNotif(null, function(){
            $("#notifications").css("top", ($(document).scrollTop()+80)+'px');
            $("notif").hide(); 
        });
    });
</script>  

<?php echo $this->Form->JSFlush(); ?>
