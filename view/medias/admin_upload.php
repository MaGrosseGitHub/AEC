<style>
	
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
  #filelist {
    margin-top: 10px; 
    width : 100%;}
    td {

      width : 100%;
    }
    .file {
      padding: 0 10px;
      border: 1px solid #DFDFDF;
      line-height: 70px;
      margin-bottom: 10px;
      position: relative; }
    .file img {
      margin-right: 10px;
      height: 55px;
      vertical-align: middle; }

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

    td{
    	border : 2px dotted black;
    }
    th, table{
    	border : 2px black solid;
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
    <?php echo $this->Form->input('albumSelect','Choisir album',array('options' => $albums)); ?>
    <button class = "createAlbum">Créer album</button>
    <div class="newAlbum">      
      <form id = "newAlbumForm" action="<?php echo Router::url('admin/medias/createAlbum'); ?>" method="post">
        <?php 
          $this->Form->required = true;
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

<div id="filelist">
  
</div>

    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <?php echo HTML::JS("plupload/plupload"); ?>
    <?php echo HTML::JS("plupload/plupload.flash"); ?>
    <?php echo HTML::JS("plupload/plupload.html5"); ?>
<script>
  
$(function($){

  // var album = "";
  // // console.log($('#album'));
  // var useAlbum = $("input[name=album]");
  // $(".album").hide();
  // useAlbum.click(function() {
  //   if(useAlbum.is(':checked')){
  //     $(".album").show();
  //     album = $("#inputalbumSelect :selected").text();
  //     console.log(album);
  //   }
  // })  
  // if(useAlbum.is(':checked')){
  //   $(".album").show();
  // }
  // $('#inputalbumSelect').change(function() {
  //     album = $("#inputalbumSelect :selected").text();
  //     console.log(album);
  //     // console.log($("#inputalbumSelect :selected").text());
  // });

});

</script>
<?php echo HTML::JS("plupload"); ?>

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