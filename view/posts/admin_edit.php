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
  /*#filelist {
    margin-top: 10px; 
    width : 100%;}*/

    .file {
      padding: 0 10px;
      border: 1px solid #DFDFDF;
      line-height: 70px;
      margin-bottom: 10px;
      display : inline-block;
      width : 190px;
      height : 130px;
      }

    .file img {
      margin : 10px;
      height : 50px;
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

.selectivity-multiple-input-container{
    background-color : #FFF;
}

</style>

<div class="page-header">
	<h1>Editer un projet</h1>
</div>

<form id = "form" action="<?php echo Router::url('cockpitInc/posts/edit/'.$id); ?>" method="post" enctype="multipart/form-data">
    <div id="firstPart">
    <?php echo HTML::getImg("cache/post/test1/test1_150x100.jpg"); ?>
        <h3>Informations principales du projet</h3>
    	<?php 
            echo $this->Form->input('title_FR','Titre <span style = "color : red;">FR</span>');
            echo $this->Form->input('title_EN','Titre <span style = "color : red;">EN</span>');
            // echo $this->Form->input('file','Image',array('type'=>'fileImg'));
            echo $this->Form->input('category_id','Catégorie',array('options' => $categories, 'class'=>'selectpicker', 'listInvert' => true));
            echo $this->Form->input('publication','Date de publication',array('type' =>'datepicker', 'class'=>'timestamp')); 
            echo $this->Form->input('id','hidden');
            echo $this->Form->input('user_id','hidden', array('inputValue'=>$_SESSION['User']->login));
            // echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'xxlarge wysiwyg validate[required,funcCall[checkTextArea]]','rows'=>5));
            echo $this->Form->input('content','Contenu <span style = "color : red;">FR</span>',array('type'=>'textarea','class'=>'redactor','rows'=>5));
            echo $this->Form->input('content','Contenu <span style = "color : red;">EN</span>',array('type'=>'textarea','class'=>'redactor','rows'=>5));
        ?>
    </div>
    <div id="secondpart">
            
        <?php echo $this->Form->input('video_youtube','lien Video <span style = "color : red;">Youtube</span>'); ?>
        <?php echo $this->Form->input('video_vimeo','lien Video <span style = "color : red;">Vimeo</span>'); ?>

        <?php echo  $this->Form->input('filesData','hidden'); ?>
        <div id="plupload">
            <div id="droparea">
                <p>Drag & drop files here</p>
                <span class="or">or</span>
                <a href="#" id="browse">Browse</a> <br><br>
                Refresh to see uploaded files on homepage
            </div>
            <div id="filelist"></div>
        </div>
        <div id="debug"></div>
    </div>
            
    <div id="thirdpart">
        <h3>Informations sur les auteurs du projet</h3>
        <?php 
            echo $this->Form->input('organization','Organisation',array('options' => $organizations, 'class'=>'selectpicker', 'listInvert' => true, 'required'=> true));
        ?>
        <label class="control-label" for="inputauthors">Auteur(s)</label>
        <br>
        <button  type="button" id = "switchAuthors" >Voir les auteurs par organizations</button>
        <p>
            <span id="inputauthors" class="selectivity-input"></span>
        </p>
        <p>
            <span id="inputauthors_cat" class="selectivity-input"></span>
        </p>
        <?php echo $this->Form->input('authorsHidden','hidden', array('inputValue'=>'testVal')); ?>
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
        <button  type="button" id = "test" >TEST</button>
		<input id = "send" type="submit" class="btn primary" value="Envoyer">
	</div>
</form>

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
<?php echo HTML::JS("plupload/plupload"); ?>
<?php echo HTML::JS("plupload/plupload.flash"); ?>
<?php echo HTML::JS("plupload/plupload.html5"); ?>
<?php echo HTML::JS("plupload"); ?>

<script>
    $( document ).ready(function() {
        // $("#inputauthors").hide();
        // $("#inputauthors option").each(function()
        // {
        //     selectItems.push($(this).text());
        // });
        $("#inputauthors_cat").hide();
        var authorCat = false;
        $("#switchAuthors").on( "click", function() {
            if(!authorCat){
                $("#inputauthors_cat").show();
                $("#inputauthors").hide();
                $(this).text("Voir tout les auteurs")
                authorCat = true;
            } else {
                $("#inputauthors_cat").hide();
                $("#inputauthors").show();
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

        // console.log($("#inputauthorsHidden").val());
        // console.log(selectItems);
        // console.log(selectItemsCat);

        $('#form').on('submit',function(){
            alert("TEST");
            console.log($("#inputauthors").selectivity('data'));
            $("#inputauthorsHidden").val(JSON.parse($("#inputauthors").selectivity('data')));
            console.log($("#inputauthorsHidden").val());
            alert("TEST");
        }) ;


        $("#test").on( "click", function() {
            if(!authorCat){
                $("#inputauthorsHidden").val(JSON.stringify($("#inputauthors").selectivity('data')));
                    console.log($("#inputauthors").selectivity('data'));
            } else {
                $("#inputauthorsHidden").val(JSON.stringify($("#inputauthors_cat").selectivity('data')));
                    console.log($("#inputauthors_cat").selectivity('data'));
            }
            console.log($("#inputauthorsHidden").val());
        }) ;
    });

</script>

