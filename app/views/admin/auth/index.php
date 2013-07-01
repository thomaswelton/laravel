<div class="page-header">
  	<h1>
  		<span>Admin Users</span>

		<span class="pull-right">
  			<a class="btn" data-ajax-nav=false href="<?= 'admin/entries/csv' . '?' . $_SERVER['QUERY_STRING'] ?>">
  				<i class="icon-download-alt"></i>  Download CSV
  			</a>

  			<a class="btn btn-success" href="/admin/auth/add">New Entry</a>
  		</span>
  	</h1>
</div>

<?= HTML::flash() ?>

<table class="table table-striped table-bordered table-hover table-valign-middle" valign="middle">
	<tr>
		<th width=65>ID</th>
		<th>Username</th>
		<th width=65></th>
	</tr>
	
	<?php foreach ($users as $user): ?>
		<tr>
			<td><?= $user->id ?></td>
			<td><?= $user->username ?></td>
			<td class="text-center">
				<a class="btn btn-primary btn-small btn-block" href="<?= 'admin/entries/edit/' . $user->id ?>"><i class="icon-pencil icon-white"></i>  Edit</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>