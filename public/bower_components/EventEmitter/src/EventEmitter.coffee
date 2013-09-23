###! https://gist.github.com/Contra/2759355 ###
define [], () ->
	class EventEmitter
		constructor: ->
			@events = {}
	 
		fireEvent: (event, args...) ->
			return false unless @events[event]
			listener args... for listener in @events[event]
			return true
	 
		addEvent: (event, listener) ->
			@fireEvent 'newListener', event, listener
			(@events[event]?=[]).push listener
			return @
	 
		on: @::addEvent
	 
		once: (event, listener) ->
			fn = =>
				@removeListener event, fn
				listener arguments...
			@on event, fn
			return @
	 
		removeListener: (event, listener) ->
			return @ unless @events[event]
			@events[event] = (l for l in @events[event] when l isnt listener)
			return @
	 
		removeAllListeners: (event) ->
			delete @events[event]
			return @