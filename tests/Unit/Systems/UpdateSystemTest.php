<?php

namespace Tests\Unit\Systems;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;

class UpdateSystemTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function update_system_with_no_name()
  {
    $system = factory(System::class)->create([
      "name" => "Digestivo"
    ]);

    $system_data = [
      'name' => ""
    ];

    $system_name_error = System::update_system($system->id, $system_data)->errors()->messages()['name'][0];

    $this->assertEquals("Es obligarorio", $system_name_error);
  }

  /** @test **/
  public function update_system_with_same_name()
  {
    $system = factory(System::class)->create([
      "name" => "Digestivo"
    ]);

    $system_data = [
      'name' => "Digestivo"
    ];

    System::update_system($system->id, $system_data);
    $this->assertDatabaseHas('systems', [
      'name' => "Digestivo"
    ]);
  }
}
