<?php

namespace Tests\Unit\ElementRegions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Element;
use App\Models\Region;
use App\Models\ElementRegion;

class RemoveElementForRegionTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function remove_element_for_region()
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

    $region_2 = factory(Region::class)->create();
    $data_2 = [
      'element_id' => $element->id,
      'region_id' => $region_2->id,
    ];
    ElementRegion::add_region($data_2);
    $this->assertDatabaseHas('element_regions', [
      'element_id' => $element->id,
      'region_id' => $region_2->id,
    ]);

    ElementRegion::remove_element_for_region($element->id, $region_2->id);

    $this->assertDatabaseMissing('element_regions', [
      'element_id' => $element->id,
      'region_id' => $region_2->id,
    ]);
  }

  /** @test **/
  public function remove_element_for_region_with_only_one_region()
  {
    $element = factory(Element::class)->create();
    $region = factory(Region::class)->create();
    $data = [
      'element_id' => $element->id,
      'region_id' => $region->id,
    ];
    ElementRegion::add_region($data);

    ElementRegion::remove_element_for_region($element->id, $region->id);

    $this->assertDatabaseHas('element_regions', [
      'element_id' => $element->id,
      'region_id' => $region->id,
    ]);
  }

  /** @test **/
  public function element_can_remove_region()
  {
    $element = factory(Element::class)->create();
    $region = factory(Region::class)->create();
    $data = [
      'element_id' => $element->id,
      'region_id' => $region->id,
    ];
    ElementRegion::add_region($data);

    $this->assertEquals(false, $element->can_remove_region());
  }
}
