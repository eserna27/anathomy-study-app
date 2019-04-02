<?php

namespace Tests\Unit\Definitions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Definition;
use App\Models\Element;
use App\Models\System;

class UpdateDefinitionTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function update_definition_for_element_with_bad_param()
  {
    $definition_id = 1000;
    $system = factory(System::class)->create([
      'name' => "Sistema Esqueletico"
    ]);
    $clavicula = factory(Element::class)->create([
      'name' => "Clavícula",
      'kind' => "bone",
      'system_id' => $system->id
    ]);

    Definition::store_definition([
      'id' => $definition_id,
      'element_id' => $clavicula->id,
      'definition' => "Única unión ósea entre el tronco y la extremidad superior."
    ]);

    $definition_data = [
      'element_id' => $clavicula->id,
      'definition' => "",
    ];

    $response_errors = Definition::update_definition($definition_id, $definition_data)['validator']->errors()->messages();

    $definition_error = $response_errors['definition'][0];

    $this->assertEquals("Es obligarorio", $definition_error);
  }

  /** @test **/
  public function store_definition_for_element_with_good_param()
  {
    $element = factory(Element::class)->create();
    $definition_data = [
      'element_id' => $element->id,
      'definition' => "La definición de un elemento",
    ];

    Definition::store_definition($definition_data);

    $this->assertDatabaseHas('definitions', [
      'element_id' => $element->id,
      'definition' => "La definición de un elemento"
    ]);
  }
}
