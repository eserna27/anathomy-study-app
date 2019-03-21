<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Admin::create(array(
        'email'    => 'eserna27@gmail.com',
        'password' => Hash::make('1234secret'),
    ));
    }
}
