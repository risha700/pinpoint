<nav class="uk-navbar uk-navbar-container uk-navbar-transparent uk-hidden@m uk-navbar-right" id="menu" uk-navbar>
    <div class="uk-navbar-right uk-margin-large-right">
        <a class="uk-navbar-toggle" href="#" uk-toggle="target: #mobile-menu">
            <span uk-navbar-toggle-icon></span>
        </a>
    </div>
    <div class="uk-navbar-center uk-margin-left">
        <a href="#" class="uk-navbar-item" uk-icon="cart"></a>
    </div>
</nav>
<div class="uk-offcanvas-content">
    <div id="mobile-menu" uk-offcanvas="flip:true">
        <div class="uk-offcanvas-bar">
            <button class="uk-offcanvas-close" type="button" uk-close></button>
            <ul class="uk-nav uk-nav-default">
                <li  class="{{ set_active('product') }}"><a class="uk-button uk-button-text " href="{{ route('product.index') }}">Shop</a></li>
                <li  class="{{ set_active('cart') }}"><a class="uk-button uk-button-text " href="{{ route('cart.index') }}" uk-icon="cart"></a></li>

                @if (Auth::guest())
                    <li  class="{{ set_active('login') }}"><a class="uk-button uk-button-text " href="{{ route('login') }}">Login</a></li>
                    <li class="{{ set_active('register') }}"><a class="uk-button uk-button-text" href="{{ route('register') }}">Register</a></li>
                @else
                    <li>
                        <a href="#">{{ Auth::user()->name }}</a>
                            <ul class="uk-nav uk-navbar-default">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
