@extends('layouts.app')
@section('head')
    {{--<script src="https://js.stripe.com/v3/"></script>--}}

    {{--<script defer>--}}
        {{--let App ={--}}
            {{--stripeKey: "{{ config('services.stripe.key') }}"--}}
        {{--}--}}
    {{--</script>--}}
    @endsection
@section('content')
    <v-layout>
    <v-container class="mt-5 pt-5">
        {{--<router-link to="/"  tag="li" exact>Home</router-link>--}}
        {{--<router-link to="/product"  tag="li" exact>Shop</router-link>--}}
<list></list>
        {{--<router-view></router-view>--}}
        {{--<form-stepper></form-stepper>--}}
        <flash></flash>


    </v-container>
    </v-layout>
@endsection
