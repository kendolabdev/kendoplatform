<?php

include '../init.php';

$faker = \Faker\Factory::create();

$users = app()->user()
    ->loadUserPaging([]);

foreach ($users->items() as $user) {
    app()->blogService()
        ->addPost($user, $user, [
            'title'       => $faker->sentence,
            'description' => $faker->paragraph(3, true),
            'content'     => $faker->paragraph(10, true),
        ]);

}