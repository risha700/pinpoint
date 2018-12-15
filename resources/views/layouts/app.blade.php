<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--Google-->
        <meta name="google-site-verification" content="nnhbCrHYz0Dkr56eke-cg2dxOCu8a1JnD0LIfkVqFZk" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ mix('/js/app.js') }}" defer></script>
        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        @yield('head')
        {{--<script aysnc defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDow6F37BCP8VXNozK60grjdloSEz_c5c&libraries=places"></script>--}}
        {{--<script aysnc defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDow6F37BCP8VXNozK60grjdloSEz_c5c"></script>--}}
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            window.App = {!! json_encode([
        'user' => Auth::user(),
        'signedIn' => Auth::check()
                        ]) !!};
        </script>
    </head>
    <body>

        <div id="app">
            <v-app>
        {{--manipulating to start vue router--}}
            @if(!request()->is('/'))
                @include('partials.navbar')
            @endif



            @yield('hero')





            @yield('content')
    {{--<div id="body" style="height: 500px"></div>--}}



            @include('partials.flash')

                {{--@include('partials.laravel-err')--}}
            </v-app>
        </div>
    </body>
</html>
