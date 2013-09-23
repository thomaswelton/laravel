<?php namespace Thomaswelton\LaravelGoogleAnalytics;

use Illuminate\Support\ServiceProvider;

class LaravelGoogleAnalyticsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('thomaswelton/laravel-google-analytics');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['GoogleAnalytics'] = $this->app->share(function($app)
        {
            return new GoogleAnalytics;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}