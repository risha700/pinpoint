<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Notifications\OrderPlaced;
use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use PhpParser\Node\Expr\Cast\Object_;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {

        if(Cart::content()->isEmpty()){

            flash()->overlay('Opps', "Feed your cart to check it out", 'warning' );
            return redirect()->route('checkout.index');
        }

        return view('checkout.index')->with([

            'discount'=>$order->getNumbers()->get('discount'),
            'newSubtotal'=>$order->getNumbers()->get('newSubtotal'),
            'newTax'=>$order->getNumbers()->get('newTax'),
            'newTotal'=>$order->getNumbers()->get('newTotal'),

        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request, Order $order)
    {
        try{

            $order->charge($request);
            $order = $order->persist($request, null);

            $invoice = $order->generateInvoice($order);

//            Mail::send(new YourOrderPlaced($order, $invoice));
//            event(new OrderPlaced($order));
//            Notification::route('mail', $order->email)->notify(new OrderPlaced($order, $invoice));


            $order->notify(new OrderPlaced($order, $invoice));



            $order->products->each(function($product){

                 $product->decrement('stock', $product->pivot->quantity);

             });


            Cart::instance('default')->destroy();

            if (session()->has('coupon')){
                session()->forget('coupon');

            }

                if(!$request->wantsJson()){
                    flash()->overlay('Order Placed successfully', 'Please check your email for details');
                    return redirect(route('product.index'));

                }
                return response()->json('Thanks for your order '.$request->name, 201);

             }catch (\Exception $e){
                 $order->persist($request, $e->getMessage());

                if(!$request->wantsJson()){
                    flash()->overlay('Something went wrong',$e->getMessage(), 'error');
                    return back();
                }
                return response()->json(['errors'=>['card'=>$e->getMessage()]],422);
//                return response()->json([],422);

            }
    }


}
