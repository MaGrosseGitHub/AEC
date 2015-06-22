<div class="page-header">
	<h1><?php echo $total; ?> Auteurs</h1>
</div>

<table class = "table table-bordered table-striped table-hover ">
	<thead>
		<tr>
			<th>ID</th>
			<th>Organisation</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($organizations as $k => $v): ?>
			<tr>
				<td><?php echo $v->id; ?></td>
				<td><?php echo $v->firstName; ?></td>
				<td>
					<a href="<?php echo Router::url('admin/organizations/edit/'.$v->id); ?>">Editer</a>
					<a onclick="return confirm('Voulez vous vraiment supprimer ce contenu'); " href="<?php echo Router::url('admin/organizations/delete/'.$v->id); ?>">Supprimer</a>
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

<a href="<?php echo Router::url('admin/organizations/edit'); ?>" class="primary btn">Ajouter une organisation</a>

