<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{


    /**
     * Move from cart to wishlist
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $item = Cart::get($id);
        Cart::remove($id);

        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });
        if ($duplicates->isNotEmpty()) {
            if(\request()->wantsJson()){
                return response()->json('item already in your wish list', 302);
            }
            flash(null,'item already on your wish list');
            return back();
        }




        Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)->associate('App\Product');
        if(\request()->wantsJson()){
            return response()->json('item has added to wish list', 203);
        }
        flash()->success('item saved to your wish list', null);
        return redirect()->route('cart.index');

    }

    /**
     * Store a wishlist product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id ===  $request->id;
        });
        if ($duplicates->isNotEmpty()) {
            if(\request()->wantsJson()){
                return response()->json('item already in your wish list', 302);
            }
            flash(null, 'item already in your wish list');

            return back();
        }

        Cart::instance('wishlist')->add($request->id, $request->name, 1, $request->price )->associate('App\Product');
        if(\request()->wantsJson()){
            return response()->json('item saved to your wish list', 203);
        }
        flash()->success('item saved to your wish list', null);

        return back();





    }



    /**
     * Move product from wishlist to cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        $item = Cart::instance('wishlist')->get($id);


        $level = Product::where('id', $item->id)->firstOrFail();


        if(!$level->stock > 0) {
            if(\request()->wantsJson()){
                return response()->json('Sorry...out of stock', 302);
            }
            flash(null, 'Sorry, Item is out of stock');
            return back();

        };



        Cart::instance('wishlist')->remove($id);


        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            if(\request()->wantsJson()){
                return response()->json('Item is already in your cart', 302);
            }
            flash(null,'item already on your cart');

            return redirect()->route('cart.index');
        }

        if(!$item->stock > 0) {

            Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
                ->associate('App\Product');
            if(\request()->wantsJson()){
                return response()->json('Item now in your shopping cart', 203);
            }
            flash()->success('Item now in your shopping cart', null);

            return redirect()->route('cart.index');
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

        Cart::instance('wishlist')->remove($id);
        if(\request()->wantsJson()){
         return response()->json('Item removed', 203);
        }
        flash()->success('item removed from your wish list', null);
        return back();

    }


}
