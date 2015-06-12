    <!-- JS Files -->
    <!--<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>   -->
    <script> 
    var isHistoryAvailable, prevPageTitle = "", eventIndex = false, prevIndex = false;
    </script>
    <?php 

    echo HTML::JS("http://code.jquery.com/jquery.min.js");
    echo HTML::JS("http://code.jquery.com/jquery-migrate-1.2.1.min.js");
    echo HTML::JS("http://code.jquery.com/ui/1.10.3/jquery-ui.js");
    echo HTML::JS("http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js");
    echo HTML::JS("http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js");

    // echo HTML::JS("jquery/jquery.min");   
    // echo HTML::JS("jquery/jquery-migrate-1.2.1.min");
    // echo HTML::JS("jquery/jquery-ui");
    // echo HTML::JS("modernizr.custom");
    // echo HTML::JS("underscore.min");
    
    echo HTML::JS("http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js");
    // echo HTML::JS("bootstrap/bootstrap.min"); //Bootstrap with modal and dropdown and tooltips and collapse and scrollapsy and tabs (with transitions) only
    // echo HTML::JS("bootstrap/bootstrap.modal"); 
    echo HTML::JS("bootstrap/bootstrap-select.min"); //custom bootstrap for select inputs

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
    echo HTML::JS("filter");
    echo HTML::JS("toucheffects");
    // echo HTML::JS("jquery.stringToSlug.min");
    ?>  

    <script>
        // "js/html5shiv.js"
        //"js/html5shiv-printshiv.js" 
        //"js/css3-mediaqueries.js" 
    </script>

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <script type="text/javascript">
        $(document).ready(function() {

            $('filter').hide();
            $('filterInput').hide();

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
                    minDate : 0,
                    defaultDate : $(this).val()
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
