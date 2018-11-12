<?php


Auth::routes();

Route::get('/', function () {
    return view('landing');
});


Route::Resource('dashboard', 'DashboardController');
Route::get('dashboard', 'DashboardController@index')->name('dashboard');



Route::resource('/shop', 'ProductController');
Route::get('/shop/{product}', 'ProductController@show')->name('product.show');
Route::post('/shop/{product}', 'ProductController@update')->name('upload');



Route::resource('cart', 'CartController');
Route::resource('checkout', 'CheckoutController');



Route::post('coupon', 'CouponController@store')->name('coupon.store');
Route::delete('coupon', 'CouponController@destroy')->name('coupon.destroy');



Route::post('cart/{product}/wishlist', 'WishlistController@create')->name('cart.wishlist');
Route::post('wishlist', 'WishlistController@store')->name('wishlist.store');
Route::post('wishlist/{product}', 'WishlistController@update')->name('cart.restore');
Route::delete('wishlist/{product}', 'WishlistController@destroy')->name('wishlist.destroy');

