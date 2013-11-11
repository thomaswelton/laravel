<a 	class="btn btn-link unstyled-link"
	href="<?= Request::url() . '/' . $row->id ?>/edit"
	data-toggle="tooltip"
	data-trigger="hover"
	data-placement="auto"
	title="Edit <?= ucfirst(get_class($row)) ?>">
		<?= HTML::icon('pencil') ?>
</a>
