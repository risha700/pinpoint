
@extends('layouts.app')
@section('hero')

    <div class="uk-height-small uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top">
        <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">
        </div>
    </div>
@endsection
@section('content')
    @if ( Cart::instance('default')->count())
<div class="uk-padding uk-background-muted">
    <div class="uk-child-width-expand@s  " uk-grid uk-height-match="target: > div > .side">
        <!-- Left side -->
        <div class="side">
            <div class="uk-card uk-card-defaul">

                <table class="uk-table uk-table-justify uk-table-divider">
                    <thead>
                    <tr>
                        <th class="">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach (Cart::content() as $item)

                    <tr>
                        <td>
                            <div class="uk-flex">
                            <img src="/product.jpg" alt="" class="uk-height-max-small uk-thumbnav" style="height: 50px;">
                            {{$item->model->name}}
                            </div>
                        </td>
                        <td>
                            {{$item->model->details}}
                            {{$item->qty}}
                            {{presentPrice($item->model->price)}}/unit |
                            {{--{{$item->options[0]?:''}}--}}
                            {{presentOptions($item->options)}}
                        </td>

                        <td>
                            <div class="uk-margin">
                                <div class="uk-form-controls">
                                    <select class="uk-select" id="quantity" name="quantity" data-id="{{$item->rowId}}" data="{{$item->model->id}}">
                                        @for($i = 1; $i < $item->model->stock+1 ; $i++)

                                            <option value="{{$i}}" {{ $item->qty == $i ? 'selected':''}}>{{$i}}</option>

                                        @endfor
                                    </select>
                                </div>
                            </div>


                        </td>
                        {{--<td><button class="uk-button uk-button-default" type="button"></button></td>--}}
                        {{--<td><a href="#" class="uk-text-danger" uk-icon="icon:trash;ratio:1.3;"></a></td>--}}

                        <td>
                            <form action="{{route('cart.destroy', $item->rowId)}}" method="post">

                            @csrf
                            {{ method_field('DELETE') }}

                            <button type='submit' class="uk-text-danger uk-button-text" uk-icon="icon:trash;ratio:1.3;"></button>

                             </form>
                        </td>
                        <td>
                            <form action="{{route('cart.wishlist', $item->rowId)}}" method="post">

                            @csrf

                            <button type='submit' class="uk-text-danger uk-button-text" uk-icon="icon:heart;ratio:1.3;"></button>

                             </form>
                        </td>


                    </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="uk-card-header">

                    <table class="uk-table uk-table-justify uk-table-divider">
                        <tbody>
                        <tr>
                            <td class="uk-width-small">
                                <input class="uk-input uk-border-rounded"  placeholder="Coupon Code">
                            </td>
                            <td><button class="uk-button uk-button-default uk-border-rounded" type="button">Apply</button></td>
                            <td><button class="uk-button uk-button-default uk-border-rounded" type="button">Update Cart</button></td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Right side -->

        <div class="side">
            <div class="uk-card uk-card-default uk-card-body">
                <div class="uk-flex uk-flex-column uk-width-1-1">
                    <div class="uk-box">
                        <h2 class="uk-article-title">Cart Total</h2>
                    </div>

                    <div class="uk-flex-inline">
                        <div class="uk-width-4-5">
                            <p class="uk-leader" uk-leader="fill: -">Subtotal</p>
                        </div>
                        <div class="uk-margin-left">{{   presentPrice( Cart::subtotal()  )}}</div>
                    </div>


                    <div class="uk-flex-inline">
                        <div class="uk-width-4-5">
                            <p class="uk-leader" uk-leader="fill: -">Tax %
                                {{config('cart.tax')}}</p>
                        </div>
                        <div class="uk-margin-left">
                            {{   presentPrice( Cart::tax()  )}}
                        </div>
                    </div>
                    <hr style="height: .3px; border: solide darkgrey 1px;">
                    <div class="uk-flex-inline">
                        <div class="uk-width-4-5">
                            <p class="uk-leader" >Total</p>
                        </div>
                        <div class="uk-margin-left">{{   presentPrice( Cart::total()  )}}</div>
                    </div>
                    <div class="uk-flex-inline">
                        <div class="uk-margin-left"><a class="uk-button uk-button-primary uk-align-center" href="/checkout">checkout</a></div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>
@else
        <div class="uk-section uk-height-viewport uk-background-muted">
            <div class="uk-text-center">
                <h2 class="uk-article-title">
                    Your Cart is empty
                </h2>
                <a class="uk-button uk-button-secondary" href="{{url('shop')}}">Go Shopping</a>
            </div>
        </div>
@endif


    @include('partials.wishlist')
@endsection