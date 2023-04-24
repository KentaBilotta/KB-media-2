<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(PostcommentSeeder::class);
        $this->call(PlaylistSeeder::class);
        $this->call(PlaylistVideoSeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(DislikeSeeder::class);
    }
}
