<?php

use App\Like;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $likes = [
            [
                'user_id' => 6,
                'video_id' => 1,
            ],
            [
                'user_id' => 6,
                'video_id' => 4,
            ],
            [
                'user_id' => 6,
                'video_id' => 15,
            ],
            [
                'user_id' => 5,
                'video_id' => 1,
            ],
            [
                'user_id' => 5,
                'video_id' => 3,
            ],
            [
                'user_id' => 5,
                'video_id' => 11,
            ],
        ];

        foreach ($likes as $like) {
            Like::create($like);
        }
    }
}
