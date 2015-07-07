<div class="page-header">
	<h1>Zone réservé</h1>
</div>	
	<form action="<?php echo Router::url('users/login'); ?>" method="post">
		<?php echo $this->Form->input('login','Identifiant'); ?>
		<?php echo $this->Form->input('password','Mot de passe',array('type'=>'password')); ?>
		<?php echo $this->Form->input('saveLogin','Se souvenir de moi',array('type'=>'checkbox')); ?>
		<div class="actions">
			<input type="submit" class="btn primary" value="Se connecter">
		</div>
	</form>
