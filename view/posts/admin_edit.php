
<?php echo HTML::CSS("View/Posts/admin_edit"); ?>
<?php echo HTML::CSS("browser/browser"); ?>

<div class="page-header">
	<h1>Editer un projet</h1>
</div>

<form id = "form" action="<?php echo Router::url('cockpitInc/posts/edit/'.$id); ?>" method="post" enctype="multipart/form-data">
    <div id="firstPart">
        <h3>Informations principales du projet</h3> 
        <hr align = "left" size = "1" style = "border-color : #3d3d3d; width : 70%; ">
    	<?php 
            echo $this->Form->input('title_FR','Titre <span style = "color : red;">FR</span>');
            echo $this->Form->input('title_EN','Titre <span style = "color : red;">EN</span>');
            // echo $this->Form->input('file','Image',array('type'=>'fileImg'));
            echo $this->Form->input('category_id','Catégorie',array('options' => $categories, 'class'=>'selectpicker', 'listInvert' => true));
            echo $this->Form->input('publication','Date de publication',array('type' =>'datepicker', 'class'=>'timestamp')); 
            echo $this->Form->input('id','hidden');
            echo $this->Form->input('user_id','hidden', array('inputValue'=>$_SESSION['User']->login));
            // echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'xxlarge wysiwyg validate[required,funcCall[checkTextArea]]','rows'=>5));
            echo $this->Form->input('content_FR','Contenu <span style = "color : red;">FR</span>',array('type'=>'textarea','class'=>'redactor','rows'=>5));
            echo $this->Form->input('content_EN','Contenu <span style = "color : red;">EN</span>',array('type'=>'textarea','class'=>'redactor','rows'=>5));
            
            $floors = array('RDC',1,2,3);
            echo $this->Form->input('floors','Etages',array('options' => $floors, 'class'=>'selectpicker', 'listInvert' => true));
        ?>
    </div>
    <div id="secondpart"> 
        <br>  
        <br>  
        <h3>Images et vidéos</h3>
         <hr align = "left" size = "1" style = "border-color : #3d3d3d; width : 70%; ">

        <?php echo $this->Form->input('video_youtube','lien Video <span style = "color : red;">Youtube</span>'); ?>
        <?php echo $this->Form->input('video_vimeo','lien Video <span style = "color : red;">Vimeo</span>'); ?>
        <?php echo $this->Form->input('video_server','Vidéo correspandante sur le serveur <span style = "color : red;">Vimeo</span>'); ?>

        <button type="button" id="browseVid">Browse for video</button>
        <div class="browser">
          <p style = "display : none;" class="pfilter">filter files by type
            <input type="hidden" id="txtFilter" value=""/>
            <!-- <input type="button" value="Refresh" id="btnrefresh"/> -->
          </p>
          <p class="pfilter">Search : 
            <input type="text" id="txtsearch" value=""/>
            <input type="button" value="Refresh" id="btnrefresh"/>
          </p>
          <p id="pPathDisplay" class="pPathDisplay">Loading...</p>
          <div id="dvContents" class="dvContents">&nbsp;</div>
        </div>

        <?php echo  $this->Form->input('images_id','hidden', array('inputValue'=> '')); ?>
        <div id="plupload">
            <div id="droparea">
                <p>Drag & drop files here</p>
                <span class="or">or</span>
                <a href="#" id="browse">Browse</a> <br><br>
                Refresh to see uploaded files on homepage
            </div>
              <button type="button" id = "deleteAllImgs" >Supprimer toutes les images</button>
            <div id="filelist">
              <?php 
                if(isset($imagesData) && !empty($imagesData)){
                  foreach ($imagesData as $imgKey => $img) {
                    $html = '<div class="file">
                              <img src="'.Router::webroot($img).'"/> '.substr(basename($img), 0, 10).'...
                              <div class="actions">
                                <a href="'.Router::url('admin/posts/delete_img/'.$id.'/'.basename($img)).'" class="del">Supprimer</a>
                              </div> 
                            </div>';        
                    echo $html;
                  }
                }
              ?>
            </div>
        </div>
        <div id="debug"></div>
    </div>
    <br>
    <br>
            
    <div id="thirdpart">
        <br>  
        <br>  
        <h3>Informations sur les auteurs du projet</h3>
         <hr align = "left" size = "1" style = "border-color : #3d3d3d; width : 70%; ">
        <?php 
            echo $this->Form->input('organization_id','Organisation',array('options' => $organizations, 'class'=>'selectpicker', 'listInvert' => true, 'required'=> true));
        ?>
        <label class="control-label" for="inputauthors">Auteur(s)</label>

        <br>
        <button  type="button" id = "switchAuthors" >Voir les auteurs par organizations</button>

        <p><span id="inputauthors" class="selectivity-input"></span></p>
        <p><span id="inputauthors_cat" class="selectivity-input"></span></p>
        <?php echo $this->Form->input('author_id','hidden', array('inputValue'=> '')); ?>
        
        <br>

        <?php
            echo $this->Form->input('online','En ligne',array('type'=>'checkbox')); 
            echo $this->Form->input('social_online','Mettre en ligne sur les réseaux sociaux',array('type'=>'checkbox')); 
        ?>
    </div>
        <?php
            $this->Form->JSCheck("form");
        ?>
    <br>
	<div class="actions">
		<input id = "send" type="submit" class="btn primary" value="Envoyer">
	</div>
</form>

<div id="urlCorrected" style = "display : none;"></div>

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
<?php echo HTML::JS("plupload/plupload"); ?>
<?php echo HTML::JS("plupload/plupload.flash"); ?>
<?php echo HTML::JS("plupload/plupload.html5"); ?>
<?php echo HTML::JS("plupload"); ?>

<?php echo HTML::JS("browser/ajax"); ?>
<?php echo HTML::JS("browser/browser"); ?>

<script>
    var filesData2 = '<?php echo $images_id; ?>';
    var elem = document.getElementById("inputimages_id");
    elem.value = filesData2;

    url = window.location.href;
    findEdit = "edit";
    regex =  new RegExp('\\b' + findEdit + '\\b');
    findEdit = url.search(regex);
    url = url.substr(0, findEdit);
    var urlDiv = document.getElementById("urlCorrected");
    urlDiv.value = url;

    $( document ).ready(function() {

        $("#inputauthors_cat").hide(500);
        var authorCat = false;
        $("#switchAuthors").on( "click", function() {
            if(!authorCat){
                $("#inputauthors_cat").show(500);
                $("#inputauthors").hide(500);
                $(this).text("Voir tout les auteurs")
                authorCat = true;
            } else {
                $("#inputauthors_cat").hide();
                $("#inputauthors").show(500);
                $(this).text("Voir les auteurs par organizations")
                authorCat = false;
            }
        });

        var selectItems = '<?php echo $authors; ?>';
        selectItems = JSON.parse(selectItems);        
        $('#inputauthors').selectivity({
            multiple: true,
            InputTypes : 'multiple',
            placeholder: 'No author selected',
            items : selectItems,
            showSearchInputInDropdown: true,
            searchInputPlaceholder: 'Type to search for authors'
        });

        var selectItemsCat = '<?php echo $authors_cat; ?>';
        selectItemsCat = JSON.parse(selectItemsCat);
        $('#inputauthors_cat').selectivity({
            multiple: true,
            placeholder: 'No author selected',
            items : selectItemsCat,
            showSearchInputInDropdown: true,
            searchInputPlaceholder: 'Type to search for authors'
        });

        authorsData = '<?php echo $author_id; ?>';
        if(authorsData != ""){
          authorsData = JSON.parse(authorsData);
        }
        if( $.isArray(authorsData) && authorsData.length > 0) {
          $("#inputauthors").selectivity('data', authorsData);
          $("#inputauthors_cat").selectivity('data', authorsData);
        }

        $('#form').on('submit',function(e){
            if(!authorCat){
                $("#inputauthor_id").val(JSON.stringify($("#inputauthors").selectivity('data')));
            } else {
                $("#inputauthor_id").val(JSON.stringify($("#inputauthors_cat").selectivity('data')));
            }
            return true;
        }) ;

        $(".browser").hide();
        $("#browseVid").on( "click", function() {
          $(".browser").toggle(500);
        });

        function init(){
          browser({
            contentsDisplay:document.getElementById("dvContents"),
            refreshButton:document.getElementById("btnrefresh"),
            pathDisplay:document.getElementById("pPathDisplay"),
            filter:document.getElementById("txtFilter"),
            search:document.getElementById("txtsearch"),
            openFolderOnSelect:true,
            onSelect:function(item,params){
              if(item.type=="folder"){
                return true;
              }else{
                $("#inputvideo_server").val(item.path)
              }
            },
            currentPath:"images"
          });
        }
        init();
        $("#txtFilter, #txtsearch").on( "keyup", function(){
            init();
        });
    });

</script>

