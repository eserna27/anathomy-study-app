<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;
use App\Models\ElementRegion;

class ElementsPartsForRegionTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_elements_parts_for_region()
  {
    $system = factory(System::class)->create([
      'id' => 1,
      'name' => "Sistema Esqueletico"
    ]);
    $region = factory(Region::class)->create([
      'name' => "Extremidad Superior"
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
      'parent_id' => $element->id
    ]);
    $region->elements()->attach($element);
    $region->elements()->attach($element_child);

    $parts = $element->parts_for_region($region->id);
    $this->assertCount(1, $parts);
  }
}
