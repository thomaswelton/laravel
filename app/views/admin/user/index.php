<div class="page-header">
  	<h1>
  		<span>Admin Users</span>

		<span class="pull-right">
  			<a class="btn" data-ajax-nav=false href="<?= 'admin/entries/csv' . '?' . $_SERVER['QUERY_STRING'] ?>">
  				<i class="icon-download-alt"></i>  Download CSV
  			</a>

  			<a class="btn btn-success" href="/admin/users/create">New Entry</a>
  		</span>
  	</h1>
</div>

<?= HTML::flash() ?>

<table class="table table-striped table-bordered table-hover table-valign-middle" valign="middle">
	<tr>
		<th width=65>ID</th>
		<th>Username</th>
		<th width=80></th>
	</tr>
	
	<?php foreach ($users as $user): ?>
		<tr>
			<td><?= $user->id ?></td>
			<td><?= $user->username ?></td>
			<td class="text-center">
				<?= Form::open(array('url' => '/admin/users/'.$user->id, 'method' => 'delete')) ?>
					<a class="btn btn-link" href="<?= '/admin/users/'.$user->id .'/edit'?>"><i class="icon-pencil icon-white"></i></a>
					<button class="btn btn-link" type="submit"><i class="icon-trash"></i></button>
				<?= Form::close() ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>