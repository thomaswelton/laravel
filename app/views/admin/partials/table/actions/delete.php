<?= Form::open(array('url' => Request::url() . '/' . $row->id, 'method' => 'delete')) ?>
    <button class="btn btn-link unstyled-link" type="submit"  data-toggle="tooltip" data-trigger="hover" data-placement="auto" title="Delete <?= ucfirst(get_class($row)) ?>"><?= HTML::icon('trash') ?></button>
<?= Form::close() ?>
