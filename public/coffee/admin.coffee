require ['requirejs-facebook'], (Facebook) ->
	console.log 'Admin'

	requirejs ['jquery'], ($) ->
		requirejs ['bootstrap']
