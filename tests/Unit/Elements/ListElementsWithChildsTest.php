<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;
use App\Models\ElementRegion;

class ListElementsWithChilds extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function list_elements_with_childs()
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
      'parent_id' => $element_child->id
    ]);
    $region->elements()->attach($element);
    $region->elements()->attach($element_child);
    $region->elements()->attach($element_child_2);

    $elements_with_childs = $element->list_elements_with_childs($region->id)->first();
    $this->assertEquals("Extremo proximal", $elements_with_childs['element']->name);
    $this->assertEquals("Cabeza", $elements_with_childs['childs']->first()->name);
  }
}
