<?php namespace Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use \View;
use \HTML;

class EntriesListView extends AbstractListView
{
	public $columns = array(
		'id' => 'ID',
		'location_id' => 'location_id',
		'guess' => 'Guess',
		'firstname' => 'First Name',
		'surname' => 'Last Name',
		'email' => 'Email',
	);

	public $orderable = array(
		'id',
		'location_id',
		'guess',
		'firstname',
		'surname',
		'email',
	);

	public function __construct($query){
		parent::__construct($query);
	}

	public function getFilters(){
		return array(
			'all' => null,
			'correct' => function($query) {
				$query->where('entries.correct', '=', 1);
			},
			'incorrect' => function($query) {
				$query->where('entries.correct', '=', 0);
			}
		);
	}

	// Searchable columns
	public function search($search){
		$this->query->where(function($query) use ($search)
		{
			$query->where('entries.email', 'LIKE', '%' . $search . '%');
			$query->orWhere('entries.email', 'LIKE', '%' . $search . '%');
		});
	}
}
