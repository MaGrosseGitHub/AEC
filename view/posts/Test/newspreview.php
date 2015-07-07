<div class="page-header">
	<h1>Editer un article</h1>
</div>

<form id = "form" action="<?php echo Router::url('cockpitInc/posts/edit/'.$id); ?>" method="post" enctype="multipart/form-data">
	<?php 
    echo $this->Form->input('name','Titre');
    echo $this->Form->input('file','Image',array('type'=>'fileImg'));
    echo $this->Form->input('category_id','Catégorie',array('options' => $categories, 'class'=>'selectpicker', 'listInvert' => true));
    echo $this->Form->input('created','Date de publication',array('type' =>'datepicker', 'class'=>'timestamp', 'dateSkip' => true)); 
    echo $this->Form->input('id','hidden');
    // echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'xxlarge wysiwyg validate[required,funcCall[checkTextArea]]','rows'=>5));
    echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'redactor','rows'=>5));
    
    echo $this->Form->input('online','En ligne',array('type'=>'checkbox')); 
    $this->Form->JSCheck("form");
   ?>

   <?php /*

   // $test = "Friday saw the launch of the PlayStation 4 in the U.K., and The Sun's notorious Page 3 treated blokes there to a new model—one much less curvy than usual.";
   // debug(strlen($test));
   // $test2 = "Welcome to the portion of our Black Friday coverage dedicated entirely to gaming. We'll be diving deeper into Black Friday gaming discounts here than in our main Black Friday deal guide, but of course we encourage you check out both. We'll be updating this constantly, and as always we encourage you to follow us on";
   // debug(strlen($test2));
   // $test3 = "For ages, Kotaku's Luke Plunkett has taunted me with pictures of Hot Toys figures, the most spectacular sixth-scale, highly-articulated, true-to-life (where applicable) toys available. Now I've gotten my hands on one — the Iron Man Mark XXI Midas Armor sold by Sideshow Collectibles, and I may have been better off without";
   // debug(strlen($test3));
   function unicode_trim ($str) {
    return preg_replace('/^[\pZ|\pC]+([\PZ|\PC]*)[\pZ|\pC]+$/u', '$1', $str);
}
   $test4 = "first-ever 3 D fighting game hit arcades around the world. As you might imagine, it was massively popular. To mark the occasion, Sega has unveil
        ed a 20th anniversary website whe
        re they promise to periodically post news and content related to the series";
   debug(trim($test4, ".\r\n"));
   $test5 = "<p><b><i><strike>Lorem ipsum <img src = 'test.png' alt = '' />Velit <iframe src='http://www.w3schools.com'>test de l'iframe</iframe>labore velit <ul>
  <li>Coffee</li>
  <li>Tea</li>
  <li>Milk</li>
</ul> et tempor ad est cupidatat in non dolore aliqua anim nisi tempor voluptate Ut magna magna laboris voluptate qui dolore Duis esse sed nisi ad Duis id Duis sed dolor sed in sit nostrud nostrud reprehenderit officia dolor aliqExcepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt inua officia sunt aute incididunt aliqua eiusmod sed in eiusmod dolore tempor laborum reprehenderit veniam culpa consectetur dolore magna do Excepteur consequat aute pariatur enim dolor officia nulla culpa adipisicing dolor in enim qui exercitation in cupidatat anim sint in in laboris pariatur dolore occaecat dolore ullamco non labore deserunt occaecat Ut amet et elit nisi velit ex magna in tempor qui Ut adipisicing qui in cupidatat cillum reprehenderit ea consequat mollit in laboris aliqua eiusmod in reprehenderit pariatur id dolor qui qui occaecat occaecat nostrud quis in ut in nostrud fugiat non minim pariatur aliquip ut deserunt irure sunt in.</strike></i></b><br>
</p>";
   // debug(strlen($test5));
   // debug(strlen(strip_tags($test5)));
   $test7 = $test5;
  //  $test5 = strip_tags($test5);
  //  $test55 = substr($test5, 0, 325);
  //  debug("all ==> ".$test55);
  //  debug(strlen($test55));
  //  $test552 = substr($test55, 225);
  //  debug("100 char ==> ".$test552);
  //  debug(strlen($test552));
  //  // debug(strpos(substr(strip_tags($test5), 225, 325), " ", 1));
  //  $test6 = strrpos($test552, ' ');
  //  debug($test6);
  //  debug("new ==> ".substr($test552, 0, $test6));

  $length = 600; //modify for desired width
  if (strlen($test5) <= $length) {
     $test5 = $test5; //do nothing
  } else {
     $test5 = substr($test5, 0, strpos(wordwrap($test5, $length), "\n"));
  }

  // debug(strip_tags($test5));

    // $test72 = preg_replace('/<p>[^<]+<\/p>/i', '', $test7);
    // debug($test72);
    
  // $string = 'lorem ipsum<p class="wp-caption-text">Remove this text</p> test test'; 
  // $pattern = '#(.*<p .*>)(.*)(<\/p>.*)#'; 
  // $replacement = '$1'; 
  // debug(preg_replace($pattern, $replacement, $string));
  // 
  //  

  $test5 = trim($test5);
  debug($test5);
  // $string = preg_replace("/<img[^>]+\>/i", "", $string); 
  $string = preg_replace("#<(img|iframe)[^>]+(\>(?:[^>]+)</\iframe)*+\>#i", "", $test5); 
  // $string2 = substr_count($string, '<i>');
  // debug($string2);
  // 
  function closetags($html) {
    preg_match_all('#<(?!meta|img|br|hr|i|b|p|li|ul|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#isU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
} 
// $string = preg_replace("/^[\s\t]*[\r\n]+|[\r\n]+\Z/misU", "", $string);
$string = trim($string);


// echo (closetags($string));
debug(closetags($string));
  // debug($string);
  
  /*
  $tags = array('img', 'iframe');
   $text = preg_replace('#<(' . implode( '|', $tags) . ')(?:[^>]+)?>.*?</\1>#s', '', $test7); 
  $text = preg_replace('#<(' . implode( '|', $tags) . ')(?:[^>]+)?>.*?</\1>#s', '', $test7);
 /* debug('#<(' . implode( '|', $tags) . ')(?:[^>]+)?>.*?</\1>#s');
  /* #<(img|iframe)(?:[^>]+)?>.*?#s 
  // debug($text);

  $tags_to_strip = Array("img", "iframe"); 
  foreach ($tags_to_strip as $tag)  
  { 
    $test7 = preg_replace("#<\/?" . $tag . "(.|\s)*?>#","$2",$test7); 
    /*debug("#<\/?" . $tag . "(.|\s)*?>#");
    /* #<\/?img(.|\s)*?># 
    /* #<\/?iframe(.|\s)*?>#
  /* #<img(?:[^>]+)?>.*?#s

  /* #<(img|iframe)(?:[^>]+)?>.*?</\1>#s 
  }

*/
    // debug(substr($test7, 0, 325));

    ?>

  <br>
	<div class="actions">
		<input type="submit" class="btn primary" value="Envoyer">
	</div>
</form>

<!--
<script type="text/javascript" src="<?php //echo Router::webroot('js/tinymce/tiny_mce.js'); ?>"></script>
<script type="text/javascript">

      tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        relative_urls : false,
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,image",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
        file_browser_callback : 'fileBrowser'
    });

    function fileBrowser(field_name, url, type, win){
      if(type=='file'){
          var explorer = '<?php //echo Router::url('admin/posts/tinymce'); ?>';
      }else{
          var explorer = '<?php //echo Router::url('admin/medias/index/'.$id); ?>';
      }
      tinyMCE.activeEditor.windowManager.open({
        file : explorer,
        title : 'Gallerie',
        width: 420,
        height: 400,
        resizable : 'yes',
        inline : 'yes',
        close_previous : 'no'
      },{
        window : win,
        input : field_name
      });
      return false; 
    }
</script>
-->