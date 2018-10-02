<?php

use Faker\Generator as Faker;




$factory->define(\App\Product::class, function (Faker $faker) {

    return[
        'name'=>'Macbook Pro2'.rand(1,1000),
        'slug'=>'macbook-pro'.rand(1,1000),
        'description'=>$faker->paragraph,
        'details'=>$faker->words(5,10),
        'price'=>rand(300,3000),
        'stock'=>rand(1,10),


    ];
});
