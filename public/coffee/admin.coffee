require [], () ->
	console.log 'Admin'

	requirejs ['jquery'], ($) ->
		requirejs ['bootstrap']
