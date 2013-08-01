<?php

class UsersTableSeeder extends Seeder {

    public function run(){

        Sentry::register(array(
                'email' => 'admin@example.com',
                'password' => 'password',
                'activated' => 1
        ));
	}
}