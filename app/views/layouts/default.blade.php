<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>{{ $page_title }}</title>

        <meta name="description" content="{{ $page_description }}">
        <meta name="viewport" content="width=device-width">

        <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->

        <style>
              @import url(http://fonts.googleapis.com/css?family=Lato:300,400,700);

              body {
                  margin:0;
                  font-family:'Lato', sans-serif;
                  text-align:center;
                  color: #999;
              }

              .welcome {
                 width: 300px;
                 height: 300px;
                 position: absolute;
                 left: 50%;
                 top: 50%;
                 margin-left: -150px;
                 margin-top: -150px;
              }

              a, a:visited {
                  color:#FF5949;
                  text-decoration:none;
              }

              a:hover {
                  text-decoration:underline;
              }

              ul li {
                  display:inline;
                  margin:0 1.2em;
              }

              p {
                  margin:2em 0;
                  color:#555;
              }
          </style>
    </head>
    <body>
        @yield('content')
    </body>
</html>
