<?php

use Illuminate\Database\Seeder;
use App\Motor;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Motor::create([
            'brand_name'=>'Zuzuki',
            'description'=>'xrm 450'
        ]);
        Motor::create([
            'brand_name'=>'Honda',
            'description'=>'Mio Soul'
        ]);

    }
}
