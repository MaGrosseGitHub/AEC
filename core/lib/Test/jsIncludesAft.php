    <?php 
    
    echo HTML::JS("http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js");
    // echo HTML::JS("bootstrap/bootstrap.min"); //Bootstrap with modal and dropdown and tooltips and collapse and scrollapsy and tabs (with transitions) only
    // echo HTML::JS("bootstrap/bootstrap.modal"); 
    echo HTML::JS("bootstrap/bootstrap-select.min"); //custom bootstrap for select inputs

    echo HTML::JS("notification");


    echo HTML::JS("validate/validationEngine");
    echo HTML::JS("validate/languages/jquery.validationEngine-fr");

    echo HTML::JS("main"); 
    echo HTML::JS("datepicker-fr");    
    echo HTML::JS("redactor/langs/fr");    
    echo HTML::JS("redactor/redactor");  
    ?>  
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/html5shiv-printshiv.js"></script>
    <![endif]-->
    <script type="text/javascript">
        $(document).ready(function() {

            $('.selectpicker').selectpicker(); 

            $( ".datepicker" ).datepicker({
                dateFormat : 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                minDate : 0,
                defaultDate : $(this).val()
            });

            setTimeout(function(){
                $.setNotif();
                $("#notifications").css("top", ($(document).scrollTop()+20)+'px');
            },500);
            $("notif").hide(); 
        });
    </script>  

<?php echo $this->Form->JSFlush(); ?>
