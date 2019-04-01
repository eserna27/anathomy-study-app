<?php

namespace Tests\Unit\Systems;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;
use App\Models\Region;
use App\Models\Element;

class ShowRegionsInSystmesTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_regions()
  {
    $system = factory(System::class)->create();
    $region_1 = factory(Region::class)->create([
      'id' => 1,
      'name' => "Extremidad Superior"
    ]);
    $region_2 = factory(Region::class)->create([
      'id' => 2,
      'name' => "Hombro"
    ]);
    $region_3 = factory(Region::class)->create([
      'id' => 3,
      'name' => "Brazo"
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

    $region_1->elements()->attach($element);
    $region_2->elements()->attach($element);
    $region_3->elements()->attach($element_1);

    $this->assertCount(3, $system->show_regions());
    $this->assertEquals($region_1->name, $system->show_regions()[0]->name);
    $this->assertEquals($region_2->name, $system->show_regions()[1]->name);
    $this->assertEquals($region_3->name, $system->show_regions()[2]->name);
  }

  /** @test **/
  public function show_regions_with_same_region_only_parents()
  {
    $system = factory(System::class)->create();
    $region_1 = factory(Region::class)->create([
      'id' => 1,
      'name' => "Extremidad Superior"
    ]);
    $region_2 = factory(Region::class)->create([
      'id' => 2,
      'name' => "Hombro",
      "parent_id" => $region_1->id
    ]);
    $region_3 = factory(Region::class)->create([
      'id' => 3,
      'name' => "Cabeza"
    ]);
    $element = factory(Element::class)->create([
      'name' => "Clavícula",
      'kind' => "bone",
      'system_id' => $system->id
    ]);

    $element_2 = factory(Element::class)->create([
      'name' => "Humero",
      'kind' => "bone",
      'system_id' => $system->id
    ]);

    $region_1->elements()->attach($element);
    $region_2->elements()->attach($element);
    $region_3->elements()->attach($element_2);

    $this->assertCount(2, $system->show_regions());
    $this->assertEquals($region_1->name, $system->show_regions()[0]->name);
    $this->assertEquals($region_3->name, $system->show_regions()[1]->name);
  }
}
