<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Element;
use App\Models\Region;
use App\Models\System;

class StoreElement extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function store_element_with_bad_params()
  {
    $element_data = [
      'name' => "",
      'region_id' => "",
      'system_id' => "",
      'kind' => ""
    ];

    $response_errors = Element::store_element($element_data)->errors()->messages();

    $name_error = $response_errors['name'][0];
    $region_error = $response_errors['region_id'][0];
    $system_error = $response_errors['system_id'][0];
    $kind_error = $response_errors['kind'][0];

    $this->assertEquals("Es obligarorio", $name_error);
    $this->assertEquals("Es obligarorio", $region_error);
    $this->assertEquals("Es obligarorio", $system_error);
    $this->assertEquals("Es obligarorio", $kind_error);
  }

  /** @test **/
  public function store_element_with_goog_params()
  {
    $region = factory(Region::class)->create();
    $system = factory(System::class)->create();

    $element_data = [
      'name' => "Humero",
      'kind' => 'bone',
      'region_id' => $region->id,
      'system_id' => $system->id,
    ];

    Element::store_element($element_data);

    $this->assertDatabaseHas('elements', [
      'name' => "Humero",
      'kind' => 'bone',
      'region_id' => $region->id,
      'system_id' => $system->id,
    ]);
  }
}
