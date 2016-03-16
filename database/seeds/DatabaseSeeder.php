<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UsersTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(HeritageTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PhotoAlbumTableSeeder::class);
        $this->call(VideoTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        Model::reguard();
    }
}
