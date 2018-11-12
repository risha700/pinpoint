<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Photo;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{


    public function index()

    {

//infinite loading setup
//       return $products = Product::paginate(9);
        if (request()->category){

            $cat = Category::where('slug',request()->category)->with('products')->get();
        }else{

            $cat = Category::with('products')->get();
        }


        return response()->json($cat);
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
        //
    }


    public function showCart()
    {


            return response()->json([
                'cartContent' => Cart::content(),
                'cartTax' => Cart::tax(),
                'cartSubtotal' => Cart::subtotal(),
                'cartTotal' => Cart::total(),
                'cartCount' => Cart::count(),
            ]);



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
    public function update()
    {

        if (request()->category){

            $cat = Product::with('categories')->whereHas('categories', function ($query){
                $query->where('slug', request()->category);
            })->get();

        }else{

            $cat = Category::with('products')->get();
        }


        return response()->json($cat);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
