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
    public function it_list_all_regions()
    {
      factory(Region::class, 5)->create();

      $regios = Region::list_regions();
      $this->assertCount(5, $regios);
    }

    /** @test **/
    public function describe_region_item()
    {
      factory(Region::class)->create([
        'id' => 1,
        'name' => "Extremidad Superior"
      ]);

      $regios_first = Region::list_regions()->first();
      $this->assertEquals("Extremidad Superior", $regios_first->name);
      $this->assertEquals(1, $regios_first->id);
    }
}
