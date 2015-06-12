<div class="page-header">
	<h1><?php echo $total; ?> Articles</h1>
</div>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>auteur</th>
			<th>Titre</th>
			<th>De</th>
			<th>à</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $k => $v): ?>
			<tr>
				<td><?php echo $v->id; ?></td>
				<td><?php echo $v->auteur; ?></td>
				<td><?php echo $v->titre; ?></td>
				<td><?php echo "--".date("d/m/Y H:i",$v->fromDate)."-"; ?></td>
				<td><?php echo "-".date("d/m/y H:i",$v->toDate)."--"; ?></td>
				<td>
					<a href="<?php echo Router::url('admin/events/edit/'.$v->id); ?>">Editer,</a>
					<a onclick="return confirm('Voulez vous vraiment supprimer ce contenu'); " href="<?php echo Router::url('admin/events/delete/'.$v->id); ?>">Supprimer</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>


<div class="pagination">
  <!-- <ul>
  <?php for($i=1; $i <= $page; $i++): ?>
    <li <?php if($i==$this->request->page) echo 'class="active"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php endfor; ?>
  </ul> -->
</div>

<a href="<?php echo Router::url('admin/events/edit'); ?>" class="primary btn">Ajouter un evenement</a>