<?php

use Illuminate\Database\Seeder;

class PhotoAlbumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!File::exists(public_path('uploads/faker/photo-albums'))) {
            File::makeDirectory(public_path('uploads/faker/photo-albums'), 777, true);
        }
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 25; $i++) {
            $title = $faker->sentence();
            $img = array();
            for ($j = 0; $j <= 4; $j++) {
                $img[] = [
                    'image'       => 'uploads/faker/photo-albums/' . $faker->image(public_path('uploads/faker/photo-albums'), 850, 478, null, false),
                    'description' => $faker->paragraph,
                ];
            }
            $file = json_encode($img);
            $data = [
                'title'       => $title,
                'thumbnail'   => 'uploads/faker/photo-albums/' . $faker->image(public_path('uploads/faker/photo-albums'), 420, 236, null, false),
                'content'     => $faker->text(1000),
                'files'       => $file,
                'heritage_id' => rand(1, 3),
                'user_id'     => rand(1, 2),
                'lang'        => 'en',
                'status'      => STATUS_ACTIVATED,
            ];
            \App\IZee\PhotoAlbums\PhotoAlbum::create($data);
        }
    }
}

