<?php

namespace App\Http\Controllers;

use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $coupon = Coupon::where('code', $request->code)->first();

        if(!$coupon){

            flash()->warning('Please try a different coupon', null);

            return back();
        }

        session()->put('coupon',[

            'name'=>$coupon->code,
            'value'=>$coupon->discount(Cart::subtotal())
        ]);

        flash()->success( 'Coupon Applied', null);

        return redirect()->route('checkout.index');


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        session()->forget('coupon');

        flash()->success( 'Coupon Removed', null);

        return redirect()->route('checkout.index');


    }
}
