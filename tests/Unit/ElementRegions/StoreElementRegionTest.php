<?php

namespace Tests\Unit\ElementRegions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Element;
use App\Models\Region;
use App\Models\ElementRegion;

class StoreElementRegionTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function store_element_in_region_bad_params()
  {
    $element = factory(Element::class)->create();
    $data = [
      'element_id' => $element->id,
      'region_id' => "",
    ];

    $response_errors = ElementRegion::add_region($data)->errors()->messages();

    $region_error = $response_errors['region_id'][0];

    $this->assertEquals("Es obligarorio", $region_error);
  }

  /** @test **/
  public function store_element_in_region()
  {
    $element = factory(Element::class)->create();
    $region = factory(Region::class)->create();
    $data = [
      'element_id' => $element->id,
      'region_id' => $region->id,
    ];

    ElementRegion::add_region($data);

    $this->assertDatabaseHas('element_regions', [
      'element_id' => $element->id,
      'region_id' => $region->id,
    ]);
  }
}
