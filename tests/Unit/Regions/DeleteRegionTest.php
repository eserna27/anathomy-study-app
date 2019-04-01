<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;
use App\Models\Element;

class DeleteRegionTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function delete_regions()
  {
    $region = factory(Region::class)->create([
      "name" => "Cabeza"
    ]);

    $this->assertDatabaseHas('regions', [
      'name' => "Cabeza"
    ]);

    Region::delete_region($region->id);
    $this->assertDatabaseMissing('regions', [
      'name' => "Cabeza"
    ]);
  }

  /** @test **/
  public function delete_region_root_with_childs()
  {
    $region = factory(Region::class)->create([
      "name" => "Cabeza"
    ]);

    factory(Region::class)->create([
      "name" => "Cara",
      "parent_id" => $region->id
    ]);

    $this->assertDatabaseHas('regions', [
      'name' => "Cabeza"
    ]);

    $this->assertDatabaseHas('regions', [
      'name' => "Cara"
    ]);

    Region::delete_region($region->id);

    $this->assertDatabaseMissing('regions', [
      'name' => "Cabeza"
    ]);

    $this->assertDatabaseMissing('regions', [
      'name' => "Cara"
    ]);
  }

  /** @test **/
  public function delete_region_with_element_attach()
  {
    $element = factory(Element::class)->create([
      "name" => "Humero"
    ]);
    $region = factory(Region::class)->create([
      "name" => "Cabeza"
    ]);
    $region->elements()->attach($element);

    Region::delete_region($region->id);

    $this->assertDatabaseMissing('regions', [
      'name' => "Cabeza"
    ]);
  }
}
