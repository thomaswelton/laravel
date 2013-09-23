(function() {
  var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    __slice = [].slice,
    __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

  define(['module', 'EventEmitter', 'mootools'], function(module, EventEmitter) {
    var Facebook, permissionsMap;
    Facebook = (function(_super) {
      __extends(Facebook, _super);

      function Facebook(permissionsMap, config) {
        var channelUrl, defaults, key, setCookie, value, _ref;
        this.permissionsMap = permissionsMap;
        this.config = config;
        this.fbiFrameInit = __bind(this.fbiFrameInit, this);
        this.fbInit = __bind(this.fbInit, this);
        this.fbAsyncInit = __bind(this.fbAsyncInit, this);
        this.onReady = __bind(this.onReady, this);
        this.requireUserInfo = __bind(this.requireUserInfo, this);
        this.getUserInfo = __bind(this.getUserInfo, this);
        this.getPermissions = __bind(this.getPermissions, this);
        this.fbApi = __bind(this.fbApi, this);
        this.uninstallApp = __bind(this.uninstallApp, this);
        this.getLoginStatus = __bind(this.getLoginStatus, this);
        this.login = __bind(this.login, this);
        this.requestPermission = __bind(this.requestPermission, this);
        this.hasPermissions = __bind(this.hasPermissions, this);
        this.logout = __bind(this.logout, this);
        this.ui = __bind(this.ui, this);
        this.getAccessToken = __bind(this.getAccessToken, this);
        this.getAppId = __bind(this.getAppId, this);
        Facebook.__super__.constructor.call(this);
        if (this.config.appId == null) {
          console.warn('No Facebook app ID found in requirejs module config');
          return false;
        }
        this.cb = function() {
          var args;
          args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
          return console.log.apply(console, ['No callback specifed for the data'].concat(__slice.call(args)));
        };
        console.log('Facebook init');
        if (this.config.appId.toString().trim().length === 0) {
          console.warn('No Facebook app ID found in config');
        }
        defaults = {
          status: true,
          cookie: true,
          xfbml: true
        };
        _ref = this.config;
        for (key in _ref) {
          value = _ref[key];
          defaults[key] = value;
        }
        this.config = defaults;
        this.api = null;
        this.isIframe = top !== self;
        if (typeof FB !== "undefined" && FB !== null) {
          this.fbAsyncInit();
        } else {
          window.fbAsyncInit = this.fbAsyncInit;
          this.injectFB();
        }
        /*
        			Set a cookie for our domain using a pop up
        			window where required. Required when using
        			Safari on a FB iframe application where
        			3rd party cookies are blocked
        */

        if (window.self !== window.top && document.cookie.length === 0) {
          channelUrl = this.config.channelUrl;
          setCookie = function() {
            var handle, popUpLocation, popUpOptions;
            popUpLocation = channelUrl;
            console.log(popUpLocation);
            popUpOptions = "height=200,width=150,directories=no,location=no,menubar=no,resizable=no,scrollbars=no,status=no,titlebar=no,toolbar=no";
            handle = window.open(popUpLocation, '_blank', popUpOptions);
            if (handle && handle.top) {
              handle.document.cookie = 'facebookjs=1;';
              handle.close();
              return document.body.removeEvent('click:relay(*)', setCookie);
            }
          };
          document.body.addEvent('click:relay(*)', setCookie);
        }
        /*
        */

      }

      Facebook.prototype.getAppId = function() {
        return this.config.appId;
      };

      Facebook.prototype.getAccessToken = function(cb) {
        var _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        return this.onReady(function(FB) {
          var authResponse;
          authResponse = FB.getAuthResponse();
          if ((authResponse != null) && (authResponse.accessToken != null)) {
            return cb(authResponse.accessToken);
          }
          return cb(false);
        });
      };

      Facebook.prototype.ui = function(data, cb) {
        if (cb == null) {
          cb = this.cb;
        }
        return this.onReady(function(FB) {
          return FB.ui(data, cb);
        });
      };

      Facebook.prototype.logout = function(cb) {
        var _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        return this.onReady(function(FB) {
          var _ref;
          console.log(_this.loginStatus);
          if ((((_ref = _this.loginStatus) != null ? _ref.status : void 0) != null) && _this.loginStatus.status === 'connected') {
            return FB.logout(function(response) {
              return cb(response);
            });
          } else {
            console.warn('User is already logged out');
            return cb();
          }
        });
      };

      Facebook.prototype.hasPermissions = function(perms) {
        var grantedPerms, intersection, permsArray;
        if (perms.trim().length === 0) {
          return true;
        }
        if ((this.grantedPermissions == null) || this.grantedPermissions.length === 0) {
          return false;
        }
        permsArray = perms.split(',');
        intersection = function(a, b) {
          var value, _i, _len, _ref, _results;
          if (a.length > b.length) {
            _ref = [b, a], a = _ref[0], b = _ref[1];
          }
          _results = [];
          for (_i = 0, _len = a.length; _i < _len; _i++) {
            value = a[_i];
            if (__indexOf.call(b, value) >= 0) {
              _results.push(value);
            }
          }
          return _results;
        };
        grantedPerms = intersection(permsArray, this.grantedPermissions);
        return grantedPerms.length === permsArray.length;
      };

      Facebook.prototype.requestPermission = function(scope, cb) {
        var _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        return FB.ui({
          method: 'oauth',
          scope: scope,
          display: 'popup'
        }, function() {
          _this.getPermissions();
          return cb();
        });
      };

      Facebook.prototype.login = function(obj) {
        var onCancel, onLogin, scope,
          _this = this;
        scope = obj.scope != null ? obj.scope.trim() : '';
        onLogin = obj.onLogin != null ? obj.onLogin : function() {};
        onCancel = obj.onCancel != null ? obj.onCancel : function() {};
        return this.onReady(function(FB) {
          var _ref;
          if ((((_ref = _this.loginStatus) != null ? _ref.status : void 0) != null) && _this.loginStatus.status === 'connected') {
            if (_this.hasPermissions(scope)) {
              return onLogin(_this.loginStatus.authResponse);
            } else {
              console.log('request', scope);
              return _this.requestPermission(scope, function(response) {
                return onLogin(_this.loginStatus.authResponse);
              });
            }
          } else {
            return FB.login(function(response) {
              if (response.authResponse) {
                return onLogin(response.authResponse);
              } else {
                return onCancel();
              }
            }, {
              scope: scope
            });
          }
        });
      };

      Facebook.prototype.getLoginStatus = function(cb) {
        var _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        return FB.getLoginStatus(function(loginStatus) {
          _this.loginStatus = loginStatus;
          console.log("Login Status:", _this.loginStatus);
          return cb(_this.loginStatus);
        });
      };

      Facebook.prototype.uninstallApp = function(cb) {
        var _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        return this.onReady(function(FB) {
          return FB.api('me/permissions', 'delete', function(response) {
            if (response.error != null) {
              console.warn(response.error.message, "query: delete me/permissions");
              return cb(false);
            }
            return cb(response);
          });
        });
      };

      Facebook.prototype.fbApi = function(query, cb) {
        var _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        return this.onReady(function(FB) {
          return FB.api(query, function(response) {
            if (response.error != null) {
              console.warn(response.error.message, "query: " + query);
              return cb(false);
            }
            return cb(response);
          });
        });
      };

      Facebook.prototype.getPermissions = function(cb) {
        var _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        return this.fbApi('/me?fields=permissions', function(response) {
          var permission;
          if (response) {
            _this.grantedPermissions = (function() {
              var _results;
              _results = [];
              for (permission in response.permissions.data[0]) {
                _results.push(permission);
              }
              return _results;
            })();
            return cb(_this.grantedPermissions);
          } else {
            return cb(false);
          }
        });
      };

      Facebook.prototype.getUserInfo = function(data, cb) {
        var fields,
          _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        if (this.loginStatus == null) {
          return this.once('onStatusChange', function() {
            return _this.getUserInfo(data, cb);
          });
        } else if (this.loginStatus.status === 'connected') {
          fields = data.join(',');
          return this.fbApi("/me?fields=" + fields, function(response) {
            return cb(response);
          });
        } else {
          return cb({});
        }
      };

      Facebook.prototype.requireUserInfo = function(data, cb) {
        var field, getInfo, requiredPermissions, requiredScope,
          _this = this;
        if (cb == null) {
          cb = this.cb;
        }
        requiredPermissions = (function() {
          var _i, _len, _results;
          _results = [];
          for (_i = 0, _len = data.length; _i < _len; _i++) {
            field = data[_i];
            if (this.permissionsMap[field] != null) {
              _results.push(this.permissionsMap[field]);
            }
          }
          return _results;
        }).call(this);
        requiredScope = requiredPermissions.join(',');
        getInfo = function() {
          return _this.getUserInfo(data, cb);
        };
        return this.onReady(function(FB) {
          if (_this.loginStatus.status !== 'connected') {
            return _this.login({
              scope: requiredScope,
              onLogin: function() {
                return _this.getPermissions(getInfo);
              }
            });
          } else {
            if (_this.hasPermissions(requiredScope)) {
              return getInfo();
            } else {
              return _this.requestPermission(requiredScope, getInfo);
            }
          }
        });
      };

      Facebook.prototype.onReady = function(callback) {
        var _this = this;
        if (callback == null) {
          callback = this.cb;
        }
        if (this.fbReady != null) {
          return callback(FB);
        } else {
          return this.once('fbInit', function() {
            return callback(FB);
          });
        }
      };

      Facebook.prototype.fbAsyncInit = function() {
        this.fbInit();
        if (this.isIframe) {
          return this.fbiFrameInit();
        }
      };

      Facebook.prototype.fbInit = function() {
        var _this = this;
        FB.init(this.config);
        this.fbReady = true;
        if (this.config.appId.trim().length === 0) {
          return;
        }
        this.getLoginStatus(function(loginStatus) {
          if (loginStatus.status === 'connected') {
            return _this.getPermissions(function() {
              return _this.fireEvent('fbInit');
            });
          } else {
            return _this.fireEvent('fbInit');
          }
        });
        FB.Event.subscribe('auth.login', function(loginStatus) {
          _this.loginStatus = loginStatus;
          console.log('FB.Event: auth.login');
          return _this.fireEvent('onLogin');
        });
        FB.Event.subscribe('auth.logout', function() {
          return _this.fireEvent('onLogout');
        });
        FB.Event.subscribe('auth.statusChange', function(loginStatus) {
          _this.loginStatus = loginStatus;
          console.log('FB.Event: auth.statusChange');
          return _this.fireEvent('onStatusChange');
        });
        FB.Event.subscribe('auth.authResponseChange', function(loginStatus) {
          _this.loginStatus = loginStatus;
          console.log('FB.Event: auth.authResponseChange');
          return _this.fireEvent('onAuthChange', _this.loginStatus.status === 'connected');
        });
        FB.Event.subscribe('edge.create', function(url) {
          return _this.fireEvent('onLike', url);
        });
        return FB.Event.subscribe('edge.remove', function(url) {
          return _this.fireEvent('onUnlike', url);
        });
      };

      Facebook.prototype.fbiFrameInit = function() {
        var resizeInterval,
          _this = this;
        FB.Canvas.scrollTo(0, 0);
        FB.Canvas.setSize({
          width: 810,
          height: document.documentElement.offsetHeight
        });
        if ((this.config.autoResize != null) && this.config.autoResize) {
          resizeInterval = function() {
            return _this.setCanvasSize(810, document.documentElement.offsetHeight);
          };
          return window.setInterval(resizeInterval, 500);
        }
      };

      Facebook.prototype.injectFB = function() {
        var protocol, root;
        if (document.getElementById('facebook-jssdk')) {
          return;
        }
        if (!document.getElementById('fb-root')) {
          root = document.createElement('div');
          root.setAttribute('id', 'fb-root');
          document.body.appendChild(root);
        }
        protocol = location.protocol === 'https:' ? 'https:' : 'http:';
        return requirejs([protocol + '//connect.facebook.net/en_US/all.js']);
      };

      Facebook.prototype.renderPlugins = function(cb) {
        if (cb == null) {
          cb = this.cb;
        }
        return this.onReady(function() {
          var cbStack, plugin, plugins, unrenderedCount, _i, _len, _results;
          if (document.querySelectorAll != null) {
            plugins = document.body.querySelectorAll('.fb-like:not([fb-xfbml-state=rendered])');
            unrenderedCount = plugins.length;
            cbStack = function() {
              if (--unrenderedCount === 0) {
                return cb();
              }
            };
            _results = [];
            for (_i = 0, _len = plugins.length; _i < _len; _i++) {
              plugin = plugins[_i];
              _results.push(FB.XFBML.parse(plugin.parentNode, cbStack));
            }
            return _results;
          } else {
            return FB.XFBML.parse(document.body, cb);
          }
        });
      };

      Facebook.prototype.getCanvasUrl = function(path) {
        if (path == null) {
          path = '';
        }
        if (this.config.namespace != null) {
          return "https://apps.facebook.com/" + this.config.namespace + "/" + path;
        } else {
          return window.location.protocol + "//" + window.location.hostname + "/" + path;
        }
      };

      Facebook.prototype.getCanvasInfo = function(cb) {
        if (cb == null) {
          cb = this.cb;
        }
        return this.onReady(function(FB) {
          return FB.Canvas.getPageInfo(function(info) {
            return cb(info);
          });
        });
      };

      Facebook.prototype.setCanvasSize = function(width, height) {
        return this.onReady(function(FB) {
          return FB.Canvas.setSize({
            width: width,
            height: height
          });
        });
      };

      Facebook.prototype.scrollTo = function(x, y) {
        return this.onReady(function(FB) {
          return FB.Canvas.scrollTo(x, y);
        });
      };

      return Facebook;

    })(EventEmitter);
    permissionsMap = {
      languages: ["user_likes"],
      bio: ["user_about_me"],
      birthday: ["user_birthday"],
      education: ["user_education_history"],
      email: ["email"],
      hometown: ["user_hometown"],
      interested_in: ["user_relationship_details"],
      location: ["user_location"],
      political: ["user_religion_politics"],
      favorite_athletes: ["user_likes"],
      favorite_teams: ["user_likes"],
      quotes: ["user_about_me"],
      relationship_status: ["user_relationships"],
      religion: ["user_religion_politics"],
      significant_other: ["user_religion_politics"],
      website: ["user_religion_politics"],
      work: ["user_religion_politics"]
    };
    return new Facebook(permissionsMap, module.config());
  });

}).call(this);
