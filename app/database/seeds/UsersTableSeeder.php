<?php

class UsersTableSeeder extends Seeder {

    public function run(){

		Sentry::register(array(
	            'email' => 'admin@example.com',
	            'password' => 'password',
	            'activated' => 1
	    ));

        for ($i=1; $i <= 5; $i++) {
        	Sentry::register(array(
	                'email' => 'admin' . $i . '@example.com',
	                'password' => 'password',
	                'activated' => 1
	        ));
        }
	}
}
