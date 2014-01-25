<!DOCTYPE html>
{{--The HTML Tag Specified Here make use of the Laravel Config--}}
<html lang="{{ Config::get('app.locale') }}">
    <head>
        {{--Head Layout--}}
        @include('orchestra/foundation::layout.head')
    </head>
    <body>
        {{--Navigation Bar Layout--}}
        @include('orchestra/foundation::layout.nav')

        {{--Header Layout--}}
        @include('orchestra/foundation::components.header')

        {{--Main Container--}}
        <section class="container main">
            @include('orchestra/foundation::components.messages')
            @yield('content')
        </section>

        {{--Footer--}}
        @include('orchestra/foundation::layout._footer')

        {{--Developer Option--}}
        @if(app()->env=="local")
        {{--Livereload Script for Development Purposes--}}
        <script src="http://localhost:35729/livereload.js"></script>
        @endif
    </body>
</html>
