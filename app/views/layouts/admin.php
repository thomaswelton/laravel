<!DOCTYPE html>
<!--[if IE 7]>    <html class="ie7 oldie" > <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie" > <![endif]-->
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="UTF-8" />

    <!--[if lt IE 9]>
        <script src="/assets/scripts/components/html5shiv/html5shiv.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" type="text/css" href="/assets/stylesheets/compiled/admin.css">
</head>
<body>
    
    <div class="navbar navbar-static-top">
        <div class="navbar-inner">
            <a class="brand" href="/admin">Bootstrap Admin</a>
            
            <?php if(!Auth::guest()): ?>
                <div class="pull-right">
                    <a href="/" class="btn btn-info" target="_blank">View Site <i class="icon-eye-open"></i></a>
                    <a class="btn btn-inverse" href="/admin/logout">Logout <i class="icon-signout"></i></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="container" role="main">
        <?= $content ?>
    </div>
    
    <script src="/assets/scripts/components/requirejs/require.js"></script>
    
    <?php if ('production' != App::environment()): ?>
        <script>
            require.config({
                urlArgs: "bust=" + (new Date()).getTime()
            });
        </script>
    <?php endif ?>

    <script type="text/javascript">
        <?= file_get_contents('assets/scripts/compiled/config.js'); ?>
        requirejs.config({
            baseUrl: '/assets/scripts',
            config:{

            }
        });
        
        require(["/assets/scripts/compiled/admin.js"]);
    </script>
</body>
</html>
