requirejs.config
    shim:
        bootstrap:
            deps: ["jquery"],
            exports: "$.fn.popover"
        enforceDefine: true

    paths:
        main: 'compiled/main'
        home: 'compiled/pages/home'
        admin: 'compiled/admin'
        twbs: 'compiled/modules/twbs'
