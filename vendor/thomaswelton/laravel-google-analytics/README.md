[![Build Status](https://travis-ci.org/thomaswelton/laravel-google-analytics.png?branch=master)](https://travis-ci.org/thomaswelton/laravel-google-analytics)
[![Latest Stable Version](https://poser.pugx.org/thomaswelton/laravel-google-analytics/v/stable.png)](https://packagist.org/packages/thomaswelton/laravel-google-analytics)
[![Total Downloads](https://poser.pugx.org/thomaswelton/laravel-google-analytics/downloads.png)](https://packagist.org/packages/thomaswelton/laravel-google-analytics)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/thomaswelton/laravel-google-analytics/trend.png)](https://bitdeli.com/free "Bitdeli Badge")


# Installation

Update your `composer.json` file to include this package as a dependency
```json
"thomaswelton/laravel-google-analytics": "dev-master"
```

Register the GoogleAnalytics service provider by adding it to the providers array in the `app/config/app.php` file. 
```
Thomaswelton\LaravelGoogleAnalytics\LaravelGoogleAnalyticsServiceProvider
```

Alias the GoogleAnalytics facade by adding it to the aliases array in the `app/config/app.php` file. 
```php
'aliases' => array(
	'GoogleAnalytics' => 'Thomaswelton\LaravelGoogleAnalytics\Facades\GoogleAnalytics'
)
```

# Configuration

Copy the config file into your project by running
```
php artisan config:publish thomaswelton/laravel-google-analytics
```

Edit the config file to include your account ID
