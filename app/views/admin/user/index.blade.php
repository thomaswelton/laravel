@extends('admin.layouts.default')

@section('content')
    <div class="page-header row">
        <div class="col-sm-7">
            <h1>Users</h1>
        </div>

        <div class="col-sm-5 pull-left">
            <span class="pull-right">
                <div class="btn-group">
                    <a class="btn btn-info" href="<?= Request::fullUrl() ?>?&amp;format=csv"><?= HTML::icon('download-alt') ?> Download CSV</a>
                    <a class="btn btn-success" href="/admin/users/create"><?= HTML::icon('plus-sign') ?> New Entry</a>
                </div>
            </span>
        </div>
    </div>

    <?= HTML::flash() ?>

    <?= $users->renderTable()->with('actions', array('edit', 'delete')) ?>
@stop
