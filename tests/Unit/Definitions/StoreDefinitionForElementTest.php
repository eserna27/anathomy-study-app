<?php

namespace Tests\Unit\Definitions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Definition;
use App\Models\Element;

class StoreDefinitionForElementTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function store_definition_for_element_with_bad_param()
  {
    $definition_data = [
      'element_id' => "",
      'definition' => "",
    ];

    $response_errors = Definition::store_definition($definition_data)['validator']->errors()->messages();

    $element_error = $response_errors['element_id'][0];
    $definition_error = $response_errors['definition'][0];

    $this->assertEquals("Es obligarorio", $element_error);
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
