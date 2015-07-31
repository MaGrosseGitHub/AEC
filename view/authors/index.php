<?php //debug($orderOrga); ?>


<div class="md-col-12">
	<?php foreach ($authors as $letter => $lresults) : ?>
		<div class="orgaLetter">
			<h1><?php echo $letter; ?></h1>
			<?php foreach ($lresults as $lresKey => $lres) : ?>
				<div class="orgaSingle" full-data = "<?php echo $lres->lastName; ?>">
					<a href=""><?php echo $lres->lastName.' '.$lres->firstName; ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
</div>