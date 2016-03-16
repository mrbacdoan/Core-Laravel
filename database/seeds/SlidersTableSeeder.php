<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!File::exists(public_path('uploads/faker/sliders'))) {
            File::makeDirectory(public_path('uploads/faker/sliders'), 777, true);
        }
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $title = $faker->text(18);
            $data = [
                'title'       => $title,
                'slug'        => str_slug($title),
                'description' => $faker->text(50),
                'link'        => '',
                'thumbnail'   => 'uploads/faker/sliders/' . $faker->image(public_path('uploads/faker/sliders'), 1600, 600, null, false),
                'user_id'     => rand(1, 10),
                'priority'     => rand(1, 100),
                'lang'        => 'en',
                'status'      => STATUS_ACTIVATED
            ];
            \App\IZee\Sliders\Slider::create($data);
        }
    }
}
