<?php

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Element;

class ArmBonesElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       $region = Region::where(['name' => 'Brazo'])->get()->first();
       $element = Element::where(['name' => "Húmero"])->get()->first();

       $region->elements()->attach($element);
     }
}
