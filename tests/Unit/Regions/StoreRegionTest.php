<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;

class StoreRegionTest extends TestCase
{
  use RefreshDatabase;
  /** @test **/
  public function store_region_with_no_name()
  {
    $region_data = [
      'name' => ""
    ];

    $region_name_error = Region::store_region($region_data)->errors()->messages()['name'][0];

    $this->assertEquals("Es obligarorio", $region_name_error);
  }

  /** @test **/
  public function store_region_with_same_name()
  {
    factory(Region::class)->create([
      'name' => "Cabeza"
    ]);

    $region_data = [
      'name' => "Cabeza"
    ];

    $region_name_error = Region::store_region($region_data)->errors()->messages()['name'][0];

    $this->assertEquals("No se puede repetir", $region_name_error);
  }
}
