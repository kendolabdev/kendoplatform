<?php

include '../init.php';

$faker = \Faker\Factory::create();

$users = \App::userService()
    ->loadUserPaging([]);

foreach ($users->items() as $user) {
    \App::blogService()
        ->addPost($user, $user, [
            'title'       => $faker->sentence,
            'description' => $faker->paragraph(3, true),
            'content'     => $faker->paragraph(10, true),
        ]);

}