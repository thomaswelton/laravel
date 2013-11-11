<!DOCTYPE html>
<!--[if IE 7]>    <html class="ie7 oldie" > <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie" > <![endif]-->
<html lang="en">
<head>
    <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
    <![endif]-->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/stylesheets/compiled/bootstrap.css') }}">
</head>
<body>
    <div class="container" role="main">
        @yield('content')
    </div>

    <script src="assets/bower_components/requirejs/require.js"></script>
    @if ('production' != App::environment())
        <script>
            require.config({
                urlArgs: "bust=" + (new Date()).getTime()
            });
        </script>
    @endif

    <script type="text/javascript">
        {{ File::get(public_path().'/assets/scripts/config.js') }}

        requirejs.config({
            baseUrl: '/assets/scripts'
        });

        require(["twbs"]);
    </script>
</body>
</html>
