﻿<style>
	
#plupload 
{
  font-family: Arial,Helvetica;
  color: #3D3D3D; 
  padding-top : 100px;
  padding-right:20px;
  /*height : 100%;*/
  text-align: center;
}
  #plupload #droparea {
    border: 4px dashed #999999;
    height: 200px;
    text-align: center;
    font-size: 13px; }
    #plupload #droparea p {
      margin: 0;
      padding: 60px 0 0 0;
      font-weight: bold;
      font-size: 20px; }
    #plupload #droparea span {
      display: block;
      margin-bottom: 6px; }
    #plupload #droparea.hover {
      border-color: #83b4d8; }
  #plupload #browse {
    border: 1px solid #BBB;
    text-decoration: none;
    padding: 3px 8px;
    color: #464646;
    background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #ffffff), color-stop(100%, #f4f4f4));
    background-image: -webkit-linear-gradient(top, #ffffff, #f4f4f4);
    background-image: -moz-linear-gradient(top, #ffffff, #f4f4f4);
    background-image: -o-linear-gradient(top, #ffffff, #f4f4f4);
    background-image: -ms-linear-gradient(top, #ffffff, #f4f4f4);
    background-image: linear-gradient(top, #ffffff, #f4f4f4);
    -moz-border-radius: 15px;
    -webkit-border-radius: 15px;
    -o-border-radius: 15px;
    -ms-border-radius: 15px;
    -khtml-border-radius: 15px;
    border-radius: 15px; }
  /*#filelist {
    margin-top: 10px; 
    width : 100%;}*/

    .file {
      padding: 0 10px;
      border: 1px solid #DFDFDF;
      /*line-height: 70px;*/
      margin-bottom: 10px;
      display : inline-block;
      width : 190px;
      height : 130px;
      }

    .file img {
      margin : 10px;
    }

    .delete, .deleteImg, .addImg {
      position : relative;
      top : -100px;
      left : 120px;
      background: #FFF;
    }

    /*.addToAlbum{
      position : relative;
      top : -130px;
      left : -70px;
      background: #FFF;
    }*/

    .action, .imgName, .delete {
      display : inline-block;
    }

    .imgName{   
      position : relative;
      top : -70px;  
      left : 20px;
      width : 120px;
      height : 20px;
      overflow: hidden;
      background: #FFF;
    }

    .albumDiv{
      background: #FF0;
    }

    .albumEmpty{
      display: none
    }

    .progressbar {
      position: absolute;
      top: 25px;
      right: 5px;
      width: 150px;
      height: 20px;
      background-color: #abb2bc;
      -moz-border-radius: 25px;
      -webkit-border-radius: 25px;
      -o-border-radius: 25px;
      -ms-border-radius: 25px;
      -khtml-border-radius: 25px;
      border-radius: 25px;
      -moz-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5);
      -webkit-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5);
      -o-box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5);
      box-shadow: inset 0px 1px 2px 0px rgba(0, 0, 0, 0.5); }
    .progress {
      position: absolute;
      border: 1px solid #4c8932;
      height: 18px;
      width: 10%;
      background: url(<?php echo HTML::getImg("progress.jpg", true, true); ?>) repeat;
      -webkit-animation: progress 2s linear infinite;
      -moz-border-radius: 25px;
      -webkit-border-radius: 25px;
      -o-border-radius: 25px;
      -ms-border-radius: 25px;
      -khtml-border-radius: 25px;
      border-radius: 25px; }

@-webkit-keyframes progress {
  from {
    background-position: 0 0; }

  to {
    background-position: 54px 0; } }

.clear{
  clear : both;
}

</style>


<div id="plupload">
	<div id="droparea">
	    <p>Drag & drop files here</p>
	    <span class="or">or</span>
	    <a href="#" id="browse">Browse</a> <br><br>
	    Refresh to see uploaded files on homepage
	</div>
</div>

<div id="albumAction">
  <?php echo $this->Form->input('album','Ajouter à album',array('type'=>'checkbox')); ?>
  <div class="album">
    <div id="albums">  
      <?php echo $this->Form->input('albumSelect','Choisir album',array('options' => $albums, "class" => "selectpicker")); ?>
    </div>
    <button class = "createAlbum btn">Créer album</button>
    <div class="newAlbum">      
      <form id = "newAlbumForm" action="<?php echo Router::url('admin/medias/createAlbum'); ?>" method="post">
        <?php 
          echo $this->Form->input('newAlbum','nom de l\'album');
         ?>
        <div class="actions">
          <input type="submit" class="btn primary" value="Créer">
        </div>
      </form>
    </div>
  </div>
</div>

<br>
<br>
<br>

<button class = "addToAlbum btn">Ajouter image(s) à albums</button> <br>
<button class = "deleteSelect btn">Supprimer image(s)</button> <br>
<div id="addButtons"></div>
<button class = "add btn">Add</button>
<button class = "cancelDelete btn">Annuler</button>

<form id = "deleteForm" action="<?php echo Router::url('admin/medias/delete'); ?>" method="post">
<div id="filelist">
  <div class="actions">
    <input class="btn primary launchDelete" type="submit" value="Tout supprimer">
  </div>  
			<?php 

        foreach ($images as $k => $v): 
          if($v->album == "" || $v->type == "album"):
            $img = "";
            $type = "";
            $addButton = "";
            $deleteImg = "";
            $addImg = "";
            if($v->type == "album") {
              if($v->album != "") {
                echo '<div class="file albumDiv">';
                $img = explode(",", $v->album);
                $img = $img[0];
                $type = 'album'; 
                $deleteImg = "";
                $addImg = "";
              } else {
                echo '<div class="file Empty">';
                // echo '<div class="file albumEmpty">';
                $img = "nofile.PNG";
              }
            } else {
              echo '<div class="file">';
              $img = $v->file;
              $type = "img"; 
              $deleteImg = $this->Form->input($v->id,'',array('type'=>'checkbox', 'class' => "deleteImg")); 
              $addImg = $this->Form->input($v->file,'',array('type'=>'checkbox', 'class' => "AddImg")); 
            }
        ?>
              <?php echo HTML::getImg($img, false, false, 'height="100" width ="150px"'); ?>
  						<div class="actions">
                <!-- Checkbox -->
                <?php echo $deleteImg; ?>
                <?php echo $addImg; ?>
                <!-- delete Link -->
                <!-- <?php echo Router::url('admin/medias/delete/'.$v->id); ?> -->
                <a class = "delete" type = "<?php echo $type; ?>" link = "<?php echo $v->id; ?>" href="">
                  <?php echo HTML::getImg("delete.png",true, false, 'width ="30px" height = "30px"'); ?>
                </a>
                <!-- Image/Album name -->
                <div class="imgName"> <?php echo $v->name; ?> </div>
  						</div>            
            </div>

        <?php endif ?>
			<?php endforeach ?>

</div>
<!-- <input type = "hidden" name = "deleteAlbym" value = "true" /> -->
</form>

<div id="deleteButtons"></div>

  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
  <?php echo HTML::JS("plupload/plupload"); ?>
  <?php echo HTML::JS("plupload/plupload.flash"); ?>
  <?php echo HTML::JS("plupload/plupload.html5"); ?>
  <?php echo HTML::JS("plupload"); ?>

<script>
  
$(function($){

  $(".deleteImg").hide();
  $(".addImg").hide();
  $(".launchDelete").hide();
  $(".cancelDelete").hide();
  $(".add").hide();
  $(".deleteSelect").click(function() {
    $(".deleteImg").show();
    $(".launchDelete").show();
    $(this).hide();
    $(".add").hide();
    $(".addToAlbum").hide();
    $(".delete").hide();
    $("#albumAction").hide();
    $("#plupload").hide();
    $(".albumDiv").hide();
    $(".Empty").hide();
    $(".cancelDelete").show();
  });

  $(".cancelDelete").click(function() {
    $(".deleteImg").hide();
    $(".addImg").hide();
    $(".add").hide();
    $(".launchDelete").hide();
    $(this).hide();
    $(".albumDiv").show();
    $(".Empty").show();
    $(".deleteSelect").show();
    $(".addToAlbum").show();
    $(".delete").show();
    $("#albumAction").show();
    $("#plupload").show();
  });

  var albumId = "";
  $(".delete").click(function() {
    var type = $(this).attr("type");
    if(type == "img") {
      return confirm('Voulez vous vraiment supprimer cette image ?');
    } else if(type = "album"){
      albumId = $(this).attr("link");
      if($(this).parents()[1].className == "file Empty") {
        return true;
      } else {
        $( "#deleteButtons" ).dialog( "open" );
      }
    }

    return false;
  });

  $(".addToAlbum").click(function() {
      $(".add").show();
      $(".addImg").show();
      $(".cancelDelete").show();
      $(this).hide();
      $(".delete").hide();
      $(".launchDelete").hide();
      $(".deleteSelect").hide();
      $("#albumAction").hide();
      $("#plupload").hide();
      $(".albumDiv").hide();
      $(".Empty").hide();
      $("#addButtons").append($('#albums')[0]);
      addToAlbum = true;
      albumId = $("#inputalbumSelect :selected").val();
      $("#inputalbumSelect").change(function() {
        albumId = $("#inputalbumSelect :selected").val();
      });

    return false;
  });

  $('.add').click(function(){
    $("#deleteForm").append('<input type = "hidden" name = "addToAlbum" value = "'+albumId+'" />');
    var formAction = $("#deleteForm").attr('action');
    formAction = formAction.replace("delete", "process");
    $("#deleteForm").attr('action',formAction);
    console.log($(".addImg:checked").val());
    // console.log($(".deleteImg:checked").attributes[2].nodeValue);
    // $(".addImg:checked").each(function(i, val) {
    //   console.log(i + val);
    // })
    $("#deleteForm").submit();
  });

  $( "#deleteButtons" ).dialog({
    autoOpen: false,
    modal: true,
    buttons: {
      "Supprimer l'album": function() {
        $("#deleteForm").append('<input type = "hidden" name = "deleteAlbumImg" value = "'+albumId+'" />');
        if(confirm('Ceci supprimera l\'album et toutes les images qu\'il contient, \n Voulez vous continer ?')){
          $("#deleteForm").submit();
        } else {
          $( this ).dialog( "close" );
        }
      },
      "Garder les images": function() {
        $("#deleteForm").append('<input type = "hidden" name = "deleteAlbum" value = "'+albumId+'" />');
        if(confirm('Ceci supprimera l\'album mais gardera les images contenu dans celui-ci, \n Voulez vous continer ?')){
          $("#deleteForm").submit();
        } else {
          $( this ).dialog( "close" );
        }
      },
      "Annuler": function() {
        $( this ).dialog( "close" );
      }
    },
    close: function() {
        albumId = "";
    }
  });

});
</script>

  <!-- <a href="#" onclick="FileBrowserDialogue.sendURL('<?php //echo Router::webroot('img/'.$v->file); ?>')">
    <img src="<?php //echo Router::webroot('img/'.$v->file); ?>" height="50">
  </a> -->
<?php
// if(isset($_FILES['photo']))
// {
//   // params
//   unset($erreur);
//   $extensions_ok = array('png', 'gif', 'jpg', 'jpeg');
//   $taille_max = 100000;
//   $dest_dossier = '/brice/photos/';
//   // utilisez également des slashes sous windows : $dest_dossier  = 'd:/damien/photos/';
//   // vérifications
//   if( !in_array( substr(strrchr($_FILES['photo']['name'], '.'), 1), $extensions_ok ) )
//     {    
// 	$erreur = 'Veuillez sélectionner un fichier de type png, gif ou jpg !'; 
// 	}  
//   elseif( file_exists($_FILES['photo']['tmp_name'])           
//          and filesize($_FILES['photo']['tmp_name']) > $taille_max)  
// 	{    
// 	$erreur = 'Votre fichier doit faire moins de 500Ko !';  
// 	}  
// 	// copie du fichier  
//   if(!isset($erreur))  
//     {    
// 	$dest_fichier = basename($_FILES['photo']['name']); 
// 	// formatage nom fichier   
// 	// enlever les accents 
// 	$dest_fichier = strtr($dest_fichier, 
// 	'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
// 	'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
// 	// remplacer les caracteres autres que lettres, chiffres et point par _ 
// 	$dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
// 	// copie du fichier    
// 	move_uploaded_file($_FILES['photo']['tmp_name'], 
// 	$dest_dossier . $dest_fichier);  
// 	}
// }
?>

<!-- <script type="text/javascript" src="<?php echo Router::webroot('js/tinymce/tiny_mce_popup.js'); ?>"></script>

<script type="text/javascript">
	var FileBrowserDialogue = {
	    init : function () {
	        // Here goes your code for setting your custom things onLoad.
	    },
	    sendURL : function (URL) {
	        var win = tinyMCEPopup.getWindowArg("window");

	        // insert information now
	        win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;

	        // are we an image browser
	        if (typeof(win.ImageDialog) != "undefined") {
	            // we are, so update image dimensions...
	            if (win.ImageDialog.getImageData)
	                win.ImageDialog.getImageData();

	            // ... and preview if necessary
	            if (win.ImageDialog.showPreviewImage)
	                win.ImageDialog.showPreviewImage(URL);
	        }

	        // close popup window
	        tinyMCEPopup.close();
	    }
	}

	tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
</script> -->