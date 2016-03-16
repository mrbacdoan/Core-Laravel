<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!File::exists(public_path('uploads/faker/posts'))) {
            File::makeDirectory(public_path('uploads/faker/posts'), 777, true);
        }
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence();
            $data = [
                'title'       => $title,
                'thumbnail'   => 'uploads/faker/posts/' . $faker->image(public_path('uploads/faker/posts'), 300, 169, null, false),
                'description' => theExcerpt($faker->paragraph, 255),
                'content'     => $faker->text(2000),
                'heritage_id' => rand(1, 20),
                'user_id'     => rand(1, 10),
                'lang'        => 'en',
                'priority'    => rand(1, 100),
                'status'      => STATUS_ACTIVATED
            ];
            \App\IZee\Posts\Post::create($data);
        }
    }
}
