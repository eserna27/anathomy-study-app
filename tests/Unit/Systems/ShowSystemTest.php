<?php

namespace Tests\Unit\Systems;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;

class ShowSystemTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function find_system()
    {
      $id = rand();
      factory(System::class)->create([
        'id' => $id,
        'name' => "Sistema circulatorio"
      ],
      [
        'id' => $id+1,
        'name' => "Sistema muscular"
      ]);

      $system = System::find_system($id);
      $this->assertEquals($id, $system->id);
      $this->assertEquals("Sistema circulatorio", $system->name);
    }
}
