<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;

class UpdateRegionTest extends TestCase
{
  use RefreshDatabase;


  public function update_region_with_no_name()
  {
    $region = factory(Region::class)->create([
      "name" => "Cabeza"
    ]);

    $region_data = [
      'name' => ""
    ];

    $region_name_error = Region::update_region($region->id, $region_data)->errors()->messages()['name'][0];

    $this->assertEquals("Es obligarorio", $region_name_error);
  }


  public function update_region_with_same_name()
  {
    $region = factory(Region::class)->create([
      "name" => "Cabeza"
    ]);

    $region_data = [
      'name' => "Cabeza"
    ];

    Region::update_region($region->id, $region_data);
    $this->assertDatabaseHas('regions', [
      'name' => "Cabeza"
    ]);
  }

  /** @test **/
  public function update_parent_id_region()
  {
    $region = factory(Region::class)->create([
      "name" => "Mano"
    ]);

    $region_child = factory(Region::class)->create([
      "name" => "Dedos"
    ]);

    $region_data = [
      "name" => "Dedos",
      'parent_id' => $region->id
    ];

    Region::update_region($region_child->id, $region_data);
    $this->assertDatabaseHas('regions', [
      'parent_id' => $region->id
    ]);
  }
}
