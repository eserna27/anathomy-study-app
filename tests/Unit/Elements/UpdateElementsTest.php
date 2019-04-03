<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Element;
use App\Models\Region;
use App\Models\System;

class UpdateElementsTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function update_element_with_bad_params()
  {
    $element = factory(Element::class)->create([
      "name" => "Humero"
    ]);

    $element_data = [
      'name' => "",
      'system_id' => "",
      'region_id' => "",
      'kind' => ""
    ];

    $store_response = Element::update_element($element->id, $element_data);

    $response_errors = $store_response['validator']->errors()->messages();

    $name_error = $response_errors['name'][0];
    $kind_error = $response_errors['kind'][0];

    $this->assertEquals("Es obligarorio", $name_error);
    $this->assertEquals("Es obligarorio", $kind_error);
    $this->assertEquals(false, $store_response['updated']);
  }

  /** @test **/
  public function update_element_with_good_params()
  {
    $element = factory(Element::class)->create([
      "name" => "Humero"
    ]);

    $element_data = [
      'name' => "Cabeza",
      'kind' => 'bone',
    ];

    $store_response = Element::update_element($element->id, $element_data);

    $this->assertDatabaseHas('elements', [
      'name' => "Cabeza",
      'kind' => 'bone'
    ]);

    $this->assertEquals(true, $store_response['updated']);
  }
}
