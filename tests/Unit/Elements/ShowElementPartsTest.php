<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;
use App\Models\ElementRegion;

class ShowElementPartsTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_elements_parts()
  {
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

    $parts = $element->parts();
    $this->assertCount(1, $parts);
  }
}
