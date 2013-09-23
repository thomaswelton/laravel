require ['Facebook', 'domReady!'], (Facebook) ->
	console.log 'main init'

	Facebook.getAccessToken (token) ->
		console.log "Your token is #{token}"


	$('logout').addEvent 'click', (event) ->
		 Facebook.logout () -> console.log 'logged out'

	$('uninstall').addEvent 'click', (event) ->
		 Facebook.uninstallApp () -> console.log 'App uninstalled from user'

	$$('[data-fb-login]').addEvent 'click', (event) ->
		scope = this.getProperty 'data-fb-login'

		Facebook.login
			scope: scope
			onLogin: (authResponse) -> console.log 'logged in', authResponse
			onCancel: () -> console.log 'login canceled'

	Facebook.addEvent 'onAuthChange', (loggedIn) ->
		if loggedIn
			console.log 'The user logged in'
		else
			console.log 'The user logged out'


	Facebook.addEvent 'logout', () ->
		console.log 'user logged out'


	$$('form.permissions')[0].addEvent 'submit', (event) ->
		form = event.target
		resultsOutput = form.getElement 'textarea'

		event.preventDefault()

		## Get the checked fields
		checked = form.getElements 'input:checked'
		requestedFields = (el.getProperty('value') for el in checked)

		## Use the fields array to get data from Facebook
		Facebook.requireUserInfo requestedFields, (response) ->
			resultsOutput.innerText = JSON.stringify response, null, 2






