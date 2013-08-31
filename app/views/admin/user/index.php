<div class="page-header">
      <h1>
          <span>Admin Users</span>

        <span class="pull-right">
              <div class="btn-group">
                  <a class="btn btn-info" href="/admin/users?format=csv"><?= HTML::icon('download-alt') ?> Download CSV</a>
                  <a class="btn btn-success" href="/admin/users/create"><?= HTML::icon('plus-sign') ?> New Entry</a>
              </div>
          </span>
      </h1>
</div>

<?= HTML::flash() ?>

<table class="table table-striped table-bordered table-hover table-valign-middle" valign="middle">
    <tr>
        <th width=65>ID</th>
        <th width=50>Avatar</th>
        <th colspan=3>Email</th>
    </tr>

    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= Gravatar::image($user->email, $user->name, array('width' => 50, 'height' => 50)) ?></td>
            <td><?= $user->email ?></td>
            <td width=10 class="text-center">
                <a class="btn btn-link unstyled-link" href="<?= '/admin/users/'.$user->id .'/edit'?>"><?= HTML::icon('pencil') ?></a>
            </td>
            <td width=10 class="text-center">
                <?= Form::open(array('url' => '/admin/users/'.$user->id, 'method' => 'delete')) ?>
                    <button class="btn btn-link unstyled-link" type="submit"><?= HTML::icon('trash') ?></button>
                <?= Form::close() ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php echo $users->links(); ?>
