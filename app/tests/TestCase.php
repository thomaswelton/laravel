<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
    * Default preparation for each test
    */
    public function setUp()
    {
        parent::setUp();

        $this->prepareForTests();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

        return require __DIR__.'/../../bootstrap/start.php';
    }

    /**
     * Migrate the database
     */
    private function prepareForTests()
    {
        Mail::pretend(true);

        Artisan::call('migrate');
        Artisan::call('db:seed');
    }
}
