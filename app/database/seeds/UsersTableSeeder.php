<?php

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create Admins
        $adminGroup = Sentry::getGroupProvider()->findByName('admin');

        Sentry::register(array(
                'first_name' => 'Super',
                'last_name' => 'User',
                'email' => 'superuser@example.com',
                'password' => 'password',
                'permissions' => array(
                    'superuser' => 1
                )
        ), true)->addGroup($adminGroup);

        Sentry::register(array(
                'first_name' => 'Thomas',
                'last_name' => 'Welton',
                'email' => 'thomaswelton@me.com',
                'password' => substr(md5(uniqid()), 0, 16),
                'permissions' => array(
                    'superuser' => 1
                )
        ), true)->addGroup($adminGroup);

        Sentry::register(array(
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@example.com',
                'password' => 'password'
        ), true)->addGroup($adminGroup);

        // Create Users
        $userGroup = Sentry::getGroupProvider()->findByName('user');

        Sentry::register(array(
                'first_name' => 'Example',
                'last_name' => 'User',
                'email' => 'user@example.com',
                'password' => 'password'
        ), true)->addGroup($userGroup);
    }
}
