<?php

class CacheModelTest extends TestCase{

	public function testConfigSavesToCache()
	{
		$config = App::make('App\\Models\\Config');

		$this->assertNull(Cache::get('config:all'));

		$config->all();

		$this->assertNotNull(Cache::get('config:all'));
	}

	public function testConfigReadsValuesFromCache()
	{
		Cache::forever('config:all', 'foo');
		$config = App::make('App\\Models\\Config');

		$value = $config->all();

		$this->assertSame('foo', $value);
	}

	/*
	public function testConfigCacheClearsOnSave()
	{
		Cache::forever('config:all', 'foo');

		$config = $this->factory->create('App\\Models\\Config');

		$this->assertNull(Cache::get('config:all'));
	}
	*/
}
