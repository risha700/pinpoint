<?php

use App\Option;
use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Option::create([

            'name'=>'size',
            'type'=>'Standard',
            'detail'=>'',

        ]);
        Option::create([

            'name'=>'size',
            'type'=>'Medium',
            'detail'=>'',

        ]);
        Option::create([

            'name'=>'size',
            'type'=>'Small',
            'detail'=>'',

        ]);
        Option::create([

            'name'=>'color',
            'type'=>'Amber',
            'detail'=>'',

        ]);
        Option::create([

            'name'=>'color',
            'type'=>'Grey',
            'detail'=>'',

        ]);
        Option::create([

            'name'=>'color',
            'type'=>'Yellow',
            'detail'=>'',

        ]);
        Option::create([

            'name'=>'color',
            'type'=>'Clear',
            'detail'=>'',

        ]);
        Option::create([

            'name'=>'color',
            'type'=>'Red',
            'detail'=>'',

        ]);
        Option::create([

            'name'=>'color',
            'type'=>'White',
            'detail'=>'',

        ]);
    }
}
