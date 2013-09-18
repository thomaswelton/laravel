<?php namespace App\Models;

use LaravelBook\Ardent\Ardent;
use \Cache;

class Config extends Ardent
{
    public static $rules = array(
        'name'     => 'required'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config';

    public function afterSave()
    {
    	Cache::forget('config:all');
    }

    public static function all($columns = array())
    {
    	return Cache::rememberForever('config:all', function(){
    		return parent::all();
    	});
    }
}
