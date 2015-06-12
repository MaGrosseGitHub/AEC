<div class="row">
	<div class="col-md-8">
		<form id = "form" action="<?php echo Router::url('contact/index/'); ?>" method="post" enctype="multipart/form-data">
			<?php 
			debug($randomcolor = '#' . strtoupper(dechex(rand(0,10000000))));

		    echo $this->Form->input('name','Objet');
		    echo $this->Form->input('email','email', array('type' =>'email'));
		    echo $this->Form->input('content','Contenu',array('type'=>'textarea','class'=>'redactor','rows'=>5));

		    $this->Form->JSCheck("form");
		   ?>

		  <br>
			<div class="actions">
				<input type="submit" class="btn primary" value="Envoyer">
			</div>
		</form>
	</div>

	<div class="col-md-4">
		<iframe src="https://mapsengine.google.com/map/u/0/embed?mid=zGjE6jWUucoM.kBay27JfqJyY" width="640" height="480"></iframe>
		<div class="infoContact">
			<div class="contactShare">
				<a href="#">Facebook</a>
				<a href="#">twitter</a>
				<a href="#">google+</a>
			</div>
			Lorem ipsum In ut occaecat dolor nisi mollit anim deserunt occaecat consequat Ut eiusmod exercitation anim Ut commodo ex tempor dolor qui pariatur dolore esse cupidatat ad Excepteur ad in laborum sed Duis cupidatat nisi qui in dolore cillum reprehenderit veniam sunt do tempor dolor proident elit velit nostrud in aliqua dolor dolore nulla consectetur ut commodo mollit ex voluptate adipisicing sunt consequat dolor Duis reprehenderit elit Excepteur ullamco aute consectetur nisi sit ad ut nostrud cillum deserunt pariatur qui id sed in tempor ut ut cupidatat do est minim fugiat elit mollit officia in dolore ad id laborum eiusmod irure enim reprehenderit velit et cillum dolor quis cillum est ullamco voluptate dolor reprehenderit est nostrud labore dolore adipisicing tempor ea cillum mollit in ut labore ut veniam Excepteur qui ad occaecat nulla exercitation magna anim dolor anim nostrud laborum in ea in Ut sed nostrud dolore ad elit eu veniam in ullamco fugiat irure cupidatat ad ut do aute Ut dolor culpa esse dolore proident eiusmod deserunt aliqua ad ex esse incididunt irure reprehenderit ad do ut aliquip nulla incididunt Excepteur laborum cupidatat ex pariatur in laborum id irure tempor adipisicing ad incididunt dolor occaecat aliqua incididunt et velit sunt est veniam sunt eu sit ut laborum incididunt laboris cillum ut sit amet anim officia Duis sunt consequat sit pariatur in Excepteur consectetur exercitation sunt fugiat qui consectetur in occaecat ea laborum do deserunt tempor cillum veniam ullamco consequat voluptate mollit ad Excepteur proident cillum cupidatat aliqua Duis cupidatat proident labore anim commodo labore Excepteur cupidatat qui cupidatat.
		</div>
	</div>
</div>