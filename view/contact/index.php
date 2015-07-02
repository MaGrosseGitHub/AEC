<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form id = "form" action="<?php echo Router::url('contact/index/'); ?>" method="post" enctype="multipart/form-data">
			<?php 

		    echo $this->Form->input('object','Objet');
		    echo $this->Form->input('name','Nom Prénom');
		    echo $this->Form->input('email','email', array('type' =>'email'));
		    echo $this->Form->input('content','Contenu',array('type'=>'textarea','rows'=>5));
            echo $this->Form->input('adresse','hidden');

		    $this->Form->JSCheck("form");
		   ?>

		  <br>
			<div class="actions">
				<input type="submit" class="btn primary" value="Envoyer">
			</div>
		</form>
	</div>
</div>