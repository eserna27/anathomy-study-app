<?php

use Illuminate\Database\Seeder;
use App\Models\System;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      System::store_system(['name' => "Sistema Esqueletico"]);
      System::store_system(['name' => "Sistema muscular"]);
      System::store_system(['name' => "Sistema nervioso"]);
      System::store_system(['name' => "Sistema endocrino"]);
    }
}
