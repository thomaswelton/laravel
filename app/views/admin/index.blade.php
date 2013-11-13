@extends('admin.layouts.default')

@section('content')
	{{ HTML::page_header('Administration') }}
	{{ HTML::flash() }}

	@if (Auth::check() && !is_object(Auth::user()->facebook))
		<h2>Link your accounts</h2>
		<p class="lead">Want a simpler faster login?</p>
		<p>Link your Facebook profile to your account and get a one click login to the admin tool</p>
		<a href="<?= OAuth::associate('facebook')->redirect(Request::url()) ?>" class="btn btn-primary">Link accounts</a>
	@endif
@stop


