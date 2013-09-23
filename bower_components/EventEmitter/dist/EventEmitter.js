/*! https://gist.github.com/Contra/2759355
*/


(function() {
  var __slice = [].slice;

  define([], function() {
    var EventEmitter;

    return EventEmitter = (function() {
      function EventEmitter() {
        this.events = {};
      }

      EventEmitter.prototype.fireEvent = function() {
        var args, event, listener, _i, _len, _ref;

        event = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
        if (!this.events[event]) {
          return false;
        }
        _ref = this.events[event];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          listener = _ref[_i];
          listener.apply(null, args);
        }
        return true;
      };

      EventEmitter.prototype.addEvent = function(event, listener) {
        var _base, _ref;

        this.fireEvent('newListener', event, listener);
        ((_ref = (_base = this.events)[event]) != null ? _ref : _base[event] = []).push(listener);
        return this;
      };

      EventEmitter.prototype.on = EventEmitter.prototype.addEvent;

      EventEmitter.prototype.once = function(event, listener) {
        var fn,
          _this = this;

        fn = function() {
          _this.removeListener(event, fn);
          return listener.apply(null, arguments);
        };
        this.on(event, fn);
        return this;
      };

      EventEmitter.prototype.removeListener = function(event, listener) {
        var l;

        if (!this.events[event]) {
          return this;
        }
        this.events[event] = (function() {
          var _i, _len, _ref, _results;

          _ref = this.events[event];
          _results = [];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            l = _ref[_i];
            if (l !== listener) {
              _results.push(l);
            }
          }
          return _results;
        }).call(this);
        return this;
      };

      EventEmitter.prototype.removeAllListeners = function(event) {
        delete this.events[event];
        return this;
      };

      return EventEmitter;

    })();
  });

}).call(this);
