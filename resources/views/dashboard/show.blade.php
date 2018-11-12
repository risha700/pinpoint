@extends('layouts.app')

    @section('content')
        <div class=" uk-section-large uk-overflow-auto">
            <div class="uk-container " >
                <div class="uk-card-default">
                    <table class="uk-table uk-table-divider">
                        @foreach($purchaser as $user)
                          <div class="uk-text-lead uk-text-center"> {{$user->name}}</div>
                            <div class="uk-text-center uk-text-primary">{{$user->email}}</div>
                            <div class="uk-text-center uk-text-primary"><a href="tel:{{$user->orders[0]->phone}}">{{$user->orders[0]->phone}}</a></div>


                            <thead>
                            <tr>
                                <th >Order ID#</th>
                                <th>Shipping Address </th>
                                <th >Items</th>
                                <th >Quantity</th>
                                <th>Total charge</th>
                                <th >Status</th>
                                <th >Card number</th>

                            </tr>
                        </thead>
                            @foreach($user->orders as $order)

                            <tbody>
                            {{--Single product order--}}
                                @if(sizeof($order->products)==1)
                                    @foreach($order->products as $product)
                                <tr>
                                    <td  class="uk-text-bold">#{{$order->id}}</td>
                                    <td>{{$order->address}} </td>
                                    <td>{{$product->name}}</td>
                                    <td >{{$product->pivot->quantity}}</td>
                                    <td class="{{$order->error?'uk-text-danger':'uk-text-success'}}">{{presentPrice($order->total)}}</td>
                                    <td class="{{$order->error?'uk-text-danger':'uk-text-success'}}">{{$order->error?:'Successful'}}</td>
                                    <td >xxxx-xxxx-{{$order->last4}}</td>


                                </tr>
                                    @endforeach

                                @endif
                            {{--Multi products order--}}

                            <tr>
                                @if(sizeof($order->products)>1)
                                        <td  class="uk-text-bold">#{{$order->id}}</td>
                                        <td>{{$order->address}} </td>
                                        <td >
                                            @foreach($order->products as $product)
                                            <p>{{$product->name}}</p>
                                            @endforeach
                                        </td>


                                        <td >
                                            @foreach($order->products as $product)
                                                <p>{{$product->pivot->quantity}}</p>
                                            @endforeach
                                        </td>
                                        <td class="{{$order->error?'uk-text-danger':'uk-text-success'}}">{{presentPrice($order->total)}}</td>
                                        <td class="{{$order->error?'uk-text-danger':'uk-text-success'}} uk-table-shrink">{{$order->error?:'Successful'}}</td>
                                        <td >xxxx-xxxx-{{$order->last4}}</td>


                                @endif
                                </tr>

                            </tbody>


                            @endforeach
                        @endforeach

                    </table>


                </div>
            </div>
        </div>



    @endsection