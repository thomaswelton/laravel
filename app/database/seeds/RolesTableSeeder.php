<?php

class RolesTableSeeder extends Seeder {

    public function run(){

		Role::create(array(
                'name' => 'User',
                'description' => 'Registered Users',
                'level' => 1
        ));

        Role::create(array(
                'name' => 'Admin',
                'description' => 'Administrators',
                'level' => 2
        ));

        Role::create(array(
                'name' => 'Super Administrators',
                'description' => 'Super Admins',
                'level' => 3
        ));
	}
}