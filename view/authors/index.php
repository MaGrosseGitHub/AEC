<?php //debug($orderOrga); ?>

<style type="text/css">

.orgaLetter {
	background: #FFF;
	border: 1px solid #C6BDBD;
	padding : 10px;
	margin : 5px;
	text-align: center;
}

.orgaSingle {
	height : 30px;
	text-align: left;
	vertical-align: middle;
}

</style>

<div class=" col-md-12">
	<?php foreach ($authors as $letter => $lresults) : ?>
		<?php $curOrg = $organizations[$letter] ; ?>
		<div class="orgaLetter col-md-3">
			<h1> <?php echo HTML::getImg(Cache::ORGANIZATION.'/'.$curOrg->slug.'/'.$curOrg->slug.'.jpg'); ?> <?php echo strtoupper($letter); ?></h1>
			<?php foreach ($lresults as $lresKey => $lres) : ?>
				<div class="orgaSingle" full-data = "<?php echo $lres->lastName; ?>">
					<a href=""><?php echo $lres->lastName.' '.$lres->firstName; ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
</div>