<?php


Auth::routes();

Route::get('/', function () {
    return view('landing');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/{product}', 'ProductController@update')->name('product.show');
Route::post('/product/{product}', 'ProductController@update')->name('upload');
Route::resource('/product', 'ProductController');



Route::resource('cart', 'CartController');
Route::resource('checkout', 'CheckoutController');



Route::post('coupon', 'CouponController@store')->name('coupon.store');
Route::delete('coupon', 'CouponController@destroy')->name('coupon.destroy');



Route::post('cart/{product}/wishlist', 'WishlistController@create')->name('cart.wishlist');
Route::post('wishlist', 'WishlistController@store')->name('wishlist.store');
Route::post('wishlist/{product}', 'WishlistController@update')->name('cart.restore');
Route::delete('wishlist/{product}', 'WishlistController@destroy')->name('wishlist.destroy');


Route::get('test', function (){
    return view('test');
});

Route::post('/test', function (\Illuminate\Http\Request $request){

    $request->validate([
        'name' => 'required',
        'description' => 'required ',
    ]);
    return response()->json($request->all(), 203, ['message'=>'success']);

});
Route::post('/test2', function (\Illuminate\Http\Request $request){
    $request->validate([
        'name' => 'required|max:10',
        "email" => 'required | email',
        "phone" => 'required | digits:10 ',
        "address" => 'required',
    ]);
    return response()->json($request->all(), 203, ['message'=>'success']);

});

