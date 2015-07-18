<div class="page-header">
	<h1>Editer un article</h1>
</div>

<form action="<?php echo Router::url('admin/pages/edit/'.$id); ?>" method="post">
  <?php echo $this->Form->input('title_FR','Titre <span style = "color : red;">FR</span>'); ?>
  <?php echo $this->Form->input('title_EN','Titre <span style = "color : red;">EN</span>'); ?>
	<?php echo $this->Form->input('id','hidden'); ?>
  <?php echo $this->Form->input('content_FR','Contenu <span style = "color : red;">FR</span>',array('type'=>'textarea','class'=>'redactor','rows'=>5)); ?>
  <?php echo $this->Form->input('content_EN','Contenu <span style = "color : red;">EN</span>',array('type'=>'textarea','class'=>'redactor','rows'=>5)); ?>
	<?php echo $this->Form->input('online','En ligne',array('type'=>'checkbox')); ?>
	<div class="actions">
		<input type="submit" class="btn primary" value="Envoyer">
	</div>
</form>