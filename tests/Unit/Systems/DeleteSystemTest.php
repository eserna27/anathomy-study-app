<?php

namespace Tests\Unit\Systems;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;

class DeleteSystemTest extends TestCase
{
  use RefreshDatabase;

  /** @test **/
  public function delete_system()
  {
    $system = factory(System::class)->create([
      'id' => 1,
      'name' => "Sistema circulatorio"
    ]);

    $this->assertDatabaseHas('systems', [
      'name' => "Sistema circulatorio"
    ]);

    System::delete_system($system->id);
    $this->assertDatabaseMissing('systems', [
      'name' => "Sistema circulatorio"
    ]);
  }
}
