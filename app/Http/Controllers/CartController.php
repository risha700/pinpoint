<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->wantsJson()){

            return response()->json([
                'cartContent' => Cart::content()->values(),
                'cartTax' => Cart::tax(),
                'cartSubtotal' => Cart::subtotal(),
                'cartTotal' => Cart::total(),
                'cartCount' => Cart::count(),
                'wishList' => Cart::instance('wishlist')->content()->values(),
            ]);


        }


        $slug = Product::pluck('slug');
        $product = Product::where('slug', $slug)->firstOrFail();
//        $wishlist = Product::where('slug','!=', $slug)->inRandomOrder()->take(3)->get();
        // $mightAlsoLike = Product::inRandomOrder()->take(3)->get();

        return view('cart.index')->with('product', $product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = Product::where('id', $request->id)->firstOrFail();

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($request) {

            if( $request->options != [] && isset($cartItem->options[0])){
                if ($request->options != $cartItem->options[0]){
                    return false;
                }
            }

            return $cartItem->id ===  $request->id;

        });


        if ($duplicates->isNotEmpty()) {

            if ($request->wantsJson()){


                return response('Item is already in your cart', 307);
            }

            flash(null, 'Item is already in your cart');
            return back();

        }

//
        if(!$product->stock > 0){

            if ($request->wantsJson()){
                return response('Sorry! this product is out of stock', 403);
            }
            flash(null,'Sorry! this product is out of stock');

            return back();
        }

        if($request->options){
            Cart::instance('default')->add($request->id, $request->name, $request->quantity = 1, $request->price, [presentOptions($request->options)] )
                ->associate('App\Product');
        }else{

            Cart::instance('default')->add($request->id, $request->name, $request->quantity = 1, $request->price)
                ->associate('App\Product');
        }

        if ($request->wantsJson()){

            return response('Added to your cart', 200);
        }


        flash()->success('Item added to your cart', null);
        return redirect()->route('cart.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('cart.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', request()->id)->firstOrFail();

        if ($request->wantsJson()){

            if($product->stock < $request->quantity) return response()->json('Sorry...out of stock', 306);

                Cart::update($id, $request->quantity);
                return response()->json('Quantity updated', 201);







        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        if(request()->wantsJson()){

            return response('Item removed', 200);

        }
        flash()->success('Item removed from your cart', null);


        return back();
    }






}
