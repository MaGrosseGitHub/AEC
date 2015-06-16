<div class="page-header">
	<h1>Editer un article</h1>
</div>

<form id = "form" action="<?php echo Router::url('cockpitInc/authors/edit/'.$id); ?>" method="post" enctype="multipart/form-data">
	<?php 
    echo $this->Form->input('firstName','Prénom');
    echo $this->Form->input('lastName','Nom');
    echo $this->Form->input('file','Photo',array('type'=>'fileImg'));
    echo $this->Form->input('website','Site web');
    echo $this->Form->input('organization','Organisation');
    // echo $this->Form->input('category_id','Catégorie',array('options' => $categories, 'class'=>'selectpicker', 'listInvert' => true));
    echo $this->Form->input('id','hidden');
    echo $this->Form->input('user_id','hidden', array('inputValue'=>$_SESSION['User']->login));
    // echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'xxlarge wysiwyg validate[required,funcCall[checkTextArea]]','rows'=>5));
    echo $this->Form->input('bio','Bio',array('type'=>'textarea','class'=>'redactor','rows'=>5));
    
    $this->Form->JSCheck("form");
   ?>

  <br>
	<div class="actions">
		<input type="submit" class="btn primary" value="Envoyer">
	</div>
</form>
