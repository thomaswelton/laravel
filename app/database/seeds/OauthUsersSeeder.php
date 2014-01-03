<?php

use Thomaswelton\LaravelOauth\Eloquent\Facebook;

class OauthUsersSeeder extends Seeder
{
    public function run()
    {
    	$thomaswelton_id = DB::table('users')->where('email', '=', 'thomaswelton@me.com')->pluck('id');

        Facebook::create(array(
            'user_id' => $thomaswelton_id,
            'oauth_uid' => '197814607'
        ));
    }
}
