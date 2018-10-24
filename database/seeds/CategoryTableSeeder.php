<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([

            'name'=>'Cataract Kits',
            'slug'=>'cataract-kits',
            'detail'=>'POCK',

        ]);
        Category::create([

            'name'=>'Lasik Kits',
            'slug'=>'lasik-kits',
            'detail'=>'',

        ]);
        Category::create([

            'name'=>'WearOver Glasses',
            'slug'=>'wearover-glasses',
            'detail'=>'',

        ]);
    }
}
