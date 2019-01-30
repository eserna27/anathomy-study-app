<?php

namespace Tests\Unit\Definitions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\System;
use App\Models\Element;
use App\Models\Definition;

class showDefinitionsFromElement extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_definitions()
  {
    $this->before();

    $clavicula = Element::where(['name' => 'Clavícula'])->get()->first();

    $definitions = $clavicula->definitions;
    $this->assertCount(2, $definitions);
  }

  private function before()
  {
    $region = factory(Region::class)->create([
      'id' => 1,
      'name' => "Extremidad Superior"
    ]);
    $system = factory(System::class)->create([
      'id' => 1,
      'name' => "Sistema Esqueletico"
    ]);
    $clavicula = factory(Element::class)->create([
      'name' => "Clavícula",
      'kind' => "bone",
      'region_id' => $region->id,
      'system_id' => $system->id
    ]);

    Definition::store_definition([
      'element_id' => $clavicula->id,
      'definition' => "Única unión ósea entre el tronco y la extremidad superior."
    ]);
    Definition::store_definition([
      'element_id' => $clavicula->id,
      'definition' => "La porción medial es convexa hacia delante, mientras que  la porción lateral es cóncava."
    ]);
  }
}
