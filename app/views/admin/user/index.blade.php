@extends('admin.layouts.default')

@section('content')
    {{ HTML::page_header('Users')->with('button', array('new', 'csv'))}}

    <?= HTML::flash() ?>

    <?= $users->renderTable()->with('actions', array('edit', 'delete')) ?>
@stop
