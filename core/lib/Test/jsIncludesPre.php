    <!-- JS Files -->
    <!--<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>   -->

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
    

    echo HTML::JS("jsFunctions"); 
    echo HTML::JS("jquery.cookie");  

    echo HTML::JS("jquery.nicescroll.min"); 
    echo HTML::JS("jquery-ias");   
    echo HTML::JS("filter");
    ?>  
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/html5shiv-printshiv.js"></script>
    <![endif]-->
    
