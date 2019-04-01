<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Element;
use App\Models\Region;

class DeleteElementTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function delete_element()
  {
    $element = factory(Element::class)->create([
      "name" => "Humero"
    ]);

    $this->assertDatabaseHas('elements', [
      'name' => "Humero"
    ]);

    Element::delete_element($element->id);
    $this->assertDatabaseMissing('elements', [
      'name' => "Humero"
    ]);
  }

  /** @test **/
  public function delete_element_with_region_attach()
  {
    $element = factory(Element::class)->create([
      "name" => "Humero"
    ]);

    $region = factory(Region::class)->create();

    $region->elements()->attach($element);

    $this->assertDatabaseHas('elements', [
      'name' => "Humero"
    ]);

    Element::delete_element($element->id);
    $this->assertDatabaseMissing('elements', [
      'name' => "Humero"
    ]);
  }
}
