<!doctype html>
<html lang="{{ Config::get('app.locale') }}" {{OG::prefix()}}>
    <head>
        {{Meta::charset()}}

        {{HTML::title()}}

        {{OG::all()}}

        {{Meta::author()}}

        {{Meta::description()}}

        {{Meta::generator()}}

        {{Meta::viewport()}}
        <link rel="stylesheet" type="text/css" href="/builds/frontend/style.min.css"/>
    </head>
    <body>



    {{--Developer Option--}}
    @if(app()->env=="local")
    {{--Livereload Script for Development Purposes--}}
    <script src="http://localhost:35729/livereload.js"></script>
    @endif
    </body>
</html>