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
    </head>
    <body>
    </body>
</html>