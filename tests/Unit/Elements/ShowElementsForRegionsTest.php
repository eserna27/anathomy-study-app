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
    factory(Element::class)->create([
      'name' => "Clavícula",
      'kind' => "bone",
      'region_id' => $region->id,
      'system_id' => $system->id
    ]);

    $elements = $region->elements()->get();
    $this->assertCount(1, $elements);
  }
}
