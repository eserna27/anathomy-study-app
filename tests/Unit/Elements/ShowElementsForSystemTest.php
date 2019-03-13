<?php

namespace Tests\Unit\Elements;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;
use App\Models\Element;

class ShowElementsForSystemTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function show_elements_in_system()
  {
    $system = factory(System::class)->create([
      'id' => 1,
      'name' => "Sistema Esqueletico"
    ]);
    factory(Element::class)->create([
      'name' => "Clavícula",
      'kind' => "bone",
      'system_id' => $system->id
    ]);

    $elements = $system->elements()->get();
    $this->assertCount(1, $elements);
  }
}
