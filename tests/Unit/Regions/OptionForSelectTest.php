<?php

namespace Tests\Unit\Regions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Region;

class OptionForSelectTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function options_for_select()
  {
    $root = factory(Region::class)->create([
      "name" => "Cabeza"
    ]);
    factory(Region::class)->create([
      "name" => "Cara",
      "parent_id" => $root->id
    ]);
    factory(Region::class)->create([
      "name" => "Craneo",
      "parent_id" => $root->id
    ]);

    $regions = Region::options_for_select();
    $this->assertEquals(
      [
        22 => "Cabeza",
        23 => "Cabeza - Cara",
        24 => "Cabeza - Craneo"
      ], $regions);
  }
}
