<?php

class UsersTableSeeder extends Seeder {

    public function run(){

		User::create(array(
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ))->roles()->attach(1);

        User::create(array(
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ))->roles()->attach(2);

		User::create(array(
                'username' => 'superadmin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ))->roles()->attach(3);
	}
}