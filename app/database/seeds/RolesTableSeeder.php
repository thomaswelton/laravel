<?php

class RolesTableSeeder extends Seeder {

    public function run(){

		Role::create(array(
                'name' => 'User',
                'description' => 'Registered Users',
                'level' => 1
        ));
	}
}