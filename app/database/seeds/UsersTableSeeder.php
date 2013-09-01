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
                'email' => 'thomas.welton@helloworldlondon.co.uk',
                'password' => substr(md5(uniqid()), 0, 16),
                'permissions' => array(
                    'superuser' => 1
                )
        ), true);

        Sentry::register(array(
                'email' => 'david.thingsaker@helloworldlondon.co.uk',
                'password' => substr(md5(uniqid()), 0, 16),
                'permissions' => array(
                    'superuser' => 1
                )
        ), true);

        // Create Admins
        $adminGroup = Sentry::getGroupProvider()->findByName('admin');

        $rod = Sentry::register(array(
                'email' => 'rod.pereira@helloworldlondon.co.uk',
                'password' => substr(md5(uniqid()), 0, 16)
        ), true);

        $rod->addGroup($adminGroup);

        $jose = Sentry::register(array(
                'email' => 'jose.galan@helloworldlondon.co.uk',
                'password' => substr(md5(uniqid()), 0, 16)
        ), true);

        $jose->addGroup($adminGroup);

        $sanjay = Sentry::register(array(
                'email' => 'sanjay.vadher@helloworldlondon.co.uk',
                'password' => substr(md5(uniqid()), 0, 16)
        ), true);

        $sanjay->addGroup($adminGroup);

        // Create Users
        $userGroup = Sentry::getGroupProvider()->findByName('user');

        $user = Sentry::register(array(
                'email' => 'user@example.com',
                'password' => 'password'
        ), true);

        $user->addGroup($userGroup);
    }
}
