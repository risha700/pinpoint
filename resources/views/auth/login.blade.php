@extends('layouts.app')

@section('content')
    <div class="uk-section uk-height-viewport"
         style="background:url('/topography.svg') repeat-x  top 300px left 100px, linear-gradient(to right top, #845EC2, #D65DB1, #FF6F91, #FF9671, #FFC75F,#F9F871);">

        <div class="uk-container uk-container-center">

            <div class="uk-width-1-2@m uk-align-center">

                <div class="uk-padding uk-margin-large-top uk-box-shadow-large uk-card-default uk-border-rounded">

                    <h2>Login</h2>

                    <form class="uk-form-stacked" role="form" method="POST" action="{{ route('login') }}">

                        @csrf

                        <div>

                            <label class="uk-form-label">Email Address</label>
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: mail"></span>
                                <input id="email" type="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}"
                                       name="email" value="{{ old('email') }}" required autofocus>

                            </div>

                            @if ($errors->has('email'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label">Password</label>

                            <div class="uk-inline uk-width-1-1" >
                                {{--<span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>--}}
                                <a id="show_password" uk-icon="icon: unlock"  class="uk-form-icon uk-form-icon-flip "></a>
                                <input id="password" type="password" class="uk-input{{ $errors->has('password') ? ' uk-form-danger' : '' }}" name="password" value="{{ old('password') }}" required>
                                {{--<a id="show_password" uk-icon="icon: unlock"></a>--}}
                            </div>
                            @if ($errors->has('password'))
                                <div class="uk-alert-danger" uk-alert>
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="uk-margin">
                           <label><input class="uk-checkbox" type="checkbox" name="remember"{{ old('remember') ? ' checked' : '' }}> Remember me</label>
                        </div>

                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit" name="button">Login</button>
                            <a class="uk-float-right" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
