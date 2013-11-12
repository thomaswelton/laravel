<?php

class AdminHomeControllerTest extends TestCase
{

    public function testRoutes()
    {
        $crawler = $this->client->request('GET', '/admin');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testGuestRedirectedToLoginPage()
    {
        Route::enableFilters();

        $crawler = $this->client->request('GET', '/admin');
        $this->assertRedirectedTo('admin/login');
    }

    public function testLoggedInUserCantViewLoginPage(){
        // Assuming the first use is an admin
        Auth::loginUsingId(1);

        $crawler = $this->client->request('GET', '/admin/login');
        $this->assertRedirectedTo('admin');
    }

    public function testLoginRoute()
    {
        $crawler = $this->client->request('GET', '/admin/login');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testLogoutDestroysSession()
    {
        Auth::loginUsingId(1);

        // Assert the user was logged in
        $this->assertTrue(Auth::check());

        $crawler = $this->client->request('GET', '/admin/logout');
        $this->assertRedirectedTo('admin/login');

        // Assert use is now logged out
        $this->assertFalse(Auth::check());
    }

    public function testIncorrectLoginFails()
    {
        $crawler = $this->client->request('POST', '/admin/login');
        $this->assertRedirectedTo('admin/login');

        $this->assertSessionHas('error');
    }

}
