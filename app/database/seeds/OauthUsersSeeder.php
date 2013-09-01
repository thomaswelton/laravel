<?php

use Thomaswelton\LaravelOauth\OAuthUser;

class OauthUsersSeeder extends Seeder
{
    public function run()
    {
    	$thomaswelton_id = DB::table('users')->where('email', '=', 'thomaswelton@me.com')->pluck('id');

        OAuthUser::create(array(
            'user_id' => $thomaswelton_id,
            'facebook_uid' => '197814607'
        ));
    }
}
