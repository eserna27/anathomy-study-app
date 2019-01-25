<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;

class ListRegionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_list_root_regions()
    {
      factory(Region::class, 5)->create();
      factory(Region::class)->create([
        "name" => "Cara",
        "parent_id" => 1
      ]);
      factory(Region::class)->create([
        "name" => "Craneo",
        "parent_id" => 1
      ]);

      $regions = Region::list_regions();
      $this->assertCount(5, $regions);
    }

    /** @test **/
    public function describe_region_item()
    {
      factory(Region::class)->create([
        'id' => 1,
        'name' => "Extremidad Superior"
      ]);

      $regions_first = Region::list_regions()->first();
      $this->assertEquals("Extremidad Superior", $regions_first->name);
      $this->assertEquals(1, $regions_first->id);
    }

    /** @test **/
    public function list_sub_regions_for_region()
    {
      $id = 1;
      factory(Region::class)->create([
        "id" => $id,
        "name" => "Cabeza"
      ]);
      factory(Region::class, 5)->create();
      factory(Region::class)->create([
        "name" => "Cara",
        "parent_id" => $id
      ]);
      factory(Region::class)->create([
        "name" => "Craneo",
        "parent_id" => $id
      ]);

      $sub_regions = Region::list_sub_regions_for_region($id);
      $this->assertCount(2, $sub_regions);
    }
}
