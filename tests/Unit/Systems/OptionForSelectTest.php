<?php

namespace Tests\Unit\Systems;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;

class OptionForSelectTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function options_for_select()
  {
    factory(System::class)->create([
      "name" => "Cabeza"
    ]);
    factory(System::class)->create([
      "name" => "Cara"
    ]);
    factory(System::class)->create([
      "name" => "Craneo"
    ]);

    $system = System::options_for_select();
    $this->assertCount(3, $system);
  }
}
