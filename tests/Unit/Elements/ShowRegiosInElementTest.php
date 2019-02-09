<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;
use App\Models\ElementRegion;

class ShowRegiosInElementTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_regions_in_element()
  {
    $region_1 = factory(Region::class)->create([
      'id' => 1,
      'name' => "Hombro"
    ]);
    $region_2 = factory(Region::class)->create([
      'id' => 2,
      'name' => "Brazo"
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
    $element->regions()->attach($region_1);
    $element->regions()->attach($region_2);

    $regions = $element->regions()->get();
    $this->assertCount(2, $regions);
  }
}
