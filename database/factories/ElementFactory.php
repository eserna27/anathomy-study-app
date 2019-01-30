<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Element::class, function (Faker $faker) {
    $region = factory(App\Models\Region::class)->create();
    $system = factory(App\Models\System::class)->create();
    return [
      'name' => $faker->name(2, false),
      'kind' => $faker->name(1, false),
      'region_id' => $region->id,
      'system_id' => $system->id
    ];
});
