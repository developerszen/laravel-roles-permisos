<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement([1, 2]),
        'title' => $faker->sentence(),
        'content' => $faker->text(1000),
        'published' => $faker->randomElement([true, false]),
    ];
});
