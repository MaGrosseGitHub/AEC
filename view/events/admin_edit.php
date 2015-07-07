<div class="page-header">
	<h1>Editer un article</h1>
</div>


<style type="text/css">
    .ui-datepicker { font-size: 9pt !important; }
</style>

<form action="<?php echo Router::url('admin/events/edit/'.$id); ?>" method="post">
  <?php 
  // $this->Form->required = true;
  echo $this->Form->input('titre','Titre');
  echo $this->Form->input('auteur','hidden', array('inputValue'=>$_SESSION['User']->login));
  echo $this->Form->input('type','hidden', array('inputValue'=>''));
  echo $this->Form->input('type','Catégorie',array('options' => $categories, 'class'=>'selectpicker', 'listInvert' => true));
  echo $this->Form->input('id','hidden');
  echo $this->Form->input('description','Description de l\'évement',array('type'=>'textarea','class'=>'redactor','rows'=>7));
	echo $this->Form->input('fromDate','Debut',array('class'=>'datepicker timestamp'));
  echo $this->Form->input('toDate','Fin',array('class'=>'datepicker timestamp')); 
  ?>
	<div class="actions">
		<input type="submit" class="btn primary" value="Envoyer">
	</div>
</form>
    


 
