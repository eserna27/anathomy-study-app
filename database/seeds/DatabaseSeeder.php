<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->truncateTables([
          'systems',
          'regions',
          'elements',
          'definitions',
          'element_regions',
          'admins'
        ]);
      $this->call(SystemSeeder::class);
      $this->call(RegionSeeder::class);
      $this->call(ShoulderBonesElementsSeeder::class);
      $this->call(ArmBonesElementSeeder::class);
      $this->call(AddDefinitionToShoulderBonesElements::class);
      $this->call(CreateAdminSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
      foreach ($tables as $table) {
        DB::table($table)->truncate();
      }
      DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
