<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductTypeModel;
use Faker\Generator as Faker;

$factory->define(ProductTypeModel::class, function (Faker $faker) {
    return [
        'type_name' => $faker->name()
    ];
});
