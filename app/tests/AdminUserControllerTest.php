<?php

class AdminUserControllerTest extends TestCase
{
    public function testUserIndexPageWithNoData()
    {
        $this->client->request('GET', 'admin/users');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testUserIndexPageWithPaginatedData()
    {
        for ($i=0; $i < 20; $i++) {
            $this->factory->create('User');
        }

        $this->client->request('GET', 'admin/users');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testUserCsvDownload()
    {
        $this->factory->create('User');

        $this->client->request('GET', 'admin/users?&format=csv');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testUserCreatePage()
    {
        $this->client->request('GET', 'admin/users/create');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testUserEditPage()
    {
        $user = $this->factory->create('User');

        $this->client->request('GET', "admin/users/{$user->id}/edit");
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testEditNonExistantUserRedirectsToUserList()
    {
        $this->client->request('GET', "admin/users/1/edit");
        $this->assertRedirectedTo('admin/users');
    }

    public function testUserEditFillsFormWithData()
    {
        $user = $this->factory->create('User');

        $this->client->request('GET', "admin/users/{$user->id}/edit");
        $this->assertTrue($this->client->getResponse()->isOk());

        $this->assertViewHas('user');
    }

    public function testDeleteUser()
    {
        $user = $this->factory->create('User');

        // Check redirect back to list view
        $this->client->request('DELETE', "admin/users/{$user->id}");
        $this->assertRedirectedTo('admin/users');

        $deletedUser = User::find($user->id);

        $this->assertNull($deletedUser);
    }

    public function testRestoreUser()
    {
        $user = $this->factory->create('User');
        $user->delete();

        // Check redirect back to list view
        $this->client->request('POST', "admin/users/restore/{$user->id}");
        $this->assertRedirectedTo('admin/users');
    }

    public function testValidUpdateSavesDataAndRedirectsToList()
    {
        $user = $this->factory->create('User');

        $last_name = 'Otwell';

        // Assert the exisiting values do not match
        $this->assertFalse($user->last_name === $last_name);

        // Update values to POST
        $updateData = $user->toArray();
        $updateData['last_name'] = $last_name;

        // Check redirect back to list view
        $this->client->request('PUT', "admin/users/{$user->id}", $updateData);
        $this->assertRedirectedTo('admin/users');

        // Find the user again
        $user = User::find($user->id);

        // Check the details have been updated
        $this->assertTrue($user->last_name === $last_name);

        //Check redirect
        $this->assertRedirectedTo('admin/users');
    }

}
