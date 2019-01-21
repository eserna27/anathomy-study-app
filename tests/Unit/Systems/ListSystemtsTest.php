<?php

namespace Tests\Unit\Systems;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;

class ListSystemts extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_list_all_systems()
    {
      factory(System::class, 5)->create();

      $systems = System::list_systems();
      $this->assertCount(5, $systems);
    }

    /** @test **/
    public function describe_systems_item()
    {
      factory(System::class)->create([
        'id' => 1,
        'name' => "Sistema circulatorio"
      ]);

      $system_first = System::list_systems()->first();
      $this->assertEquals("Sistema circulatorio", $system_first->name);
      $this->assertEquals(1, $system_first->id);
    }
}
