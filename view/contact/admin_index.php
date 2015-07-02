<div class="row">
	<div >
		<form id = "form" action="<?php echo Router::url('cockpit/contact/index/'); ?>" method="post" enctype="multipart/form-data">
			<?php 
		    echo $this->Form->input('email','email', array('type' =>'email'));
            echo $this->Form->input('id','hidden');

		    $this->Form->JSCheck("form");
		   ?>

		  <br>
			<div class="actions">
				<input type="submit" class="btn primary" value="Envoyer">
			</div>
		</form>
	</div>
</div>