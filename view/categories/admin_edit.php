<div class="page-header">
	<h1>Editer un catégorie</h1>
</div>

<form action="<?php echo Router::url('admin/categories/edit/'.$id); ?>" method="post">
	<?php echo $this->Form->input('name','Titre <span style = "color : red;">FR</span>'); ?>
	<?php echo $this->Form->input('name_EN','Titre <span style = "color : red;">EN</span>'); ?>
	<?php echo $this->Form->input('id','hidden'); ?>
	<br>
	<div class="actions">
		<input type="submit" class="btn primary" value="Envoyer">
	</div>
</form>