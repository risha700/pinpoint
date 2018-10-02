@inject('product', 'App\Product')

<p >You currently have {{Cart::instance('wishlist')->count()}} {{ str_plural('item',Cart::count() ) }} in your wish list.</p>

            <table class="">

                @foreach (Cart::instance('wishlist')->content() as $item)
                    <tbody class="">
                    <tr>

                        <td>
                            <a href="{{ route('product.show', $item->model->slug ) }}">
                                <img src="/{{$product->photos()->pluck('path')->first()?:'product.jpg'}}" alt="{{$product->name}}" style="height: 20px;"/>
                            </a>
                        </td>
                        <td><a href="{{ route('product.show', $item->model->slug ) }}">{{$item->model->name}}</a>
                        </td>

                        {{--<td>{{presentPrice($item->model->price)}}</td>--}}

                        <td class="uk-flex">


                            <form action="{{route('wishlist.destroy', $item->rowId )}}" method="POST" class="uk-flex-between">

                                @csrf
                                {{ method_field('DELETE') }}

                                <button type="submit" class="uk-button-link uk-button-small uk-button uk-margin-small-left"><span uk-icon="icon: trash"></span></button>

                            </form>

                            <form action="{{route('cart.restore', $item->rowId)}}" method="POST" class="uk-margin-small-left">

                                @csrf
                                <input type="hidden" name="id" value="{{$item->model->id }}">
                                <input type="hidden" name="name" value="{{$item->model->name }}">
                                <input type="hidden" name="price" value="{{$item->model->price }}">
                                <button type="submit" class="uk-button-link uk-button-small uk-button"><span uk-icon="icon: cart"></span></button>
                            </form>

                        </td>
                    </tr>

                    </tbody>
                @endforeach
            </table>
