<?php
	$filters = $table->getFilters();
	$paginatedData = $table->paginate();
	$possibleQueryVariables = array('search', 'filter', 'orderBy', 'orderDir', 'perPage');

	$paginationAppends = array();

	foreach ($possibleQueryVariables as $key) {
		if(Input::has($key)){
			$paginationAppends[$key] = Input::get($key);
		}
	}
?>

@if(count($paginatedData) == 0)
	No Data
@else
	<div class="row">
		@if(count($filters) > 1)
			<div class="col-xs-7 pull-left">
				<div class="btn-group">
					@foreach($filters as $name => $filter)
						<?php
							$url = new \Purl\Url(Request::fullUrl());
		    				$url->query->set('filter', $name);
		    				$url->query->set('page', null);
						?>
						<a href="{{ $url }}" class="btn <?= (Input::get('filter') == $name || (!Input::has('filter') && !is_callable($filter))) ? 'btn-primary' : 'btn-default'; ?>">{{ Str::studly($name) }}</a>
					@endforeach
				</div>
			</div>
		@endif

		@if(method_exists($table, 'search'))
			<div class="col-xs-5 pull-right">
				{{ Form::open(array('method' => 'GET')) }}
					@foreach ($possibleQueryVariables as $key)
						@if(Input::has($key))
							<input type="hidden" name="{{ $key }}" value="{{ Input::get($key) }}">
						@endif
					@endforeach

					<div class="input-group">
						<input type="text" name="search" class="form-control input-sm" value="{{ Input::get('search') }}">
						<span class="input-group-btn">
							@if(Input::has('search'))
								<?php
									$url = new \Purl\Url(Request::fullUrl());
				    				$url->query->set('search', null);
								?>
								<a href="{{ $url }}" class="btn btn-default btn-sm" type="submit">{{ HTML::icon('remove') }}</a>
							@endif

							<button class="btn btn-default btn-sm" type="submit">{{ HTML::icon('search') }}</button>
						</span>
					</div>
				{{ Form::close() }}
			</div>
		@endif
	</div>

	<br>

	<div class="table-responsive">
	    <table class="<?= $table->getName() ?> table table-striped table-bordered table-hover table-valign-middle table-fixed" valign="middle">
	        <tr>
	        	@foreach ($table->getColumns() as $field => $column)
					<th class="{{ snake_case(str_replace('.', '_', $field)) }}">
						@if($table->isOrderable($field))
							{{ HTML::order_by($field, $column) }}
						@else
							{{ $column }}
						@endif
					</th>
	        	@endforeach

	        	@if(isset($actions))
					<th class="text-center text-muted table-actions" colspan="{{ count($actions) }}">Actions</th>
	        	@endif
	        </tr>

			@foreach ($paginatedData as $row)
				<tr>
					@foreach ($table->getColumns() as $field => $column)
						<td class="{{ $field }}">{{ $table->getColumnHTML($row, $field) }}</td>
		        	@endforeach

		        	@if(isset($actions))
						@foreach ($actions as $action)
							<td class="row-action">
								@if(is_callable($action))
									{{ $action($row) }}
								@else
									<?php
									$view = 'admin.partials.table.actions.' . $action;
									if(View::exists($view)){
										echo View::make($view, array('row' => $row));
									}else{
										throw new Exception('Admin action "' . $action . '" not defined. Create a view here app/views/admin/partials/table/actions/' . $action . '.php');
									}
									?>
								@endif
							</td>
						@endforeach
		        	@endif

		        </tr>
	        @endforeach
	    </table>
	</div>

	{{ $paginatedData->appends($paginationAppends)->links() }}
@endif
