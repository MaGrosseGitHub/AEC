<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
    <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <title><?php echo isset($GLOBALS['title_for_layout'])?'Administration : '.$GLOBALS['title_for_layout']:'Administration'; ?></title> 
   <?php //require CORE.DS.'scriptsInclude.php'; ?>
    <?php require CORE.DS.'cssIncludes.php'; ?>
    </head> 
    <body>

    <style>
      body {
        background-color: #ecf0f1;
      }
    </style>     
      <!-- <?php //debug($_SESSION); ?> -->
      <!-- navbar navbar-inverse navbar-fixed-top bs-docs-nav -->
      <!-- role="navigation" -->

    <!-- <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/icons.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />      
    <?php 
      //$menu = $this->menu;
      //echo $menu;
    ?> -->

      <!-- <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
        <div class="container">
          <div class="navbar-header">
            <a href="../" class="navbar-brand">Bootstrap</a>
          </div>
          <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
            </ul>
          </nav>
        </div>
      </header> -->
     

        <div class="navbar navbar-fixed-top" role="navigation" style="position:static"> 
          <div class="navbar-inner">
              <a class = "navbar-brand" href="<?php echo Router::url('admin/posts/index'); ?>">Administration</a>
              <ul class="nav navbar-nav"> 
                <li><a href="<?php echo Router::url('admin/posts/index'); ?>">Articles</a></li>
                <li><a href="<?php echo Router::url('admin/authors/index'); ?>">Auteurs</a></li>
                <li><a href="<?php echo Router::url('admin/organizations/index'); ?>">Organisations</a></li>
                <li><a href="<?php echo Router::url('admin/categories/index'); ?>">Catégories</a></li>
                <li><a href="<?php echo Router::url('admin/events/index'); ?>">Events</a></li>
                <li><a href="<?php echo Router::url('admin/pages/index'); ?>">Pages</a></li>
                <li><a href="<?php echo Router::url('admin/contact/index'); ?>">Contact</a></li>
                <li class = "active"><a href="<?php echo Router::url('admin/medias/index'); ?>" class = "active">Galerie</a></li>
                <li><a href="<?php echo Router::url(); ?>">Voir le site</a></li>
                <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li>
              </ul>
          </div> 
        </div> 
 
        <div class="container" style="padding-top:60px;">
          <?php echo $this->Notification->flash(); ?>
          <div id="loader"> <?php echo HTML::getImg('loading.gif',true); ?> </div>
        	<?php echo $content_for_layout; ?>
        </div>
         
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
    </body> 
    
    <!--<script src="js/classie.js"></script>
    <script src="js/mlpushmenu.js"></script>
    <script>
      new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
    </script>-->

    <?php require CORE.DS.'jsIncludes.php'; ?>
</html>