<div class="page-header">
	<h1>Ajouter/Editer un auteur</h1>
    <h3 style = "color : red;"> <span > * </span>: Required fields.</h3>
</div>

<form id = "form" caction="<?php echo Router::url('cockpitInc/authors/edit/'.$id); ?>" method="post" enctype="multipart/form-data">
    <fieldset>
    	<?php 
        $this->Form->addAsterisk = true;
        echo $this->Form->input('firstName','Acronyme', array('required'=> true));
        echo $this->Form->input('lastName','Nom complet', array('required'=> true));
        echo $this->Form->input('file','Photo',array('type'=>'fileImg'));
        echo $this->Form->input('website','Site web', array('type'=>'url'));
        // echo $this->Form->input('category_id','Catégorie',array('options' => $categories, 'class'=>'selectpicker', 'listInvert' => true));
        // echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'xxlarge wysiwyg validate[required,funcCall[checkTextArea]]','rows'=>5));
        echo $this->Form->input('bio_FR','Bio <span style = "color : red;">FR</span>',array('type'=>'textarea','class'=>'redactor','rows'=>5), array('required'=> true));
        echo $this->Form->input('bio_EN','Bio <span style = "color : red;">EN</span>',array('type'=>'textarea','class'=>'redactor','rows'=>5), array('required'=> true));
        echo $this->Form->input('id','hidden');
        
        $this->Form->JSCheck("form");
       ?>

        <br>
    	<div class="actions">
    		<input type="submit" class="btn primary" value="Envoyer">
    	</div>
    </fieldset>

</form>
