<?php

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Region::store_region([
        'name' => "Cabeza",
        'children' => [
          ['name' => "Cara"],
          ['name' => "Craneo"]
        ],
      ]);
      Region::store_region(['name' => "Cuello"]);
      Region::store_region(['name' => "Tronco"]);
      Region::store_region(['name' => "Tórax"]);
      Region::store_region([
        'name' => "Extremidad Superior",
        'children' => [
          ['name' => "Hombro"],
          ['name' => "Brazo"],
          ['name' => "Codo"]
        ],
      ]);
    }
}
