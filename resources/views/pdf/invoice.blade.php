

<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Invoice{{$order->id}}</title>
    </head>
    <body>


          <h1 style="text-align: center;">Thanks for your purchase <span class="title">{{$order->name}}</span></h1>


        <table style="width: 100%; border: #5B7BB5" class="uk-table">
            <tr style="background: #5B7BB5;border:1px solid">
                <th>item</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>

            @foreach($order->products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->pivot->quantity}}</td>
                    <td>{{presentPrice($product->price)}}</td>
                </tr>

            @endforeach

            <tr>
                <td>Subtotal</td>
                <td></td>
                <td> {{presentPrice($order->subtotal)}}</td>
            </tr>
            <tr>
                <td>Tax</td>
                <td> </td>
                <td>{{presentPrice($order->tax)}}</td>
            </tr>
            <tr>
                <td> Total</td>
                <td></td>
                <td>  {{presentPrice($order->total)}}</td>
            </tr>



        </table>

    </body>
</html>