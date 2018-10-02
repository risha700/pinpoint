<form action="{{ route('checkout.store' )}}" method="post" id="payment-form" class="uk-form-stacked">
    @csrf


    <div>

        <label class="uk-form-label">Name</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: person"></span>
            <input id="name" type="text" class="uk-input{{ $errors->has('name') ? ' uk-form-danger' : '' }}"
                   name="name" value="{{ old('na,e') }}" placeholder="Name"  autofocus>

        </div>

        @if ($errors->has('name'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>


    <div>

        <label class="uk-form-label">Email Address</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: mail"></span>
            <input id="email" type="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}"
                   name="email" value="{{ old('email') }}" placeholder="Email"  autofocus>

        </div>

        @if ($errors->has('email'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>



    <div>

        <label class="uk-form-label">Phone</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: map"></span>
            <input id="phone" type="text" class="uk-input{{ $errors->has('phone') ? ' uk-form-danger' : '' }}"
                   name="phone" value="{{ old('phone') }}" placeholder="Phone"  autofocus>

        </div>

        @if ($errors->has('phone'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('phone') }}
            </div>
        @endif
    </div>


    <div>

        <label class="uk-form-label">Address Line 1</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: map"></span>
            <input id="address" type="text" class="uk-input{{ $errors->has('address') ? ' uk-form-danger' : '' }}"
                   name="address" value="{{ old('address') }}" placeholder="Address Line 1"  autofocus>

        </div>

        @if ($errors->has('address'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('address') }}
            </div>
        @endif
    </div>

    <div>

        <label class="uk-form-label">Address Line 2</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: map"></span>
            <input id="address2" type="text" class="uk-input{{ $errors->has('address2') ? ' uk-form-danger' : '' }}"
                   name="address2" value="{{ old('address2') }}" placeholder="Address Line 2"  autofocus>

        </div>

        @if ($errors->has('address2'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('address2') }}
            </div>
        @endif
    </div>



    <div>

        <label class="uk-form-label">City</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: map"></span>
            <input id="city" type="text" class="uk-input{{ $errors->has('city') ? ' uk-form-danger' : '' }}"
                   name="city" value="{{ old('city') }}" placeholder="City"  autofocus>

        </div>

        @if ($errors->has('city'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('city') }}
            </div>
        @endif
    </div>


    <div>

        <label class="uk-form-label">State</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: map"></span>
            <input id="state" type="text" class="uk-input{{ $errors->has('state') ? ' uk-form-danger' : '' }}"
                   name="state" value="{{ old('state') }}" placeholder="State"  autofocus>

        </div>

        @if ($errors->has('state'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('state') }}
            </div>
        @endif
    </div>


    <div>

        <label class="uk-form-label">City</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: map"></span>
            <input id="country" type="text" class="uk-input{{ $errors->has('country') ? ' uk-form-danger' : '' }}"
                   name="country" value="{{ old('country') }}" placeholder="Country"  autofocus>

        </div>

        @if ($errors->has('country'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('country') }}
            </div>
        @endif
    </div>

    <div>

        <label class="uk-form-label">Postal Code</label>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: map"></span>
            <input id="zip" type="text" class="uk-input{{ $errors->has('zip') ? ' uk-form-danger' : '' }}"
                   name="zip" value="{{ old('zip') }}" placeholder="Zip Code"  autofocus>

        </div>

        @if ($errors->has('zip'))
            <div class="uk-alert-danger" uk-alert>
                {{ $errors->first('zip') }}
            </div>
        @endif
    </div>

    <div class="uk-form-controls">
        <label for="card-element">
            Credit or debit card
        </label>
        <div id="card-element" class="uk-input">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>

    <button type="submit" class="uk-button uk-button-primary uk-align-center">Pay Now</button>
</form>
