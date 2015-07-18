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
    <span style ="min-height : 100%, position : relative">
      <header class="ct-header">
        <div class="ct-inner ct-cf">  

          <h1 class="ct-branding">
            <a class="ct-logo" href="<?php echo Router::url('posts/index'); ?>" rel="home">Home</a>
          </h1>

          <div class="ct-nav-wrapper">
            <nav class="ct-nav-main">
              <ul>
                <?php $pagesMenu = $this->request('Pages','getMenu'); ?>
                <?php foreach($pagesMenu as $p): ?>
                  <!-- <li>
                    <a href="<?php echo Router::url('pages/view/id:'.$p->id.'/slug:'.$p->slug); ?>" title="<?php echo $p->title_FR; ?>"><?php echo $p->title_FR; ?></a>
                  </li>  -->
                <?php endforeach; ?>
                <?php if(Language::$curLang == "fr") : ?>
                  <li class = "underline_m"><a href="<?php echo Router::url('posts/index'); ?>" menu-data = "1">Exhibition</a></li>
                  <li class = "underline_m"><a href="<?php echo Router::url('posts/index'); ?>" menu-data = "2">A propos</a></li>
                  <li class = "underline_m"><a href="<?php echo Router::url('posts/index'); ?>" menu-data = "3">Partenaires</a></li>
                  <li class = "underline_m"><a href="<?php echo Router::url('posts/index'); ?>" menu-data = "4">Infos pratiques</a></li>
                <?php else : ?>
                  <li class = "underline_m"><a href="<?php echo Router::url('posts/index'); ?>" menu-data = "1">Exhibition</a></li>
                  <li class = "underline_m"><a href="<?php echo Router::url('posts/index'); ?>" menu-data = "2">About</a></li>
                  <li class = "underline_m"><a href="<?php echo Router::url('posts/index'); ?>" menu-data = "3">Partners</a></li>
                  <li class = "underline_m"><a href="<?php echo Router::url('posts/index'); ?>" menu-data = "4">useful Infos</a></li>
                <?php endif; ?>
                <!-- <li><a href="<?php echo Router::url('contact/index'); ?>">Contact</a></li> -->
                <!-- <li><a href="<?php echo Router::url('cockpit/'); ?>">Admin</a></li> -->
                <!-- <li><a class = "logout" href="<?php echo Router::url('lookFor/users/logout'); ?>">Se déconnecter</a></li> -->
                <li class="quebec">&nbsp;</li>
              </ul>
            </nav>
          </div>

          <div class="ct-header-items-right ct-cf">
            <div class="ct-search" id="ct-search" >
              <form method="get" id="searchform" action="">
                <div class="ct-search-input-wrap single-search">
                  <input id = "searchSlider" id="inputsearch" class="ct-search-input" placeholder="Search..." type="text" value="" name="s" />
                  <span class="twitter-typeahead">
                    <input  id="inputsearch" class="ct-search-input" placeholder="Search..." type="text" value="" name="s"/>
                    <input class="tt-hint" autocomplete="off" spellcheck="off" disabled="" type="text">
                    <input dir="auto" spellcheck="false" autocomplete="off" class="ct-search-input tt-query" placeholder="Search..." value="" name="s" id="s" type="text">
                    <span class="ct-ted">ted</span>
                    <span class="tt-dropdown-menu">
                      <div class="tt-dataset-search" style = "max-height : 220px; overflow : hidden">
                        <span  id="searchResults" class="tt-suggestions">
                        </span>
                      </div>
                    </span>
                  </span>
                </div>
                <input type="hidden" name="search-type" value="posts" />
                <input class="ct-search-submit" type="submit" id="go" value=""><span class="ct-icon-search"></span>
              </form>     
              <!-- <div id="searchResults"></div>   -->
            </div>
            
            <ul class="ct-connect">
              <li><a class="ct-icon-feed" href="http://feeds2.feedburner.com/tympanus"><span>AEC Paris 8 Rss Feed</span></a></li>
              <li><a class="ct-icon-twitter" href="http://www.twitter.com/codrops"><span>AEC Paris 8 on Twitter</span></a></li>
              <li><a class="ct-icon-facebook" href="http://www.facebook.com/pages/Codrops/159107397912"><span>AEC Paris 8 on Facebook</span></a></li>
              <li><a class="ct-icon-mail" href="http://feedburner.google.com/fb/a/mailverify?uri=tympanus&amp;loc=en_US"><span>contact</span></a></li>
              <li><a class="ct-icon-google-plus" href="https://plus.google.com/101095823814290637419" rel="publisher"><span>Codrops on Google+</span></a></li>
              <li><a class="ct-icon-github" href="https://github.com/codrops"><span>Codrops on Github</span></a></li>
            </ul>
          </div><!--/ct-header-items-right-->

        </div><!-- ct-inner -->
      </header>

      <div class="container" style="padding-top:80px;" id = "container">
      <!-- <div> -->
        <?php $this->Notification->flash(); ?>
        <div id="loader"> <?php echo HTML::getImg('loading.gif',true, false, 'style = "opacity : 1;"'); ?> </div>
        <div id="loaderWhite"> <?php echo HTML::getImg('loaderWhite.gif',true, false, 'style = "opacity : 1;"'); ?> </div>
      	<?php echo $content_for_layout; ?>
      </div>
      </div>
      </div>
      </div>
      
      <div class="footer-separation"></div>

      <footer class="ct-footer">
        
        <div class="ct-inner ct-cf">
          <nav class="ct-cf">          
            <ul class = "ct-fmenu">
              <?php if(Language::$curLang == "fr") : ?>
                <li><a href="<?php echo Router::url('contact/index'); ?>" >Contact</a></li>
                <li>
                  <div class="morph-button morph-button-modal morph-button-modal-1 morph-button-fixed">
                    <button class = "morphButton" type="button">Mentions légales</button>
                    <div class="morph-content mbt1">
                      <div>
                        <div class="content-style-text">
                          <span class="icon icon-close">Close the dialog</span>
                          <h2>Terms &amp; Conditions</h2>
                          <p>Pea horseradish azuki bean lettuce avocado asparagus okra. Kohlrabi radish okra azuki bean corn fava bean mustard tigernut juccama green bean celtuce collard greens avocado quandong <strong>fennel gumbo</strong> black-eyed pea. Grape silver beet watercress potato tigernut corn groundnut. Chickweed okra pea winter purslane coriander yarrow sweet pepper radish garlic brussels sprout groundnut summer purslane earthnut pea <strong>tomato spring onion</strong> azuki bean gourd.</p>
                          <p><input id="terms" type="checkbox" /><label for="terms">I accept the terms &amp; conditions.</label></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="morph-button morph-button-modal morph-button-modal-1 morph-button-fixed">
                    <button class = "morphButton" type="button">Credits</button>
                    <div class="morph-content mbt2">
                      <div>
                        <div class="content-style-text">
                          <span class="icon icon-close">Close the dialog</span>
                          <h2>Terms &amp; Conditions</h2>
                          <p>Pea horseradish azuki bean lettuce avocado asparagus okra. Kohlrabi radish okra azuki bean corn fava bean mustard tigernut juccama green bean celtuce collard greens avocado quandong <strong>fennel gumbo</strong> black-eyed pea. Grape silver beet watercress potato tigernut corn groundnut. Chickweed okra pea winter purslane coriander yarrow sweet pepper radish garlic brussels sprout groundnut summer purslane earthnut pea <strong>tomato spring onion</strong> azuki bean gourd.</p>
                          <p><input id="terms" type="checkbox" /><label for="terms">I accept the terms &amp; conditions.</label></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="morph-button morph-button-modal morph-button-modal-1 morph-button-fixed">
                    <button class = "morphButton" type="button">Licence</button>
                    <div class="morph-content mbt3">
                      <div>
                        <div class="content-style-text">
                          <span class="icon icon-close">Close the dialog</span>
                          <h2>Terms &amp; Conditions</h2>
                          <p>Pea horseradish azuki bean lettuce avocado asparagus okra. Kohlrabi radish okra azuki bean corn fava bean mustard tigernut juccama green bean celtuce collard greens avocado quandong <strong>fennel gumbo</strong> black-eyed pea. Grape silver beet watercress potato tigernut corn groundnut. Chickweed okra pea winter purslane coriander yarrow sweet pepper radish garlic brussels sprout groundnut summer purslane earthnut pea <strong>tomato spring onion</strong> azuki bean gourd.</p>
                          <p><input id="terms" type="checkbox" /><label for="terms">I accept the terms &amp; conditions.</label></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php else : ?>
                <li><a href="<?php echo Router::url('contact/index'); ?>" >Contact</a></li>
                <li>
                  <div class="morph-button morph-button-modal morph-button-modal-1 morph-button-fixed">
                    <button class = "morphButton" type="button">Terms & conditions</button>
                    <div class="morph-content mbt1">
                      <div>
                        <div class="content-style-text">
                          <span class="icon icon-close">Close the dialog</span>
                          <h2>Terms &amp; Conditions</h2>
                          <p>Pea horseradish azuki bean lettuce avocado asparagus okra. Kohlrabi radish okra azuki bean corn fava bean mustard tigernut juccama green bean celtuce collard greens avocado quandong <strong>fennel gumbo</strong> black-eyed pea. Grape silver beet watercress potato tigernut corn groundnut. Chickweed okra pea winter purslane coriander yarrow sweet pepper radish garlic brussels sprout groundnut summer purslane earthnut pea <strong>tomato spring onion</strong> azuki bean gourd.</p>
                          <p><input id="terms" type="checkbox" /><label for="terms">I accept the terms &amp; conditions.</label></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="morph-button morph-button-modal morph-button-modal-1 morph-button-fixed">
                    <button class = "morphButton" type="button">Credits</button>
                    <div class="morph-content mbt2">
                      <div>
                        <div class="content-style-text">
                          <span class="icon icon-close">Close the dialog</span>
                          <h2>Terms &amp; Conditions</h2>
                          <p>Pea horseradish azuki bean lettuce avocado asparagus okra. Kohlrabi radish okra azuki bean corn fava bean mustard tigernut juccama green bean celtuce collard greens avocado quandong <strong>fennel gumbo</strong> black-eyed pea. Grape silver beet watercress potato tigernut corn groundnut. Chickweed okra pea winter purslane coriander yarrow sweet pepper radish garlic brussels sprout groundnut summer purslane earthnut pea <strong>tomato spring onion</strong> azuki bean gourd.</p>
                          <p><input id="terms" type="checkbox" /><label for="terms">I accept the terms &amp; conditions.</label></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="morph-button morph-button-modal morph-button-modal-1 morph-button-fixed">
                    <button class = "morphButton" type="button">License</button>
                    <div class="morph-content mbt3">
                      <div>
                        <div class="content-style-text">
                          <span class="icon icon-close">Close the dialog</span>
                          <h2>Terms &amp; Conditions</h2>
                          <p>Pea horseradish azuki bean lettuce avocado asparagus okra. Kohlrabi radish okra azuki bean corn fava bean mustard tigernut juccama green bean celtuce collard greens avocado quandong <strong>fennel gumbo</strong> black-eyed pea. Grape silver beet watercress potato tigernut corn groundnut. Chickweed okra pea winter purslane coriander yarrow sweet pepper radish garlic brussels sprout groundnut summer purslane earthnut pea <strong>tomato spring onion</strong> azuki bean gourd.</p>
                          <p><input id="terms" type="checkbox" /><label for="terms">I accept the terms &amp; conditions.</label></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endif; ?>
            </ul>
          </nav>    

          <span class = "ct-span">    
            <ul class="ct-connect">
              <li><a class="ct-icon-feed" href="http://feeds2.feedburner.com/tympanus"><span>AEC Paris 8 Rss Feed</span></a></li>
              <li><a class="ct-icon-twitter" href="http://www.twitter.com/codrops"><span>AEC Paris 8 on Twitter</span></a></li>
              <li><a class="ct-icon-facebook" href="http://www.facebook.com/pages/Codrops/159107397912"><span>AEC Paris 8 on Facebook</span></a></li>
              <li><a class="ct-icon-mail" href="http://feedburner.google.com/fb/a/mailverify?uri=tympanus&amp;loc=en_US"><span>Email Updates</span></a></li>
              <li><a class="ct-icon-google-plus" href="https://plus.google.com/101095823814290637419" rel="publisher"><span>Codrops on Google+</span></a></li>
            </ul>  
          </span>    
          <div class="ct-items ct-cf">
            <div class="ct-item ct-copyright">
              <span>&copy; Campus Exhbition 2015 by</span> 
              <a href="http://www.univ-paris8.fr/<?php echo (Language::$curLang == 'fr')?'':'/en'; ?>" title="Paris 8">Paris 8</a>
            </div>
          </div>
        </div>
      </footer>
  </span>
      <?php //echo HTML::JS("modal/classie"); ?>
      <?php //echo HTML::JS("mlpushmenu"); ?>
      <?php //echo HTML::CSS("icons"); ?>
    </body> 
</html>
