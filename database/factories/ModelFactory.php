<?php

$images = File::allFiles(public_path('uploads/faker'));
$factory->define(App\IZee\Products\Product::class, function (Faker\Generator $faker) use ($images) {
    $original_price = rand(100, 10000) * 1000;
    $discount = rand(20, 90);
    $sale_price = $original_price * $discount / 100;
    return [
        'enterprise_id' => rand(1, 51),
        'title' => $faker->sentence(),
        'creator_id' => rand(1, 10),
        'amount_product' => rand(1, 15),
        'lucky_quantity' => 0,
        'position' => rand(1, 100),
        'original_price' => $original_price,
        'sale_price' => $sale_price,
        'discount' => $discount,
        'thumbnail' => $images[rand(0, (count($images) - 1))],
        'description' => $faker->text,
        'status' => PRODUCT_STATUS_ACTIVATED,
        'public_at' => $faker->dateTimeThisMonth(),
        'end_at' => '2015-12-05 00:00:00',
    ];
});

$newsImages = File::allFiles(public_path('uploads/faker/news'));
$factory->define(App\IZee\News\News::class, function (Faker\Generator $faker) use ($images) {
    return [
        'title' => $faker->sentence(),
        'description' => theExcerpt($faker->paragraph, 255),
        'thumbnail' => 'uploads/faker/' . $faker->image('public/uploads/faker/news', 640, 640, null, false),
        'content' => $faker->paragraph,
        'creator_id' => rand(1, 10),
        'public_at' => $faker->dateTimeThisMonth(),
        'status' => STATUS_ACTIVATED
    ];
});

$factory->define(App\IZee\Questions\Question::class, function (Faker\Generator $faker) {
    $answers = [
        [
            'id' => uniqid(),
            'name' => "PHP"
        ],
        [
            'id' => uniqid(),
            'name' => "NodeJS"
        ],
        [
            'id' => uniqid(),
            'name' => "Java"
        ],
        [
            'id' => uniqid(),
            'name' => "Python"
        ],
    ];
    return [
        'title' => theExcerpt($faker->paragraph, 255),
        'answers' => json_encode($answers),
        'correct' => $answers[array_rand($answers)]['id'],
        'status' => STATUS_ACTIVATED
    ];
});
