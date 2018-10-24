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

//        Cataract Group
        $p1 = Product::create([

            'name'=>'Case',
            'slug'=>'case-100',
            'description'=>'High quality frames with UV 400 Polycarbonate safety lenses for maximum post-op protection. Amber lenses achieve soothing, comfortable vision with enhanced contrast and reduced glare.',
            'details'=>'Case 100pcs',
            'price'=>35000,
            'stock'=>11,


        ]);
           $p1->categories()->attach(1);
           $p1->options()->attach([1,2,4,5]);


       $p2= Product::create([

            'name'=>'box',
            'slug'=>'box-20',
            'description'=>'High quality frames with UV 400 Polycarbonate safety lenses for maximum post-op protection. Amber lenses achieve soothing, comfortable vision with enhanced contrast and reduced glare.',
            'details'=>'Box 20pcs',
            'price'=>8500,
            'stock'=>11,


        ]);
       $p2->categories()->attach(1);
       $p2->options()->attach([1,2,4,5]);


        $p3 = Product::create([

            'name'=>'Case Plus',
            'slug'=>'case-plus-100',
            'description'=>'High quality frames with UV 400 Polycarbonate safety lenses for maximum post-op protection. Amber lenses achieve soothing, comfortable vision with enhanced contrast and reduced glare. +2.50 Readers and Zippered Nylon Pouch',
            'details'=>'Case Upgrade 20pcs',
            'price'=>49500,
            'stock'=>11,


        ]);
        $p3->categories()->attach(1);
        $p3->options()->attach([1,2,4,5]);

        $p4 = Product::create([

            'name'=>'Box Plus',
            'slug'=>'box-plus-20',
            'description'=>'High quality frames with UV 400 Polycarbonate safety lenses for maximum post-op protection. Amber lenses achieve soothing, comfortable vision with enhanced contrast and reduced glare. +2.50 Readers and Zippered Nylon Pouch',
            'details'=>'Box Upgrade 20 pcs',
            'price'=>11900,
            'stock'=>11,


        ]);
        $p4->categories()->attach(1);
        $p4->options()->attach([1,2,4,5]);

        $p5= Product::create([

            'name'=>'Cataract Glasses Only',
            'slug'=>'cataract-glasses',
            'description'=>'High quality  UV 400 Polycarbonate safety lenses for maximum post-op protection. Amber lenses achieve soothing, comfortable vision with enhanced contrast and reduced glare. +2.50 Readers and Zippered Nylon Pouch',
            'details'=>'Contains Glasses Only',
            'price'=>6000,
            'stock'=>11,


        ]);
        $p5->categories()->attach(1);
        $p5->options()->attach([1,2,4,5]);



//        Lasik Group


        Product::create([

            'name'=>'Case',
            'slug'=>'case-100-polk',
            'description'=>'High quality frames with UV 400 Polycarbonate safety lenses for maximum post-op protection. Amber lenses achieve soothing, comfortable vision with enhanced contrast and reduced glare.',
            'details'=>'Case 100pcs',
            'price'=>49500,
            'stock'=>11,


        ])->categories()->attach(2);

        Product::create([

            'name'=>'box',
            'slug'=>'box-20-polk',
            'description'=>'High quality frames with UV 400 Polycarbonate safety lenses for maximum post-op protection. Amber lenses achieve soothing, comfortable vision with enhanced contrast and reduced glare.',
            'details'=>'Box 20pcs',
            'price'=>11000,
            'stock'=>11,


        ])->categories()->attach(2);

        Product::create([

            'name'=>'Zippered Nylon Pouches',
            'slug'=>'zippered-nylon-pouch',
            'description'=>'High Quality Nylon Pouch',
            'details'=>'1 piece',
            'price'=>150,
            'stock'=>11,


        ])->categories()->attach(2);
        Product::create([

            'name'=>'Zippered Handled Pouches',
            'slug'=>'zippered-handled-pouch',
            'description'=>'High Quality Handled Pouch',
            'details'=>'1 piece',
            'price'=>150,
            'stock'=>11,


        ])->categories()->attach(2);
        Product::create([

            'name'=>'Zippered Nylon Pouches',
            'slug'=>'zippered-nylon-pouch-bundled',
            'description'=>'High Quality Nylon Pouch **with post op kit purchase',
            'details'=>'1 piece',
            'price'=>100,
            'stock'=>11,


        ])->categories()->attach(2);
        Product::create([

            'name'=>'Zippered Handled Pouches',
            'slug'=>'zippered-handled-pouch-bundled',
            'description'=>'High Quality Handled Pouch **with post op kit purchase',
            'details'=>'1 piece',
            'price'=>100,
            'stock'=>11,


        ])->categories()->attach(2);

        Product::create([

            'name'=>'Lasik Glasses',
            'slug'=>'lasik-glasses-box-24',
            'description'=>'Lasik Glasses - Box (24)',
            'details'=>'24pcs',
            'price'=>5000,
            'stock'=>11,


        ])->categories()->attach(2);

        Product::create([

            'name'=>'Dual Eye Shield',
            'slug'=>'dual-eye-shield-20',
            'description'=>'Dual Eye Shield - Box (20)',
            'details'=>'20pcs',
            'price'=>5000,
            'stock'=>11,


        ])->categories()->attach(2);

        Product::create([

            'name'=>'30ft Paper Tape (20)',
            'slug'=>'paper-tape-30ft',
            'description'=>'Quality Paper Tape',
            'details'=>'20pcs',
            'price'=>1400,
            'stock'=>11,


        ])->categories()->attach(2);
        Product::create([

            'name'=>'30ft Paper Tape (50)',
            'slug'=>'paper-tape-30ft50',
            'description'=>'Quality Paper Tape',
            'details'=>'50pcs',
            'price'=>3500,
            'stock'=>11,


        ])->categories()->attach(2);
        Product::create([

            'name'=>'Polycarbonate Eye Shield (20)',
            'slug'=>'polycarbonate-eye-shield20',
            'description'=>'Quality Polycarbonate Eye Shield',
            'details'=>'20pcs',
            'price'=>1200,
            'stock'=>11,


        ])->categories()->attach(2);
        Product::create([

            'name'=>'Polycarbonate Eye Shield (50)',
            'slug'=>'polycarbonate-eye-shield50',
            'description'=>'Quality Polycarbonate Eye Shield',
            'details'=>'50pcs',
            'price'=>3000,
            'stock'=>11,


        ])->categories()->attach(2);
        Product::create([

            'name'=>'Reading Glasses +2.50 - Box (12)',
            'slug'=>'reading-glasses',
            'description'=>'Quality Reading Glasses +2.50 - Box (12)',
            'details'=>'12pcs',
            'price'=>3000,
            'stock'=>11,


        ])->categories()->attach(2);

       $p6= Product::create([

            'name'=>'Sport Glasses - Box (12)',
            'slug'=>'sports-glasses',
            'description'=>'Quality Sport Glasses',
            'details'=>'12pcs',
            'price'=>3000,
            'stock'=>11,


        ]);
       $p6->categories()->attach(2);
       $p6->options()->attach([5,6,7]);

//       wearover
        $p7=Product::create([

            'name'=>'Low Vision/Night Driving - Box ',
            'slug'=>'low-vision-night-driving',
            'description'=>'Quality Low Vision/Night Driving - Box (12)',
            'details'=>'12pcs',
            'price'=>6000,
            'stock'=>11,


        ]);
        $p7->categories()->attach(3);
        $p7->options()->attach([1,2,3]);

        $p8=Product::create([

            'name'=>'WearOver Amber Lens - Box ',
            'slug'=>'wearover-amber-lens',
            'description'=>'Quality  WearOver Amber Lens - Box (12)',
            'details'=>'12pcs',
            'price'=>6000,
            'stock'=>11,


        ]);
        $p8->categories()->attach(3);
        $p8->options()->attach([1,2,8,9]);

        $p9=Product::create([

            'name'=>'Polarized Amber Lens - Box ',
            'slug'=>'polarized-amber-lens',
            'description'=>'Quality  Polarized Amber Lens - Box (12)',
            'details'=>'12pcs',
            'price'=>9600,
            'stock'=>11,


        ]);
        $p9->categories()->attach(3);
        $p9->options()->attach([1,3]);



    }
}
