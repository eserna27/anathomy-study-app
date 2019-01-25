<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Element::class, function (Faker $faker) {
    return [
      'name' => $faker->name(2, false),
      'kind' => $faker->name(1, false),
    ];
});
