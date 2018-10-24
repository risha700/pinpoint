@inject('products', 'App\Product')

@extends('layouts.app')
@section('hero')
    <div class="uk-section uk-section-overlap"></div>
    {{--<a href="{{ URL::previous() }}" class="uk-button-secondary uk-button-small uk-border-rounded" uk-icon="arrow-left" ></a>--}}
        {{ Breadcrumbs::render('showProduct', $product) }}


@endsection
@section('content')

    <!-- Product details section -->

    <div class="uk-section uk-section-muted">
        <div>

            <div class="uk-grid-match uk-child-width-1-2@m" uk-grid>
                <!-- left side -->
                <div class="uk-card-default ">

                    <!-- Vertical ThumbNav -->

                    <div class="uk-position-relative uk-flex uk-flex-middle" uk-slideshow="animation: fade" >

                        <div class="uk-position-small uk-width-1-3 ">
                            <ul class="uk-thumbnav uk-thumbnav-vertical" uk-margin>

                                <?php $i=0 ?>
                                @foreach($product->photos as $key=>$photo)

                                    <li uk-slideshow-item="{{$key++}}">


                                        <a href=""><img src="{{$photo->path}}" width="100" alt="{{$product->name}}"></a>

                                    </li>
                                @endforeach


                            </ul>
                        </div>

                        <!-- lightbox -->

                        <div class="uk-position-small uk-width-3-1">
                            <ul class="uk-slideshow-items" uk-lightbox="animation: slide">
                                @foreach($product->photos as $photo)

                                <li class="uk-flex uk-flex-middle">
                                        <a class="uk-inline" href="{{$photo->path}}" data-caption="{{$product->name}}">

                                            <img src="{{$photo->path}}" alt="{{$product->name}}" >
                                        </a>
                                </li>
                                @endforeach


                            </ul>
                        </div>


                    </div>
                </div>

                <!-- right section side -->


                <div class="section">
                    <div class=" uk-container uk-article">
                        <div class="uk-article-title">
                            <p>{{$product->name}}</p>
                            <p>{{$product->details}}</p>
                        </div>
                        <div class="uk-article-meta">
                            <p>{{$product->description}}</p>
                        </div>
                        <p>{{presentPrice($product->price)}}</p>
                        <form action="{{route('cart.store')}}" method="POST">

                            @csrf
                            <input type="hidden" name="id" value="{{$product->id }}">
                            <input type="hidden" name="name" value="{{$product->name }}">
                            <input type="hidden" name="price" value="{{$product->price }}">
                            Available in:

                            @foreach($product->options as $key => $option)
                                {{$key}}
                                <select name="options-{{$key}}" class="uk-select uk-border-rounded">
                                    @foreach($option as $i=>$val)
                                        <option value="{{$val}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            @endforeach

                            {{--<select name="options" class="uk-select">--}}
                                {{--@foreach($product->options as $option)--}}
                                    {{--<option value="{{$option->name}}">{{$option->type}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            {{--@foreach(sort_array_of_array($product->options, 'name', 'type') as $key=>$option)--}}
                                {{--{{$key}}--}}
                                {{--<select name="options-{{$key}}" class="uk-select uk-border-rounded">--}}
                                    {{--@foreach($option as $value)--}}
                                       {{--<option value="{{$value}}">{{$value}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--@endforeach--}}

                            <button type="submit" class="uk-button uk-button-secondary uk-border-rounded">Add to cart</button>
                        </form>
                    </div>
                </div>


                </div>  <!-- Section ends -->


        </div>
    </div>
{{--temporary adding product photos--}}
    <div class="js-upload uk-placeholder uk-text-center">
        <span uk-icon="icon: cloud-upload"></span>
        <form action="{{ url('/shop', $product->slug) }}" enctype="multipart/form-data" method="POST">
            @csrf
            {{ method_field('PATCH') }}
            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
            <input type="file" name="file" id="file">
            <button type="submit">upload</button>

        </form>
    </div>


    <!-- Related Product slider -->
    <div>

        <div class="uk-container">
            <h1 class="uk-heading-line uk-text-center uk-padding-large"><span>Products you may like</span></h1>

            <div uk-slider="center: true">

                <div class="uk-position-relative uk-visible-toggle uk-light">

                    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid uk-grid-match">
                        @foreach($products->mayLike()->get() as $product)

                        <li>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-media-top">
                                    <img src="/product.jpg" alt="">
                                </div>
                                <div class="uk-card-body">
                                    <h3 class="uk-card-title">{{$product->name}}</h3>
                                    <p>{{$product->details}}</p>
                                </div>
                            </div>
                        </li>

                        @endforeach
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-background-secondary" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-background-secondary" href="#" uk-slidenav-next uk-slider-item="next"></a>

                </div>

                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

            </div>
        </div>
    </div>
@endsection
