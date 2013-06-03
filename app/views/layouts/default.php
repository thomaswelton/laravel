<!DOCTYPE html>
<!--[if IE 7]>    <html class="ie7 oldie" > <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie" > <![endif]-->
<html lang="en">
<head>
    <title><? $title ?></title>
    <meta charset="UTF-8" />
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="description" content="Thomas Welton - Portfolio website">

    <!--[if lt IE 9]>
        <script src="/assets/scripts/components/html5shiv/html5shiv.js"></script>
    <![endif]-->

    
    <link rel="stylesheet" type="text/css" href="/assets/stylesheets/compiled/template.css">
    <link href="/assets/stylesheets/compiled/pages/homepage.css" rel="stylesheet" type="text/css" />
    <script src="/assets/scripts/modernizr.js"></script>
    
</head>
<body>
    <div id="container">
        <div id="content">
            <header>
                <a href="http://bootstrap.dev/">Bootstrap</a>
            </header>

            <div id="main" role="main"><?= $content ?></div>
        </div>

        <footer>
            <ul>
                <li class="icon-blue-arrow"></li>
                <li class="icon-green-arrow"></li>
                <li class="icon-red-arrow"></li>
            </ul>
        </footer>
    </div>
    
    <script src="/assets/scripts/components/requirejs/require.js"></script>
    <script>
        require.config({
            urlArgs: "bust=" + (new Date()).getTime()
        });
    </script>
        
    <script type="text/javascript">
        <?= file_get_contents('assets/scripts/compiled/config.js'); ?>

        requirejs.config({
            baseUrl: "/assets/scripts",
            config:{

            }
        });

        require(['main']);
    </script>
    </body>
</html>

