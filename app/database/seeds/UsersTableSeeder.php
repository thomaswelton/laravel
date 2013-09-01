<?php

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create Admins
        $adminGroup = Sentry::getGroupProvider()->findByName('admin');

        Sentry::register(array(
                'email' => 'superuser@example.com',
                'password' => 'password',
                'permissions' => array(
                    'superuser' => 1
                )
        ), true);

        Sentry::register(array(
                'email' => 'thomaswelton@me.com',
                'password' => substr(md5(uniqid()), 0, 16),
                'permissions' => array(
                    'superuser' => 1
                )
        ), true);

        // Create Admins
        $adminGroup = Sentry::getGroupProvider()->findByName('admin');

        $admin = Sentry::register(array(
                'email' => 'admin@example.com',
                'password' => 'password'
        ), true);

        $admin->addGroup($adminGroup);

        // Create Users
        $userGroup = Sentry::getGroupProvider()->findByName('user');

        $user = Sentry::register(array(
                'email' => 'user@example.com',
                'password' => 'password'
        ), true);

        $user->addGroup($userGroup);
    }
}
