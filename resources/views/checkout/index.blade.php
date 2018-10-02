@extends('layouts.app')
@section('head')
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            background-color: white;
            padding: 10px 12px;
            border: 1px solid #cccccc;

        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>


@endsection






@section('content')
    <div class="uk-section uk-height-viewport"
         style="background:url('/topography.svg') repeat-x  top 300px left 100px, linear-gradient(to top, #655b42, #6f7a54, #6a9c75, #52beaa, #1ddeed);">

        <div class="uk-container uk-container-center uk-width-1-1@m uk-align-center">

                <div class="uk-padding uk-margin-left uk-margin-large-top uk-box-shadow-large uk-card-default uk-border-rounded uk-grid" uk-grid>
                    <div class="payment uk-width-1-2@m">

                        @include('partials.payment-form')

                    </div>
                    <div class="product uk-width-1-2@m">

                       <div class="uk-card">
                           <table class="uk-table">
                               <thead>
                               <tr>
                                   <th scope="col">Item</th>
                                   <th scope="col"></th>
                                   <th scope="col">Quanity</th>

                               </tr>

                               </thead>
                               @foreach(Cart::content() as $item)
                                   <tr>
                                       <td scope="row">
                                           <a href="{{ url('product', $item->model->slug ) }}">
                                               <img src="http://via.placeholder.com/350x150" class="img-thumbnail img-sm" width="120px">
                                           </a>
                                       </td>
                                       <td>{{$item->model->name}}<br>

                                           <i class="text-muted"> {{mb_substr($item->model->description, null, 25)}}</i>
                                       </td>
                                       <td class="lead">{{$item->qty}}</td>
                                   </tr>
                               @endforeach
                               <tbody>

                               <tr >
                                   <th scope="row">
                                       Subtotal
                                   </th>
                                   <th scope="col"></th>

                                   <td class="pull-right">{{presentPrice(Cart::subtotal())}}</td>


                               </tr>
                               @if(session()->has('coupon'))
                                   <tr >

                                       <th scope="row">
                                           Discount
                                           <form method="post" action="{{route('coupon.destroy')}}">
                                               @csrf
                                               @method('DELETE')
                                               <button type="submit" class="btn btn-link">Remove</button>
                                           </form>
                                       </th>

                                       <th scope="col">{{ session()->get('coupon')['name'] }}</th>

                                       <td class="pull-right">-{{presentPrice( session()->get('coupon')['value']) }}</td>


                                   </tr>
                                   <tr >
                                       <th scope="row">
                                           New Subtotal
                                       </th>
                                       <th scope="col"></th>

                                       <td class="pull-right">{{presentPrice($newSubtotal)}}</td>


                                   </tr>
                                   <tr >
                                       <th scope="row">
                                           <span class="mr-2">Tax</span>{{config('cart.tax')}}%
                                       </th>
                                       <th scope="col"></th>

                                       <td>{{presentPrice($newTax)}}</td>
                                   </tr>
                                   <tr >
                                       <th scope="row">
                                           Total
                                       </th>
                                       <th scope="col"></th>

                                       <td>{{presentPrice($newTotal)}}</td>

                                   </tr>
                               @endif
                               @if(!session()->has('coupon'))
                                   <tr >
                                       <th scope="row">
                                           <span class="mr-2">Tax</span>{{config('cart.tax')}}%
                                       </th>
                                       <th scope="col"></th>

                                       <td>{{presentPrice(Cart::tax())}}</td>
                                   </tr>
                                   <tr >
                                       <th scope="row">
                                           Total
                                       </th>
                                       <th scope="col"></th>

                                       <td>{{presentPrice(Cart::total())}}</td>

                                   </tr>
                               @endif
                               </tbody>

                           </table>



                       </div>


                        @if(!session()->has('coupon'))
                        <form class="uk-form-stacked uk-flex"  method="post" action="{{route('coupon.store')}}">
                            @csrf
                                <input class="uk-input" name="code" type="text" class="col-md-12">
                                <button class="uk-input" class="btn-outline-dark" type="submit">Apply</button>


                        </form>
                        @endif


                    </div>


                </div>
            </div>
        </div>
@endsection
