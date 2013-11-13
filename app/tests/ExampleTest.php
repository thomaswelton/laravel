<?php

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testRoutes()
    {
        $this->client->request('GET', '/');

        $this->assertResponseOk();
    }

}
