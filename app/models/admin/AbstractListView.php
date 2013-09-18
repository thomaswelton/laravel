<?php namespace Admin;

use Illuminate\Support\Facades\Input;
use \View;
use \HTML;
use \Str;
use \DB;

class AbstractListView
{
	public function __construct($query){
		$this->query = $query;
	}

	public function applyFilter($filter){
		$filters = $this->getFilters();

		if(array_key_exists($filter, $filters)){

			$filterFunc = $filters[$filter];

			if(is_callable($filterFunc)){
				$filterFunc($this->query);
			}
		}
	}

	/*
	* Specify joins required to filter and search the data list
	 */
	public function joinTables(){

	}

	public function __call($method, $args){
		// Look for any getFieldData methods
		// return the default value
		if(preg_match("/^get(.*)Data/", $method, $matches)){
			$field = strtolower($matches[1]);
			return $args[0]->$field;
		}

		// Look for any getFieldHTML methods
		// return the default value
		if(preg_match("/^get(.*)HTML/", $method, $matches)){
			$field = strtolower($matches[1]);
			return $args[0]->$field;
		}
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function isOrderable($column)
	{
		return in_array($column, $this->orderable);
	}

	public function getName(){
		return Str::lower(class_basename(get_called_class()));
	}

	public function paginate($rows = 5){
		if(Input::has('filter') || Input::has('orderBy') || Input::has('search')){
			$this->joinTables();
		}

		// Sort the query by anything specified in the query string
		if(Input::has('orderBy')){
			// If order by is a string then order by the column for this model
			// Or if in dot notation order by the models relation

			$orderByParts = explode('.', Input::get('orderBy'));
			$direction = Input::get('orderDir', 'asc');

			if(count($orderByParts) == 1){
				$this->query->orderBy($orderByParts[0], $direction);
			}else{
				$model = $query->getModel();
				$relationName = $orderByParts[0];

				$relation = $this->query->getRelation($relationName);
				$related_table = $relation->getRelated()->getTable();

				$this->query->orderBy($related_table . '.' . $orderByParts[1], $direction);
			}
		}

		if(Input::has('search')){
			$this->search(Input::get('search'));
		}

		if(Input::has('filter')){
			$this->applyFilter(Input::get('filter'));
		}

		return $this->query->paginate(Input::get('perPage', $rows));
	}

	public function getColumnHTML($row, $field){
		$columnGetter = 'get' . ucfirst(str_replace('.', '_', $field)) . 'HTML';

		if(method_exists($this, $columnGetter)){
			return $this->$columnGetter($row);
		}

		return $this->getColumnData($row, $field);
	}

	public function getColumnData($row, $field){
		// The value may be an eloquent relation which we represent with dot notation
		// split the field into parts
		$parts = explode('.', $field);

		// If the field name is only one part use the getFieldHTML method
		// to get it's value
		if(count($parts) == 1){
			$getter = 'get'.ucfirst($field).'Data';
			return $this->$getter($row);
		}

		// Otherwise continue nesting inside the eloquent object to get the value
		foreach ($parts as $index => $part) {
			if($index == count($parts) - 1){
				// The eloquent relation may not have a value for this row
				// so check if it's an object
				if(is_object($row)) return $row->$part;
			}

			// If we haven't returned keep nesting
			if(is_object($row)) $row = $row->$part;
		}
	}

	public function renderTable(){
		return View::make('admin.partials.table', array(
			'table' => $this
		));
	}

	public function getCsvFile(){
		\DB::connection()->disableQueryLog();

		$tmpName = tempnam(storage_path(), 'csv');

        $csvFile = new \Keboola\Csv\CsvFile($tmpName);
        $csvFile->writeRow(array_values($this->columns));

		// Determine how many chunks to get
		$limit = 1000;
		$count = $this->query->count();
		$chunks = ceil($count / $limit);

		for ($i=0; $i < $chunks; $i++) {
			$this->query->take($limit)->skip($i * $limit);
			$data = $this->query->get();

			foreach ($data as $index => $row){
				$csvRow = array();

				foreach ($this->columns as $field => $column){
					$csvRow[] = $this->getColumnData($row, $field);
				}

				$csvFile->writeRow($csvRow);
			}
		}

		return $tmpName;
	}
}
