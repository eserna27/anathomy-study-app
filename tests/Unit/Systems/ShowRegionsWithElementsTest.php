<?php

namespace Tests\Unit\Systems;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;
use App\Models\Region;
use App\Models\Element;

class ShowRegionsWithElements extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_regions_with_elements()
  {
    $system = factory(System::class)->create();
    $system_2 = factory(System::class)->create();
    $region_1 = factory(Region::class)->create([
      'id' => 1,
      'name' => "Extremidad Superior"
    ]);
    $region_2 = factory(Region::class)->create([
      'id' => 2,
      'name' => "Hombro",
      'parent_id' => $region_1->id
    ]);
    $region_3 = factory(Region::class)->create([
      'id' => 3,
      'name' => "Brazo",
      'parent_id' => $region_1->id
    ]);
    $region_4 = factory(Region::class)->create([
      'id' => 4,
      'name' => "Cabeza"
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
      'system_id' => $system->id
    ]);
    $element_3 = factory(Element::class)->create([
      'name' => "Estomago",
      'kind' => "organ",
      'system_id' => $system_2->id
    ]);

    $region_1->elements()->attach($element);
    $region_2->elements()->attach($element);
    $region_3->elements()->attach($element_1);
    $region_3->elements()->attach($element_2);
    $region_3->elements()->attach($element_3);

    $region_with_elements = $system->show_regions_with_elements();

    $this->assertCount(3, $region_with_elements);
    $this->assertEquals($region_1->name, key($region_with_elements[0]));
    $this->assertEquals($region_2->name, key($region_with_elements[1]));
    $this->assertEquals($region_3->name, key($region_with_elements[2]));

    $this->assertCount(2, $region_with_elements[2][key($region_with_elements[2])]);
  }
}
