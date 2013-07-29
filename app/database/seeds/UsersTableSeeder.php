<?php

class UsersTableSeeder extends Seeder {

    public function run(){

		Sentry::register(array(
                'email' => 'user@example.com',
                'password' => 'password'
        ));

        Sentry::register(array(
                'email' => 'admin@example.com',
                'password' => 'password'
        ));

		Sentry::register(array(
                'email' => 'superadmin@example.com',
                'password' => 'password'
        ));
	}
}