<?php

use Thomaswelton\LaravelOauth\Eloquent\Facebook;

class OauthUsersSeeder extends Seeder
{
    public function run()
    {
    	$thomaswelton_id = DB::table('users')->where('email', '=', 'thomas.welton@helloworldlondon.co.uk')->pluck('id');

        Facebook::create(array(
            'user_id' => $thomaswelton_id,
            'oauth_uid' => '197814607'
        ));

        $davidthingsaker_id = DB::table('users')->where('email', '=', 'david.thingsaker@helloworldlondon.co.uk')->pluck('id');

        Facebook::create(array(
            'user_id' => $davidthingsaker_id,
            'oauth_uid' => '654073184'
        ));

        $rodrigopereira_id = DB::table('users')->where('email', '=', 'rod.pereira@helloworldlondon.co.uk')->pluck('id');

        Facebook::create(array(
            'user_id' => $rodrigopereira_id,
            'oauth_uid' => '698197555'
        ));

        $josegalan_id = DB::table('users')->where('email', '=', 'jose.galan@helloworldlondon.co.uk')->pluck('id');

        Facebook::create(array(
            'user_id' => $josegalan_id,
            'oauth_uid' => '751343474'
        ));

        $sanjayvadher_id = DB::table('users')->where('email', '=', 'sanjay.vadher@helloworldlondon.co.uk')->pluck('id');

        Facebook::create(array(
            'user_id' => $sanjayvadher_id,
            'oauth_uid' => '564396195'
        ));
    }
}
