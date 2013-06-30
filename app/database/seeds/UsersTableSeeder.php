<?php

class UsersTableSeeder extends Seeder {

    public function run(){

		User::create(array(
                'username' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
	}
}