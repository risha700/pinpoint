<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', url('/'), ['icon'=>'home.svg']);
});

// Home > Shop
Breadcrumbs::for('product', function ($trail) {
    $trail->parent('home');
    $trail->push('Shop', route('shop.index'));

});

// Home > Product > [id]
//Breadcrumbs::for('showProduct', function ($trail, $product) {
//    $trail->parent('product');
//    $trail->push( $product->name , route('shop.show', $product->slug) );
//
//
//
//});


// Home > Product > category
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('product');
    $trail->push($category->name, route('shop.index', ['category'=>$category->slug]));

});

// Home > Product > category->[slug] > product[slug]
Breadcrumbs::for('showProduct', function ($trail, $product) {
    $trail->parent('category', $product->categories[0]);
    $trail->push( $product->name , route('shop.show', $product->slug) );



});



// Home > Shop > [Category]

Breadcrumbs::after(function ($trail) {

    $page = explode('=',  \Request::fullUrl());

    if (\Request::has('category')) {
        $trail->push($page[1] , null, ['current' => false]);
    }


});


