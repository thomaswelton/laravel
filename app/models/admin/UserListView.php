<?php namespace Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use \View;
use \HTML;

class UserListView extends AbstractListView
{
	public $columns = array(
		'avatar' => 'Avatar',
		'first_name' => 'First Name',
		'last_name' => 'Last Name',
		'email' => 'Email',
	);

	public $orderable = array(
		'id',
		'first_name',
		'last_name',
		'email',
	);

	public function __construct($query){
		parent::__construct($query);
	}

	public function getFilters(){
		return array(
			'all' => null,
			'admins' => function($query) {
				$query->where('users_groups.group_id', '=', 1);
			},
			'users' => function($query) {
				$query->where('users_groups.group_id', '=', 2);
			}
		);
	}

	public function joinTables(){
		$this->query->select('users.*');
		$this->query->leftJoin('oauth_facebook', 'oauth_facebook.user_id', '=', 'users.id');
		$this->query->leftJoin('users_groups', 'users_groups.user_id', '=', 'users.id');
	}

	// Searchable columns
	public function search($search){
		$this->query->where(function($query) use ($search)
		{
			$query->where('users.email', 'LIKE', '%' . $search . '%');
			$query->orWhere('oauth_facebook.oauth_uid', 'LIKE', '%' . $search . '%');
		});
	}



	/*****************
	* Data Getters
	******************/

	public function getAvatarData($row){
		return $row->getAvatar(50);
	}

	public function getAvatarHTML($row){
		return '<img src="' . $this->getColumnData($row, 'avatar') . '" width=50 height=50 alt="' . $row->user . '" class="img-rounded">';
	}

	public function getEmailHTML($row){
		return HTML::mailto($row->email);
	}

}
