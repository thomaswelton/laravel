<?php

class AuthControllerTest extends TestCase
{
    public function testLoginRoute()
    {
        $this->client->request('GET', URL::action('AuthController@getLogin'));
        $this->assertResponseOk();
    }

    public function testLoginRouteRedirectsWhenLoggedIn()
    {
        Route::enableFilters();
        $user = $this->factory->create('user');

        Sentry::login($user);

        $this->client->request('GET', URL::action('AuthController@getLogin'));
        $this->assertRedirectedTo('/');
    }

    public function testLogoutRouteLogsOutAndRedirects(){
        $user = $this->factory->create('user');
        Sentry::login($user);

        // Check the user is logged in
        $this->assertTrue(Auth::check());

        // Check the log out action redirects
        $this->client->request('GET', URL::action('AuthController@getLogout'));
        $this->assertRedirectedTo('/');

        // Check the sue is now logged out
        $this->assertFalse(Auth::check());
    }

    public function testForgotPasswordRoute(){
        $this->client->request('GET', URL::action('AuthController@getForgot'));
        $this->assertResponseOk();
    }

    public function testRestPasswordRoute(){
        $this->client->request('GET', URL::action('AuthController@getReset'));
        $this->assertResponseOk();
    }

    public function testResetDonePasswordRoute(){
        $this->client->request('GET', URL::action('AuthController@getDone'));
        $this->assertResponseOk();
    }

}
