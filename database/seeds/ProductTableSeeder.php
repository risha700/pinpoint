<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([

            'name'=>'Macbook Pro',
            'slug'=>'macbook-pro',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised',
            'details'=>'15 inch | SSD RAM',
            'price'=>79009,
            'stock'=>11,


        ]);
        Product::create([

            'name'=>'Laptop 1',
            'slug'=>'laptop-1',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised',
            'details'=>'15 inch | SSD RAM',
            'price'=>66777,
            'stock'=>1,


        ]);
        Product::create([

            'name'=>'Laptop 2',
            'slug'=>'laptop-2',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised',
            'details'=>'13 inch | SSD RAM',
            'price'=>77662,
            'stock'=>10,


        ]);
        Product::create([

            'name'=>'Laptop 3',
            'slug'=>'laptop-3',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised',
            'details'=>'15 inch | SSD RAM',
            'price'=>55563,
            'stock'=>3,


        ]);
        Product::create([

            'name'=>'Laptop 4',
            'slug'=>'laptop-4',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised',
            'details'=>'15 inch | SSD RAM',
            'price'=>55566,
            'stock'=>11,


        ]);
        Product::create([

            'name'=>'Laptop 5',
            'slug'=>'laptop-5',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised',
            'details'=>'15 inch | SSD RAM',
            'price'=>79009,
            'stock'=>11,


        ]);

    }
}
