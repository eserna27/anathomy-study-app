<?php

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;

class ShoulderBonesElementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $region = Region::where(['name' => 'Hombro'])->get()->first();
      $system = System::where(['name' => 'Sistema Esqueletico'])->get()->first();
      $element_kind = 'bone';

      Element::store_element([
        'name' => "Clavícula",
        'kind' => $element_kind,
        'region_id' => $region->id,
        'system_id' => $system->id,
      ]);

      Element::store_element([
        'name' => "Escápula",
        'kind' => $element_kind,
        'region_id' => $region->id,
        'system_id' => $system->id,
      ]);

      Element::store_element([
        'name' => "Húmero",
        'kind' => $element_kind,
        'region_id' => $region->id,
        'system_id' => $system->id,
      ]);
    }
}
