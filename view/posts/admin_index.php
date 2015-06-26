<div class="page-header">
	<h1><?php echo $total; ?> Articles</h1>
</div>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>En ligne ?</th>
			<th>Titre</th>
			<th>Crée le</th>
			<th>Catégorie</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $k => $v): ?>
			<tr>
				<td><?php echo $v->id; ?></td>
				<td><span class="label <?php echo ($v->online==1)?'success':'error'; ?>"><?php echo ($v->online==1)?'En ligne':'Hors ligne'; ?></span></td>
				<td><?php echo $v->title_FR; ?></td>
				<td><?php echo date("d-m-Y",$v->created); ?></td>
				<td><?php echo $v->catname; ?></td>
				<td>
					<a href="<?php echo Router::url('admin/posts/edit/'.$v->id); ?>">Editer</a>
					<a onclick="return confirm('Voulez vous vraiment supprimer ce contenu'); " href="<?php echo Router::url('admin/posts/delete/'.$v->id); ?>">Supprimer</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>


<div class="pagination">
  <ul>
  <?php for($i=1; $i <= $page; $i++): ?>
    <li <?php if($i==$this->request->page) echo 'class="active"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php endfor; ?>
  </ul>
</div>

<a href="<?php echo Router::url('admin/posts/edit'); ?>" class="primary btn">Ajouter un article</a>