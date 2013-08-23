<?= HTML::page_header('Config') ?>

<?= HTML::flash() ?>


<ul class="nav nav-tabs">
	<li class="<?php if($tab == 'site') echo 'active' ?>">
		<a href="<?= url('admin/config/site') ?>">Site</a>
	</li>
	<li class="<?php if($tab == 'laravel-facebook') echo 'active' ?>">
		<a href="<?= url('admin/config/laravel-facebook') ?>">Facebook</a>
	</li>
	<li class="<?php if($tab == 'laravel-google-analytics') echo 'active' ?>">
		<a href="<?= url('admin/config/laravel-google-analytics') ?>">Google Analytics</a>
	</li>
</ul>
<br>
<div class="tab-content">
	<div class="tab-pane active">
		<?= $form ?>
	</div>
</div>
