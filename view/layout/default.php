<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
    <head> 
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
      <meta name="description" content="Paris 8 Ars Electronica Campus Exhibition" />
      <meta name="keywords" content="Paris 8 Ars Electronica Campus Exhibition" />
      <meta name="author" content="Paris 8 AEC" />
      <link rel="shortcut icon" href="../favicon.ico">
      <title><?php echo isset($GLOBALS['title_for_layout'])?$GLOBALS['title_for_layout']:'AEC'; ?></title> 
      <?php require CORE.DS.'cssIncludes.php'; ?>
      <?php require CORE.DS.'jsIncludes.php'; ?>      
    </head>
    <body> 
<?php /*
      <!-- <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner" style = "display : none;"> -->
      <header class="navbar navbar-default navbar-static-top navbar-inverse" role="banner" >
        <!-- <div class="navbar navbar-fixed-top" role="navigation" style="position:static">  -->
        <div class="container"> 
          <div class="navbar-header">
              <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class = "navbar-brand ct-logo" href="<?php echo Router::url('posts/index'); ?>" rel = "home">
                <img src="css/View/Layout/Default/img/logo.png" alt="Brand">
              </a>
          </div> 
          <nav class="collapse navbar-collapse bs-navbar-collapse ct-nav-wrapper" role="navigation">
              <ul class="nav navbar-nav" style = "width : 100%"> 
                <?php $pagesMenu = $this->request('Pages','getMenu'); ?>
                <?php if(Language::$curLang == "fr") : ?>
                  <?php foreach($pagesMenu as $p): ?>
                      <!-- <li><a href="<?php echo Router::url('pages/view/id:'.$p->id.'/slug:'.$p->slug); ?>" title="<?php echo $p->title_FR; ?>"><?php echo $p->title_FR; ?></a></li>  -->
                  <?php endforeach; ?>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">Exhibition</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">About</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">Partenaires</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">Infos pratiques</a></li>
                  <!-- <li><a href="<?php echo Router::url('contact/index'); ?>">Contact</a></li> -->
                  <!-- <li><a href="<?php echo Router::url('cockpit/'); ?>">Admin</a></li> -->
                  <!-- <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li> -->
                <?php else : ?>
                  <?php foreach($pagesMenu as $p): ?>
                     <!--  <li>
                      <a href="<?php echo Router::url('pages/view/id:'.$p->id.'/slug:'.$p->slug); ?>" title="<?php echo $p->title_EN; ?>"><?php echo $p->title_EN; ?></a>
                      </li> --> 
                  <?php endforeach; ?>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">Exhibition</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">About</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">Partners</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">useful Infos</a></li>
                  <!-- <li><a href="<?php echo Router::url('contact/index'); ?>">Contact</a></li> -->
                  <!-- <li><a href="<?php echo Router::url('cockpit/'); ?>">Admin</a></li> -->
                  <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li>
                <?php endif; ?>
              </ul>

      <!-- <div class="main clearfix">
        <div class="column">
        </div>
      </div> -->

          <ul class="nav navbar-nav navbar-right" style = "width : 250px;">
              <div id="searchInput" style="display : inline;">              
                <!-- <div id="sb-search" class="sb-search" style="display : inline;">
                  <form style="display : inline;">
                    <input id = "inputsearch" class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
                    <input class="sb-search-submit" type="submit" value="">
                    <span class="sb-icon-search"></span>
                  </form>
                </div> -->
                <!-- <div id="searchDiv"> <?php echo $this->Form->input('search',''); ?> -->
                  <div id="searchResults"></div>
              </div>          
              <!-- </div> -->
            <ul class="ct-connect">
              <li><a class="ct-icon-feed" href="http://feeds2.feedburner.com/tympanus"><span>Rss Feed</span></a></li>
              <li><a class="ct-icon-mail" href="http://feedburner.google.com/fb/a/mailverify?uri=tympanus&amp;loc=en_US"><span>Email Updates</span></a></li>
              <li><a class="ct-icon-twitter" href="http://www.twitter.com/codrops"><span>Codrops on Twitter</span></a></li>
              <li><a class="ct-icon-facebook" href="http://www.facebook.com/pages/Codrops/159107397912"><span>Codrops on Facebook</span></a></li>
              <li><a class="ct-icon-google-plus" href="https://plus.google.com/101095823814290637419" rel="publisher"><span>Codrops on Google+</span></a></li>
            </ul>
          </ul><!--/ct-header-items-right-->
          </nav>
        </div> 
      </header>

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
<br>
<br>
    <header>
      <nav class="navbar navbar-default navbar-inverse">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="#">Brand</a> -->
            <a class = "navbar-brand" href="<?php echo Router::url('posts/index'); ?>" rel = "home">
              <img src="css/View/Layout/Default/img/logo.png" alt="Brand">
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding : 20px 0 ;">
            <ul class="nav navbar-nav" style="padding : 0 20px;">
              <?php $pagesMenu = $this->request('Pages','getMenu'); ?>
              <?php if(Language::$curLang == "fr") : ?>
                <?php foreach($pagesMenu as $p): ?>
                  <!-- <li>
                    <a href="<?php echo Router::url('pages/view/id:'.$p->id.'/slug:'.$p->slug); ?>" title="<?php echo $p->title_FR; ?>"><?php echo $p->title_FR; ?></a>
                  </li>  -->
                <?php endforeach; ?>
                <li><a href="<?php echo Router::url('posts/index'); ?>">Exhibition</a></li>
                <li><a href="<?php echo Router::url('posts/index'); ?>">About</a></li>
                <li><a href="<?php echo Router::url('posts/index'); ?>">Partenaires</a></li>
                <li><a href="<?php echo Router::url('posts/index'); ?>">Infos pratiques</a></li>
                <!-- <li><a href="<?php echo Router::url('contact/index'); ?>">Contact</a></li> -->
                <!-- <li><a href="<?php echo Router::url('cockpit/'); ?>">Admin</a></li> -->
                <!-- <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li> -->
              <?php else : ?>
                <?php foreach($pagesMenu as $p): ?>
                  <!--  <li>
                    <a href="<?php echo Router::url('pages/view/id:'.$p->id.'/slug:'.$p->slug); ?>" title="<?php echo $p->title_EN; ?>"><?php echo $p->title_EN; ?></a>
                  </li> --> 
                <?php endforeach; ?>
                <li><a href="<?php echo Router::url('posts/index'); ?>">Exhibition</a></li>
                <li><a href="<?php echo Router::url('posts/index'); ?>">About</a></li>
                <li><a href="<?php echo Router::url('posts/index'); ?>">Partners</a></li>
                <li><a href="<?php echo Router::url('posts/index'); ?>">useful Infos</a></li>
                <!-- <li><a href="<?php echo Router::url('contact/index'); ?>">Contact</a></li> -->
                <!-- <li><a href="<?php echo Router::url('cockpit/'); ?>">Admin</a></li> -->
                <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li>
              <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right ct-connect" style="margin-left : -50px;">              
              <li><a class="ct-icon-feed" href="http://feeds2.feedburner.com/tympanus"><span>Rss Feed</span></a></li>
              <li><a class="ct-icon-mail" href="http://feedburner.google.com/fb/a/mailverify?uri=tympanus&amp;loc=en_US"><span>Email Updates</span></a></li>
              <li><a class="ct-icon-twitter" href="http://www.twitter.com/codrops"><span>Codrops on Twitter</span></a></li>
              <li><a class="ct-icon-facebook" href="http://www.facebook.com/pages/Codrops/159107397912"><span>Codrops on Facebook</span></a></li>
              <li><a class="ct-icon-google-plus" href="https://plus.google.com/101095823814290637419" rel="publisher"><span>Codrops on Google+</span></a></li>
              <li style = "margin-left : 30px;">
                <!-- <form class="navbar-form" role="search">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form> -->

                <div id="searchInput">              
                  <div id="sb-search" class="sb-search" style="display : inline;">
                    <form style="display : inline;">
                      <input id = "inputsearch" class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
                      <input class="sb-search-submit" type="submit" value="">
                      <span class="sb-icon-search"></span>
                    </form>
                  </div>
                  <!-- <div id="searchDiv"> <?php echo $this->Form->input('search',''); ?> -->
                    <div id="searchResults"></div>
                </div>  
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header> */ ?>

      <?php echo HTML::CSS("View/Layout/default/main7807"); ?>

      <header class="ct-header">
        <div class="ct-inner ct-cf">

            
            <h1 class="ct-branding">
              <a class="ct-logo" href="<?php echo Router::url('posts/index'); ?>" rel="home">Home</a>
            </h1>
          
          <div class="ct-nav-wrapper">
            <nav class="ct-nav-main">
              <ul>
                <?php $pagesMenu = $this->request('Pages','getMenu'); ?>
                <?php if(Language::$curLang == "fr") : ?>
                  <?php foreach($pagesMenu as $p): ?>
                    <!-- <li>
                      <a href="<?php echo Router::url('pages/view/id:'.$p->id.'/slug:'.$p->slug); ?>" title="<?php echo $p->title_FR; ?>"><?php echo $p->title_FR; ?></a>
                    </li>  -->
                  <?php endforeach; ?>
                  <li class = "n1"><a href="<?php echo Router::url('posts/index'); ?>">Exhibition</a></li>
                  <li class = "n2"><a class = "selected" href="<?php echo Router::url('posts/index'); ?>">About</a></li>
                  <li class = "n3"><a href="<?php echo Router::url('posts/index'); ?>">Partenaires</a></li>
                  <li class = "n4"><a href="<?php echo Router::url('posts/index'); ?>">Infos pratiques</a></li>
                  <!-- <li><a href="<?php echo Router::url('contact/index'); ?>">Contact</a></li> -->
                  <!-- <li><a href="<?php echo Router::url('cockpit/'); ?>">Admin</a></li> -->
                  <!-- <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li> -->
                <?php else : ?>
                  <?php foreach($pagesMenu as $p): ?>
                    <!--  <li>
                      <a href="<?php echo Router::url('pages/view/id:'.$p->id.'/slug:'.$p->slug); ?>" title="<?php echo $p->title_EN; ?>"><?php echo $p->title_EN; ?></a>
                    </li> --> 
                  <?php endforeach; ?>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">Exhibition</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">About</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">Partners</a></li>
                  <li><a href="<?php echo Router::url('posts/index'); ?>">useful Infos</a></li>
                  <!-- <li><a href="<?php echo Router::url('contact/index'); ?>">Contact</a></li> -->
                  <!-- <li><a href="<?php echo Router::url('cockpit/'); ?>">Admin</a></li> -->
                  <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li>
                <?php endif; ?>
                <li class="quebec">&nbsp;</li>
              </ul>
            </nav>
          </div>

          <div class="ct-header-items-right ct-cf">
            <div class="ct-search" id="ct-search" >
              <form method="get" id="searchform" action="http://tympanus.net/codrops/">
                <div class="ct-search-input-wrap">
                  <input class="ct-search-input" placeholder="Search..." type="text" value="" name="s" id="inputsearch"/>
                </div>
                <input type="hidden" name="search-type" value="posts" />
                <input class="ct-search-submit" type="submit" id="go" value=""><span class="ct-icon-search"></span>
              </form>     
              <!-- <div id="searchDiv"> <?php echo $this->Form->input('search',''); ?> -->
                <div id="searchResults"></div>
            </div>
            <!-- <div id="searchInput">         
            </div>  -->
            <ul class="ct-connect">
              <li><a class="ct-icon-feed" href="http://feeds2.feedburner.com/tympanus"><span>Rss Feed</span></a></li>
              <li><a class="ct-icon-mail" href="http://feedburner.google.com/fb/a/mailverify?uri=tympanus&amp;loc=en_US"><span>Email Updates</span></a></li>
              <li><a class="ct-icon-twitter" href="http://www.twitter.com/codrops"><span>Codrops on Twitter</span></a></li>
              <li><a class="ct-icon-facebook" href="http://www.facebook.com/pages/Codrops/159107397912"><span>Codrops on Facebook</span></a></li>
              <li><a class="ct-icon-google-plus" href="https://plus.google.com/101095823814290637419" rel="publisher"><span>Codrops on Google+</span></a></li>
                <li><a class="ct-icon-github" href="https://github.com/codrops"><span>Codrops on Github</span></a></li>
            </ul>
          </div><!--/ct-header-items-right-->

        </div><!-- ct-inner -->
      </header>

      <!-- <div class="col-md-3">
        <div id="sb-search" class="sb-search" style="display : inline;">
          <form style="display : inline;">
            <input id = "inputsearch" class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
            <input class="sb-search-submit" type="submit" value="">
            <span class="sb-icon-search"></span>
          </form>
        </div>
      </div> -->

      <div class="container" style="padding-top:80px;" id = "container">
      <!-- <div> -->
        <?php $this->Notification->flash(); ?>
        <div id="loader"> <?php echo HTML::getImg('loading.gif',true, false, 'style = "opacity : 1;"'); ?> </div>
        <div id="loaderWhite"> <?php echo HTML::getImg('loaderWhite.gif',true, false, 'style = "opacity : 1;"'); ?> </div>
      	<?php echo $content_for_layout; ?>
      </div>

  
      <?php //echo HTML::JS("modal/classie"); ?>
      <?php //echo HTML::JS("mlpushmenu"); ?>
      <?php //echo HTML::CSS("icons"); ?>
    </body> 
</html>
