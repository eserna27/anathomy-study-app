<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;
use App\Models\ElementRegion;

class RelatedRegionsTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function related_regions()
  {
    $region = factory(Region::class)->create([
      'id' => 1,
      'name' => "Hombro"
    ]);
    $region_2 = factory(Region::class)->create([
      'id' => 2,
      'name' => "Brazo"
    ]);
    $region_3 = factory(Region::class)->create([
      'id' => 3,
      'name' => "codo"
    ]);
    $system = factory(System::class)->create([
      'id' => 1,
      'name' => "Sistema Esqueletico"
    ]);
    $element = factory(Element::class)->create([
      'name' => "Humero",
      'kind' => "bone",
      'system_id' => $system->id
    ]);
    $element_child = factory(Element::class)->create([
      'name' => "Extremo proximal",
      'kind' => "bone",
      'system_id' => $system->id,
      'parent_id' => $element->id
    ]);
    $element_child_2 = factory(Element::class)->create([
      'name' => "Cabeza",
      'kind' => "bone",
      'system_id' => $system->id,
      'parent_id' => $element_child->id
    ]);

    $region->elements()->attach($element);
    $region_2->elements()->attach($element_child);
    $region_3->elements()->attach($element_child_2);

    $region_related = $region->related_regions();
    $this->assertCount(3, $region_related);
  }
}
