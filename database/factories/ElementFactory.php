<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Element::class, function (Faker $faker) {
    $system = factory(App\Models\System::class)->create();
    return [
      'name' => $faker->name(2, false),
      'kind' => $faker->name(1, false),
      'system_id' => $system->id
    ];
});
