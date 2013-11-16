<div class="page-header row">
    <div class="col-sm-7">
        <h1>
        	{{ $header }}

			@if(isset($subtitle))
				<small>{{ $subtitle }}</small>
			@endif
        </h1>
    </div>

	@if(isset($button))
		<div class="col-sm-5 pull-left">
		    <span class="pull-right">
		        <div class="btn-group">
		        	@if(in_array('new', $button))
		          		<a class="btn btn-success"
		          			href="<?= URL::action(explode('@', (Route::currentRouteAction()))[0] . '@create') ?>"><?= HTML::icon('plus-sign') ?><br />New</a>
		          	@endif

		          	@if(in_array('csv', $button))
		          		<a class="btn btn-info" href="<?= Request::url() . '?format=csv' ?>"><?= HTML::icon('download-alt') ?><br />CSV</a>
		          	@endif

		          	@if(in_array('deleted', $button))
		          		<a class="btn btn-danger" href="<?= Request::url() . '?trashed=true' ?>"><?= HTML::icon('trash') ?><br />Trash</a>
		          	@endif

		          	@if(in_array('current', $button))
		          		<a class="btn btn-primary" href="<?= Request::url() ?>"><?= HTML::icon('record') ?><br />Current</a>
		          	@endif

		        </div>
		    </span>
		</div>
	@endif
</div>
