<div class="span3">
	<h3>Catégories</h3>
	<?php $categories = $this->request('Categories','index'); ?>
	<ul>
		<?php foreach ($categories as $k => $v): ?>
			<li><a href="<?php echo Router::url('posts/category/slug:'.$v->slug); ?>"><?php echo $v->name; ?></a></li>	
		<?php endforeach ?>
	</ul>
</div>