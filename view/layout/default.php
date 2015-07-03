<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
    <head> 
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
      <title><?php echo isset($GLOBALS['title_for_layout'])?$GLOBALS['title_for_layout']:'AEC'; ?></title> 
      <?php require CORE.DS.'cssIncludes.php'; ?>
      <?php require CORE.DS.'jsIncludes.php'; ?>      
    </head>
    <body> 

      <!-- <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner" style = "display : none;"> -->
      <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner" >
        <!-- <div class="navbar navbar-fixed-top" role="navigation" style="position:static">  -->
        <div class="container"> 
          <div class="navbar-header">
              <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class = "navbar-brand" href="#">Mon site</a>
          </div> 
          <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
              <ul class="nav navbar-nav"> 
                <?php $pagesMenu = $this->request('Pages','getMenu'); ?>
                <?php foreach($pagesMenu as $p): ?>
                    <li><a href="<?php echo Router::url('pages/view/id:'.$p->id.'/slug:'.$p->slug); ?>" title="<?php echo $p->title_FR; ?>"><?php echo $p->title_FR; ?></a></li> 
                <?php endforeach; ?>
                <li><a href="<?php echo Router::url('posts/index'); ?>">Actualité</a></li>
                <!-- <li><a href="<?php echo Router::url('events/index'); ?>">Events</a></li> -->
                <!-- <li><a href="<?php echo Router::url('medias/index'); ?>">Galerie</a></li> -->
                <!-- <li><a href="<?php echo Router::url('maps/index'); ?>">Maps</a></li> -->
                <li><a href="<?php echo Router::url('contact/index'); ?>">Contact</a></li>
                <li><a href="<?php echo Router::url('cockpit/'); ?>">Admin</a></li>
                <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li>
              </ul>
              <div id="searchInput">
                <div id="searchDiv"> <?php echo $this->Form->input('search',''); ?>
                <div id="searchResults"></div>
                <!-- <select name="searchFilter" id="searchFilter">
                  <option value="all">all</option>
                  <option value="media">Media</option>
                  <option value="post">Posts</option>
                  <option value="event">Events</option>
                  <option value="maps">Maps</option>
                  <option value="user">users</option>
                </select>  -->    </div>          
              </div>
          </nav>
        </div> 
      </header>
      <div class="container" style="padding-top:80px;" id = "container">
        <?php $this->Notification->flash(); ?>
        <div id="loader"> <?php echo HTML::getImg('loading.gif',true, false, 'style = "opacity : 1;"'); ?> </div>
        <div id="loaderWhite"> <?php echo HTML::getImg('loaderWhite.gif',true, false, 'style = "opacity : 1;"'); ?> </div>
      	<?php echo $content_for_layout; ?>
      </div>

  
      <?php //echo HTML::JS("modal/classie"); ?>
      <?php //echo HTML::JS("mlpushmenu"); ?>
      <?php //echo HTML::CSS("icons"); ?>
      <style>
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
      <?php //echo $this->loadMenu("admin"); ?>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
       <br>
    </body> 
</html>
