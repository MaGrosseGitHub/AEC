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
    echo $this->Form->input('user_id','hidden', array('inputValue'=>$_SESSION['User']->login));
    // echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'xxlarge wysiwyg validate[required,funcCall[checkTextArea]]','rows'=>5));
    echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'redactor','rows'=>5));
    
    echo $this->Form->input('online','En ligne',array('type'=>'checkbox')); 
    $this->Form->JSCheck("form");
   ?>

  <br>
	<div class="actions">
		<input type="submit" class="btn primary" value="Envoyer">
	</div>
</form>
