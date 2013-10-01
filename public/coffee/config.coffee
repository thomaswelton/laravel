requirejs.config
    shim:
        bootstrap:
            deps: ["jquery"],
            exports: "$.fn.popover"
        enforceDefine: true

    modules:[
        {
            name: 'admin'
        },
        {
            name: 'main'
        }
    ]

    paths:
        main: 'compiled/main'
        home: 'compiled/pages/home'
        admin: 'compiled/admin'
        twbs: 'compiled/modules/twbs'
