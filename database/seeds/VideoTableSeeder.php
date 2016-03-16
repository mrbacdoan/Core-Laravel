<?php

use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!File::exists(public_path('uploads/faker/video'))) {
            File::makeDirectory(public_path('uploads/faker/video'), 777, true);
        }
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence();
            $data = [
                'title'       => $title,
                'thumbnail'   => 'uploads/faker/video/' . $faker->image(public_path('uploads/faker/video'), 420, 236, null, false),
                'content'     => $faker->paragraph,
                'url'         => 'https://www.youtube.com/watch?v=Ecs2bmNQcgg',
                'heritage_id' => rand(1, 3),
                'user_id'     => rand(1, 2),
                'lang'        => 'en',
                'priority'    => rand(1, 100),
                'status'      => STATUS_ACTIVATED
            ];
            \App\IZee\Videos\Video::create($data);
        }
    }
}
