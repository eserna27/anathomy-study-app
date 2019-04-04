<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;
use App\Models\ElementRegion;

class ShowRootElementsWithPartsTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_root_elements_with_parts()
  {
    $region = factory(Region::class)->create([
      'id' => 1,
      'name' => "Extremidad Superior"
    ]);
    $system = factory(System::class)->create([
      'id' => 1,
      'name' => "Sistema Esqueletico"
    ]);
    $element = factory(Element::class)->create([
      'name' => "Clavícula",
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
    $region->elements()->attach($element_child);
    $region->elements()->attach($element_child_2);

    $root_elements = $region->elements;
    $this->assertCount(1, $root_elements);

    $child_elements_1 = $root_elements[0]->parts();
    $this->assertCount(1, $child_elements_1);

    $child_elements_2 = $child_elements_1[0]->parts();
    $this->assertCount(1, $child_elements_2);
  }
}
