<?php

use App\Dislike;
use Illuminate\Database\Seeder;

class DislikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dislikes = [
            [
                'user_id' => 6,
                'video_id' => 2,
            ],
            [
                'user_id' => 6,
                'video_id' => 5,
            ],
        ];

        foreach ($dislikes as $dislike) {
            Dislike::create($dislike);
        }
    }
}
