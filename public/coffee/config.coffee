requirejs.config
    shim:
        bootstrap:
            deps: ["jquery"],
            exports: "$.fn.popover"
        enforceDefine: true

    paths:
        main: 'assets/scripts/compiled/main'
        home: 'assets/scripts/compiled/pages/home'
        admin: 'assets/scripts/compiled/admin'
        twbs: 'assets/scripts/compiled/modules/twbs'
