<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', url('/'), ['icon'=>'home.svg']);
});

// Home > Shop
Breadcrumbs::for('product', function ($trail) {
    $trail->parent('home');
    $trail->push('Shop', route('product.index'));

});

// Home > Product > [id]
Breadcrumbs::for('showProduct', function ($trail, $product) {
    $trail->parent('product');
    $trail->push( $product->name , route('product.show', $product->slug) );



});


// Home > Product > [Category]

Breadcrumbs::after(function ($trail) {

    $page = explode('=',  \Request::fullUrl());

    if (\Request::has('category')) {
        $trail->push($page[1] , null, ['current' => false]);
    }


});



//// Home > Product > category
//Breadcrumbs::for('showCategory', function ($trail, $product) {
//    $trail->parent('product');
//    $trail->push( $product->category->name , route('product.show', $product->category) );
//});


//Breadcrumbs::for('showCategory', function ($trail, $category) {
//    $trail->parent('product');
//    $trail->push($category->name, route('category', $category->id));
//});



//// Home > Blog
//Breadcrumbs::for('product', function ($trail) {
//    $trail->parent('home');
//    $trail->push('Blog', route('blog'));
//});
//

//
//// Home > Blog > [Category] > [Post]
//Breadcrumbs::for('post', function ($trail, $post) {
//    $trail->parent('category', $post->category);
//    $trail->push($post->title, route('post', $post->id));
//});