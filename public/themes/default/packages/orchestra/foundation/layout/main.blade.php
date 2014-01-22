<!DOCTYPE html>
{{--The HTML Tag Specified Here make useof the Laravel Config--}}
<html lang="{{ Config::get('app.locale') }}">
    <head>
        @include('orchestra/foundation::layout.head')
    </head>
    <body>
        @include('orchestra/foundation::layout.nav')
        <? Orchestra\Support\Facades\Site::set('header::class', 'main-header') ?>
        @include('orchestra/foundation::components.header')
        <section class="container main">
            @include('orchestra/foundation::components.messages')
            @yield('content')
        </section>
        @include('orchestra/foundation::layout._footer')

        <!-- Livereload Script for Development Purposes -->
        @if(app()->env=="local")
        <script src="http://localhost:35729/livereload.js"></script>
        @endif
    </body>
</html>
