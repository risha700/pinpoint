<?php



Route::get('/', function () {
    return view('landing');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/shop/{product}', 'ProductController@show')->name('product.show');
Route::post('/shop/{product}', 'ProductController@update')->name('upload');
Route::resource('/shop', 'ProductController');


Route::resource('cart', 'CartController');
Route::resource('checkout', 'CheckoutController');



Route::post('coupon', 'CouponController@store')->name('coupon.store');
Route::delete('coupon', 'CouponController@destroy')->name('coupon.destroy');



Route::post('cart/{product}/wishlist', 'WishlistController@create')->name('cart.wishlist');
Route::post('wishlist', 'WishlistController@store')->name('wishlist.store');
Route::post('wishlist/{product}', 'WishlistController@update')->name('cart.restore');
Route::delete('wishlist/{product}', 'WishlistController@destroy')->name('wishlist.destroy');

Auth::routes();
