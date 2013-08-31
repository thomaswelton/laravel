<?php

class GroupsTableSeeder extends Seeder
{
    public function run()
    {
        Sentry::getGroupProvider()->create(array(
            'name'        => 'admin',
            'permissions' => array(
                'admin' => 1,
                'users' => 1,
            ),
        ));

        Sentry::getGroupProvider()->create(array(
            'name'        => 'user',
            'permissions' => array(
                'admin' => 0,
                'users' => 1,
            ),
        ));
    }
}
