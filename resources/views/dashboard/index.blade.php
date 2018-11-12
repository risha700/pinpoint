@extends('layouts.app')

@section('content')
    <div class="uk-height-small"></div>
    <div class="uk-container">
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
    <v-app>
    </v-app>

@endsection
