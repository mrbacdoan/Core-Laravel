<?php

use Illuminate\Database\Seeder;

class HeritageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!File::exists(public_path('uploads/faker/heritage'))) {
            File::makeDirectory(public_path('uploads/faker/heritage'), 777, true);
        }
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 16; $i++) {
            $data = [
                'title' =>  $faker->sentence(),
                'description' => theExcerpt($faker->paragraph, 255),
                'content' => $faker->text(2000),
                'thumbnail' => 'uploads/faker/heritage/' . $faker->image(public_path('uploads/faker/heritage'), 420, 236, null, false),
                'cover' => 'uploads/faker/heritage/' . $faker->image(public_path('uploads/faker/heritage'), 1170, 150, null, false),
                'province_id' => rand(1, 63),
                'area_id' => rand(63, 70),
                'user_id' => rand(1, 10),
                'lang' => 'en',
                'parent_id' => 0,
                'status' => STATUS_ACTIVATED
            ];
            \App\IZee\Heritages\Heritage::create($data);
        }
    }
}
