<?php

use Faker\Generator as Faker;

$factory->define(App\Models\System::class, function (Faker $faker) {
  return [
    'name' => $faker->name(2, false)
  ];
});
