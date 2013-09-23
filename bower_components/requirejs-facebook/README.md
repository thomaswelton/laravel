# Bower Facebook
[![githalytics.com alpha](https://cruel-carlota.pagodabox.com/917637450c836ec0373668c8df3c3d06 "githalytics.com")](http://githalytics.com/thomaswelton/requirejs-facebook)
[![Build Status](https://travis-ci.org/thomaswelton/requirejs-facebook.png)](https://travis-ci.org/thomaswelton/requirejs-facebook)
[![Dependency Status](https://david-dm.org/thomaswelton/requirejs-facebook.png)](https://david-dm.org/thomaswelton/requirejs-facebook)


AMD compatible Bower component written in CoffeeScript.

## Setup

This module utilises requirejs module configuration. It requires the following JS to be added to the page

```javascript
requirejs.config({
	config:{
		'Facebook': {
			'appId'      	: 'APP_ID',
			'channelUrl'	: 'CHANNEL_URL',
			'autoResize'	: false	,
			'status'     	: true,
			'cookie'     	: true,
			'xfbml'			: true,
		}
	}
});
```

* appId - FB Application ID (required)
* channelUrl - Absolute URL to your Fb channel.html file (required)
* autoResize - true / false (optional)
* status - FB.init config (optional - default true)
* cookie - FB.init config (optional - default true)
* xfbml - FB.init config (optional - default true)

The contents of `config.Facebook` will be passed to the contructor of the Facebook module when loaded.
The Faceobok module scan then be loaded as a requirejs module. It returns a single instance of the Facebook module.

The Facebook SDK can be accessed directly via `Facebook.FB`
Or can be access through helpers and wrappers



#### Facebook.getAppId()

Returns the Facebook app ID, this would be the same as was passed in the config above, but is provided for convenience

#### Facebook.ui( data, cb = {} )

- data - JSON data with UI information
- cb - Callback (optional)

Wait for Facebook init then calls FB.ui. The first parameter is JSON, examples here http://developers.facebook.com/docs/reference/javascript/FB.ui/

```javascript
{
    method: 'feed',
    name: 'Facebook Dialogs',
    link: 'http://developers.facebook.com/docs/reference/dialogs/',
    picture: 'http://fbrell.com/f8.jpg',
    caption: 'Reference Documentation',
    description: 'Dialogs provide a simple, consistent interface for applications to interface with users.'
}
```

The second parameter is an optional callback fire on success or cancel of the UI


#### Facebook.logout()

Logs out a Facebook user

#### Facebook.uninstallApp()

Removes the application from the users account

#### Facebook.hasPermissions(str)

- str - Comma seperated string of permission

Checks to see if the user has all the permissions passed. Returns `true` or `false`

#### Facebook.requestPermission(scope, cb)

- scope - String, comma seperated list of permissions to request
- cb - Callback (optional)

Will trigger a Facebook permissions popup http://developers.facebook.com/docs/reference/dialogs/oauth/ asking for the permissions passed in via `scope` calla an optinal callback on success or fail

#### Facebook.login(obj)

Logs in a Facebook user where obj is as follow

```javascript
{
	scope: 'email',
	onLogin: function(){},
	onCancel: function(){}
}
```

Logs in a user, requests the permissions from `obj.scope`. Or promopts user that already logged in to grant additional permissions. Or will call back immediaetly if the user was already loggedin and had granted all perms


#### Facebook.getLoginStatus()

Wrapper for http://developers.facebook.com/docs/reference/javascript/FB.getLoginStatus/

#### Facebook.fbApi(query,cb)

- query - (string) query to run against FB.api
- cb - (function) callback function (optional)

Calls FB.api on ready, and will `console.warn` you of any API errors


#### Facebook.getUserInfo(data, cb)

- data - (array) Array of fields to get user data for http://developers.facebook.com/docs/reference/api/user/
- cb - (function) Callback (optional)

Will try to get user information. You may not get all the information you requested for.

#### Facebook.requireUserInfo(data, cb)

- data - (array) Array of fields to get user data for http://developers.facebook.com/docs/reference/api/user/
- cb - (function) Callback (optional)

Same as above, but will prompt the user for permissions they have not already granted before trying to getUserInfo, becasue this triggers a pop up it should only be run after a user interaction to avoid pop up blockers


#### Facebook.onReady(cb)

- cb - (function) Calback to fire when Facebook is fullyloaded, is passed FB as an arg

Useage

```javascript
Facebook.onReady(function(FB){
	// FB is fully loaded
});
```


#### Facebook.renderPlugins()

Renders facebook social plugins

#### Facebook.setCanvasSize(width, height)

Sets the Facebook canvas dimensions


## Deployment to Heroku

Using travis we can run tests and deploy the latest code to Heroku
Get your API key, install the travis gem and encrypt your API_KEY, update your .travis.yml with this new key.

```
heroku auth:token
gem install travis
travis encrypt HEROKU_API_KEY=<your_heroku_key>
```
