<?php namespace App\Models;

use LaravelBook\Ardent\Ardent;
use \Cache;

class Config extends Ardent
{
    public static $rules = array(
        'name'     => 'required'
    );

    public static $factory = array(
        'name' => 'string',
        'config' => '{"key":"value"}',
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'config';

    public static function afterSave()
    {
        Cache::forget('config:all');
    }

    public static function all($columns = array())
    {
        if(Cache::has('config:all')){
            return Cache::get('config:all');
        }else{
            $all = parent::all();
            return Cache::rememberForever('config:all', function() use ($all)
            {
                return $all;
            });
        }
    }

    public function updateValues()
    {
        $items = $this->all();

        foreach ($items as $item) {
            $name = $item->name;
            $values = json_decode($item->config);

            foreach ($values as $key => $value) {
                \Config::set($name . '::' . $key, $value);
            }
        }
    }
}
