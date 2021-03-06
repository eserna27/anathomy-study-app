<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;

class ShowElementsForRegionsTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_elements_in_region()
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
    $region->elements()->attach($element);

    $elements = $region->elements()->get();
    $this->assertCount(1, $elements);
  }
}
