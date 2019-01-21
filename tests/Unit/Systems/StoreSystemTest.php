<?php

namespace Tests\Unit\Systems;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\System;

class CreateSystemTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function store_system_with_no_name()
    {
      $system_data = [
        'name' => ""
      ];

      $system_name_error = System::store_system($system_data)->errors()->messages()['name'][0];

      $this->assertEquals("Es obligarorio", $system_name_error);
      $this->assertDatabaseMissing('systems', [
        'name' => "Sistema circulatorio"
      ]);
    }

    /** @test **/
    public function store_system_with_same_name()
    {
      factory(System::class)->create([
        'name' => "Sistema circulatorio"
      ]);

      $system_data = [
        'name' => "Sistema circulatorio"
      ];

      $system_name_error = System::store_system($system_data)->errors()->messages()['name'][0];

      $this->assertEquals("No se puede repetir", $system_name_error);
    }
}
