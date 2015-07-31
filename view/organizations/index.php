<?php //debug($orderOrga); ?>


<div class="md-col-12">
	<?php foreach ($orderOrga as $letter => $lresults) : ?>
		<div class="orgaLetter">
			<h1><?php echo $letter; ?></h1>
			<?php foreach ($lresults as $lresKey => $lres) : ?>
				<div class="orgaSingle" full-data = "<?php echo $lres->lastName; ?>">
					<a href=""><?php echo $lres->firstName; ?></a>;
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
</div>

<script type="text/javascript">
	
    $(document).ready(function() {
    	$acronyme = "";
    	$fullName = ""
    	$('.orgaSingle').hover(    		
			function() {
    			$acronyme = $(this).text();
    			$fullName = $(this).attr('full-data');
    			$(this).text($fullName);
			}, function() {
    			$(this).text($acronyme);
			}
    	);
    });
</script>