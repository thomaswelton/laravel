<?php namespace Admin;

use \Entries;
use \Request;
use \Response;
use \View;
use \DB;

class EntriesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $query = DB::table('entries');

        $users = new EntriesListView($query);

        switch (Request::query('format')) {
            case 'csv':
                return Response::download($users->getCsvFile(), 'entries.csv');
                break;

            default:
                $this->layout->content = View::make('admin.entries.index', array(
                    'users' => $users
                ));
        }
    }
}
