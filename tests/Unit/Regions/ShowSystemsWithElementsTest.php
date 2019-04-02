<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;
use App\Models\Region;
use App\Models\Element;

class ShowSystemsWithElementsTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_systems_with_elements()
  {
    $system = factory(System::class)->create();
    $system_2 = factory(System::class)->create();
    $region = factory(Region::class)->create([
      'id' => 1,
      'name' => "Extremidad Superior"
    ]);
    $element = factory(Element::class)->create([
      'name' => "Clavícula",
      'kind' => "bone",
      'system_id' => $system->id
    ]);
    $element_1 = factory(Element::class)->create([
      'name' => "Humero",
      'kind' => "bone",
      'system_id' => $system->id
    ]);
    $element_2 = factory(Element::class)->create([
      'name' => "Cubito",
      'kind' => "bone",
      'system_id' => $system_2->id
    ]);

    $region->elements()->attach($element);
    $region->elements()->attach($element_1);
    $region->elements()->attach($element_2);

    $system_with_elements = $region->show_systems_with_elements();

    $this->assertCount(2, $system_with_elements);
    $this->assertEquals($system->name, $system_with_elements[0]['system']->name);
    $this->assertEquals($system_2->name, $system_with_elements[2]['system']->name);

    $this->assertCount(2, $system_with_elements[0]['elements']);
  }
}
