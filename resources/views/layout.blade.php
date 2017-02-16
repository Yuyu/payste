<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link async rel="stylesheet" href="css/vendor/bootstrap/css/bootstrap.min.css"/>
        <link async rel="stylesheet" href="css/flat-ui.min.css"/>
        <link async rel="stylesheet" href="css/codemirror.min.css"/>
        <link async rel="stylesheet" href="css/theme/solarized.css"/>
        <link async rel="stylesheet" href="css/main.css"/>
        @stack('stylesheets')
    </head>
    <body>
        <div class="container" id="page-container">
            <div class="row">
                @include('header')
            </div>
            <div class="row">
                @yield('content')
            </div>
            <div class="row">
                @include('footer')
            </div>
        </div>
        <script type="text/javascript" src="js/codemirror.min.js"></script>
        <script type="text/javascript" src="js/addon/mode/loadmode.js"></script>
        <script type="text/javascript" src="js/mode/meta.js"></script>
        <script type="text/javascript" src="js/dist/vendor.js"></script>
        @stack('scripts')
    </body>
</html>
