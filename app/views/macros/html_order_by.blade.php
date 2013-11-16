<a href="{{ $url }}">
	{{ $title }}

	<span class="pull-right text-muted">
		@if(Input::get('orderBy') == $field)
			@if(Input::get('orderDir') == 'desc')
				{{ HTML::icon('arrow-down') }}
			@else
				{{ HTML::icon('arrow-up') }}
			@endif
		@else
			{{ HTML::icon('sort') }}
		@endif
	</span>
</a>
