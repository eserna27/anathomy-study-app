<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;

class ShowRegionTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function find_region()
    {
      $id = rand();
      factory(Region::class)->create([
        'id' => $id,
        'name' => "Extremidad superior"
      ],
      [
        'id' => $id+1,
        'name' => "Cabeza"
      ]);

      $region = Region::find_region($id);
      $this->assertEquals($id, $region->id);
      $this->assertEquals("Extremidad superior", $region->name);
    }
}
