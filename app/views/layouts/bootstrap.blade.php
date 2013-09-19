<!DOCTYPE html>
<!--[if IE 7]>    <html class="ie7 oldie" > <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie" > <![endif]-->
<html lang="en">
<head>
    <meta charset="UTF-8" />

    <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
    <![endif]-->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/bower_components/bootstrap/dist/css/bootstrap.css">
</head>
<body>
    <div class="container" role="main">
        @yield('content')
    </div>

    <script src="/bower_components/requirejs/require.js"></script>
    @if ('production' != App::environment())
        <script>
            require.config({
                urlArgs: "bust=" + (new Date()).getTime()
            });
        </script>
    @endif

    <script type="text/javascript">
        {{ File::get(public_path().'/assets/scripts/compiled/config.js') }}

        requirejs.config({
            baseUrl: './'
        });

        require(["twbs"]);
    </script>
</body>
</html>
