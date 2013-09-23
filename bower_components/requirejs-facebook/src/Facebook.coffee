define ['module', 'EventEmitter', 'mootools'], (module, EventEmitter) ->
	class Facebook extends EventEmitter
		constructor: (@permissionsMap, @config) ->
			## Init EventEmitter
			super()
			
			if !@config.appId?
				console.warn 'No Facebook app ID found in requirejs module config'
				return false


			## Used as a default for functions 
			## That accept a callback
			@cb = (args...) -> console.log 'No callback specifed for the data', args...

			## Init Facebook
			console.log 'Facebook init'

			if @config.appId.toString().trim().length is 0
				console.warn 'No Facebook app ID found in config'

			defaults = 
				status     : true
				cookie     : true
				xfbml      : true

			## Merge default values
			for key, value of @config
				defaults[key] = value

			@config = defaults
			@api = null
			@isIframe = top isnt self

			if FB?
				@fbAsyncInit()
			else
				window.fbAsyncInit = @fbAsyncInit
				@injectFB()


			###
			Set a cookie for our domain using a pop up
			window where required. Required when using
			Safari on a FB iframe application where
			3rd party cookies are blocked
			###

			if window.self isnt window.top && document.cookie.length is 0
				channelUrl = @config.channelUrl

				setCookie = () ->
					## Open popup to the channel.html
					## set a cookie in the popup
					
					popUpLocation = channelUrl
					console.log popUpLocation
					popUpOptions = "height=200,width=150,directories=no,location=no,menubar=no,resizable=no,scrollbars=no,status=no,titlebar=no,toolbar=no"
					handle = window.open popUpLocation, '_blank', popUpOptions

					if handle && handle.top
						## popup has opened
						handle.document.cookie = 'facebookjs=1;'
						handle.close()

						document.body.removeEvent 'click:relay(*)', setCookie


				document.body.addEvent 'click:relay(*)', setCookie

			###
			###

		getAppId: () => @config.appId

		getAccessToken: (cb = @cb) =>
			@onReady (FB) => 
				authResponse = FB.getAuthResponse()
				if authResponse? and authResponse.accessToken?
					return cb authResponse.accessToken
				
				return cb false


		ui: (data, cb = @cb) =>
			@onReady (FB) ->
				FB.ui data, cb
		
		logout: (cb = @cb) =>
			@onReady (FB) =>
				console.log @loginStatus
				if @loginStatus?.status? and @loginStatus.status is 'connected'	
					FB.logout (response) ->
						cb response
				else
					console.warn 'User is already logged out'
					cb()

		hasPermissions: (perms) =>
			return true if perms.trim().length is 0
			return false if !@grantedPermissions? or @grantedPermissions.length is 0

			permsArray = perms.split(',')

			intersection = (a, b) ->
				[a, b] = [b, a] if a.length > b.length
				value for value in a when value in b

			grantedPerms = intersection permsArray, @grantedPermissions
		
			return grantedPerms.length is permsArray.length

		requestPermission: (scope, cb = @cb) =>
			FB.ui
				method: 'oauth'
				scope: scope,
				display: 'popup'
			, () =>
				@getPermissions()
				cb()

		login: (obj) =>
			scope = if obj.scope? then obj.scope.trim() else ''
			onLogin = if obj.onLogin? then obj.onLogin else () ->
			onCancel = if obj.onCancel? then obj.onCancel else () ->

			@onReady (FB) =>
				## If already logged
				if @loginStatus?.status? and @loginStatus.status is 'connected'
					## Check the user has granted all perms in scope
					if @hasPermissions scope
						## Granted all required perms, callback
						onLogin @loginStatus.authResponse
					else
						## Prompt for required perms
						console.log 'request', scope

						@requestPermission scope, (response) =>
							## User may not have granted all perms
							onLogin @loginStatus.authResponse
				else
					## Login the user
					FB.login (response) ->
						if response.authResponse
							onLogin response.authResponse
						else 
							onCancel()
					, { scope : scope }

		getLoginStatus: (cb = @cb) =>
			FB.getLoginStatus (@loginStatus) =>
				console.log "Login Status:", @loginStatus
				cb @loginStatus

		uninstallApp: (cb = @cb) =>
			@onReady (FB) =>
				FB.api 'me/permissions', 'delete', (response) =>
					if response.error?
						console.warn response.error.message, "query: delete me/permissions"
						return cb false

					cb response

		fbApi: (query, cb = @cb) =>
			@onReady (FB) =>
				FB.api query, (response) =>
					if response.error?
						console.warn response.error.message, "query: #{query}"
						return cb false

					cb response
					
		getPermissions: (cb = @cb) =>
			@fbApi '/me?fields=permissions', (response) =>
				if response
					@grantedPermissions = (permission for permission of response.permissions.data[0])
					cb @grantedPermissions
				else
					cb false


		getUserInfo: (data, cb = @cb) =>
			if !@loginStatus?
				## If the user log status is unknown wait and run on callback
				@once 'onStatusChange', () =>
					## Call ourself with the info passed to us
					@getUserInfo data, cb

			else if @loginStatus.status is 'connected'
				## If the user is know and /me is valid
				fields = data.join(',')
				@fbApi "/me?fields=#{fields}", (response) =>
					cb response

			else
				cb {}	

		requireUserInfo: (data, cb = @cb) =>
			requiredPermissions = (@permissionsMap[field] for field in data when @permissionsMap[field]?)
			requiredScope = requiredPermissions.join(',')

			getInfo = () => @getUserInfo data, cb

			@onReady (FB) =>
				if @loginStatus.status isnt 'connected'
					@login 
						scope: requiredScope
						onLogin: () =>
							@getPermissions getInfo
				else
					if @hasPermissions requiredScope
						getInfo()
					else
						@requestPermission requiredScope, getInfo
				

		onReady: (callback = @cb) =>
			if @fbReady?
				callback FB
			else
				@once 'fbInit', () =>
					callback FB

		fbAsyncInit: () =>
			@fbInit()
			@fbiFrameInit() if @isIframe

		fbInit: () =>
			FB.init @config
			@fbReady = true

			return if @config.appId.trim().length is 0

			@getLoginStatus (loginStatus) =>
				if loginStatus.status is 'connected'
					@getPermissions () => @fireEvent 'fbInit'
				else
					@fireEvent 'fbInit'

			FB.Event.subscribe 'auth.login', (@loginStatus) =>
				console.log 'FB.Event: auth.login'
				@fireEvent 'onLogin'

			FB.Event.subscribe 'auth.logout', () =>
				@fireEvent 'onLogout'

			FB.Event.subscribe 'auth.statusChange', (@loginStatus) =>
				console.log 'FB.Event: auth.statusChange'
				@fireEvent 'onStatusChange'

			FB.Event.subscribe 'auth.authResponseChange', (@loginStatus) =>
				console.log 'FB.Event: auth.authResponseChange'
				@fireEvent 'onAuthChange', (@loginStatus.status is 'connected')

			FB.Event.subscribe 'edge.create', (url) =>
				@fireEvent 'onLike', url

			FB.Event.subscribe 'edge.remove', (url) =>
				@fireEvent 'onUnlike', url

		fbiFrameInit: () =>
			FB.Canvas.scrollTo 0,0
			FB.Canvas.setSize
				width: 810
				height: document.documentElement.offsetHeight
			
			if @config.autoResize? and @config.autoResize
				resizeInterval = () =>
					@setCanvasSize 810, document.documentElement.offsetHeight

				window.setInterval resizeInterval, 500

		injectFB: () ->
			return if document.getElementById 'facebook-jssdk'

			if !document.getElementById 'fb-root'
				root = document.createElement 'div'
				root.setAttribute 'id','fb-root'

				document.body.appendChild root

			## Allows us to load the SDK via http:// when the site may be loaded via file://
			protocol = if location.protocol is 'https:' then 'https:' else 'http:'
			requirejs [protocol + '//connect.facebook.net/en_US/all.js']

		renderPlugins: (cb = @cb) ->
			@onReady () ->
				## Parse only unrendered plugins for browser that support querySelectorAll
				if document.querySelectorAll?
					plugins = document.body.querySelectorAll '.fb-like:not([fb-xfbml-state=rendered])'

					## Each plugin renders async, count the amount to render
					unrenderedCount = plugins.length

					cbStack = () ->
						## Decrement the unrendered count
						## Call the main callback once all done
						cb() if --unrenderedCount is 0

					for plugin in plugins
						FB.XFBML.parse plugin.parentNode, cbStack

				else
					FB.XFBML.parse document.body, cb

		getCanvasUrl: (path = '') ->
			if @config.namespace?
				return "https://apps.facebook.com/#{@config.namespace}/#{path}"
			else
				return window.location.protocol + "//" + window.location.hostname + "/" + path

		## http://developers.facebook.com/docs/reference/javascript/FB.Canvas.getPageInfo/
		getCanvasInfo: (cb = @cb) ->
			@onReady (FB) ->
				FB.Canvas.getPageInfo (info) -> cb info

		setCanvasSize: (width, height) ->
			@onReady (FB) ->
				FB.Canvas.setSize
					width: width
					height: height

		scrollTo: (x,y)->
			@onReady (FB) ->
				FB.Canvas.scrollTo x, y
		
	
	permissionsMap =
		languages: ["user_likes"]
		bio: ["user_about_me"]
		birthday: ["user_birthday"]
		education: ["user_education_history"]
		email: ["email"]
		hometown: ["user_hometown"]
		interested_in: ["user_relationship_details"]
		location: ["user_location"]
		political: ["user_religion_politics"]
		favorite_athletes: ["user_likes"]
		favorite_teams: ["user_likes"]
		quotes: ["user_about_me"]
		relationship_status: ["user_relationships"]
		religion: ["user_religion_politics"]
		significant_other: ["user_religion_politics"]
		website: ["user_religion_politics"]
		work: ["user_religion_politics"]

	## Create and return a new instance of Facebook
	## module.config() returns a JSON object as defined in requirejs.config.Facebook
	new Facebook permissionsMap, module.config()
