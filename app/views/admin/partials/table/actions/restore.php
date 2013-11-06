<?= Form::open(array('url' => Request::url() . '/restore/' . $row->id, 'method' => 'POST')) ?>
    <button class="btn btn-link unstyled-link" type="submit"  data-toggle="tooltip" data-trigger="hover" data-placement="auto" title="Restore"><?= HTML::icon('refresh') ?></button>
<?= Form::close() ?>
