<div class="page-header row">
    <div class="col-sm-7">
        <h1><?= $header ?> <?php if(isset($subtitle)){ echo '<small>' . $subtitle . '</small>'; } ?></h1>
    </div>

	<?php if(isset($button)): ?>
		<div class="col-sm-5 pull-left">
		    <span class="pull-right">
		        <div class="btn-group">
		        	<?php if(in_array('new', $button)): ?>
		          		<a class="btn btn-success" href="<?= URL::action(explode('@', (Route::currentRouteAction()))[0] . '@create') ?>"><?= HTML::icon('plus-sign') ?><br />New</a>
		          	<?php endif; ?>
		          	<?php if(in_array('csv', $button)): ?>
		          		<a class="btn btn-info" href="<?= Request::url() . '?format=csv' ?>"><?= HTML::icon('download-alt') ?><br />CSV</a>
		          	<?php endif; ?>
		          	<?php if(in_array('deleted', $button)): ?>
		          		<a class="btn btn-danger" href="<?= Request::url() . '?trashed=true' ?>"><?= HTML::icon('trash') ?><br />Trash</a>
		          	<?php endif; ?>
		          	<?php if(in_array('current', $button)): ?>
		          		<a class="btn btn-primary" href="<?= Request::url() ?>"><?= HTML::icon('record') ?><br />Current</a>
		          	<?php endif; ?>
		        </div>
		    </span>
		</div>
	<?php endif ?>
</div>
