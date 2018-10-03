@extends('layouts.app')


@section('hero')

    <div class="uk-height-small uk-background-cover uk-overflow-hidden uk-light uk-flex uk-flex-top" style="background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);">
        <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical"></div>
    </div>
    {{ Breadcrumbs::render('product') }}
@endsection
@section('content')

    <div class="uk-section">
        <div class="uk-container">
            <div class="uk-flex">
                <div class="uk-grid-large uk-child-width-1-2@s uk-child-width-1-3@m uk-grid-match uk-text-center" uk-grid>
                    @foreach($products as $product)

                    <div>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top uk-inline">




                                        <a href="{{url('shop', $product->slug)}}">
                                            <img src="{{$product->photos->pluck('path')->first() ?:'product.jpg'}}" alt="{{$product->name}}" style="height: 200px; width: 100%;"/>
                                        </a>
                            </div>
                            <div class="uk-card-body">
                                <span class="">{{presentPrice($product->price)}}</span>

                                <h3 class="uk-card-title"><a href="/product/{{ $product->slug }}  ">{{$product->name}}</a></h3>
                                <p>{{$product->details}}</p>
                            </div>
                            <div class="uk-card-footer uk-flex uk-flex-around">
                                {{--<a href="#" uk-icon="cart"></a>--}}

                                {{--<a href="#" uk-icon="eye"></a>--}}
                                <form action="{{route('wishlist.store')}}" method="POST" class="d-inline-flex">

                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id }}">
                                    <input type="hidden" name="name" value="{{$product->name }}">
                                    <input type="hidden" name="price" value="{{$product->price }}">
                                    <button type="submit" class='uk-button-link'><i uk-icon="icon:heart;ratio:2;"></i></button>
                                </form>
                                <form action="{{route('cart.store')}}" method="POST">

                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id }}">
                                    <input type="hidden" name="name" value="{{$product->name }}">
                                    <input type="hidden" name="price" value="{{$product->price }}">
                                    <button type="submit" class='uk-button-link'><i uk-icon="icon:cart;ratio:2;"></i></button>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>


                {{--categories--}}
                <div class="uk-margin-auto-right">
                @foreach($categories as $category)


                    <ul class="uk-iconnav uk-iconnav-vertical">
                        <li><a href="{{route('shop.index', ['category'=>$category->slug])}}" uk-icon="icon: plus">{{$category->name}}</a></li>
                    </ul>
                @endforeach
                </div>

{{--                {{ $products->appends(request()->input())->links()}}--}}


            </div><!-- Wrapper -->
            <div class="uk-flex uk-flex-row uk-flex-center uk-margin-large-top">{{ $products->links('vendor.pagination.uikit') }}</div>

        </div><!-- container ends -->
    </div>






@endsection
