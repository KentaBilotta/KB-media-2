<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            [
                'user_id' => 5,
                'video_id' => 3,
                'description' => "Ti amo Danny cuore cuore !!",
            ],
            [
                'user_id' => 5,
                'video_id' => 8,
                'description' => "Courtney, you're my secret crush ❤",
            ],
            [
                'user_id' => 5,
                'video_id' => 6,
                'description' => "Brett top G!!",
            ],
            [
                'user_id' => 5,
                'video_id' => 11,
                'description' => "Mark questo pezzo spacca",
            ],
            [
                'user_id' => 1,
                'video_id' => 12,
                'description' => "Ciao sono Danny, Mark sei troppo forte",
            ],
            [
                'user_id' => 2,
                'video_id' => 8,
                'description' => "Hey this is Brett, Courtney pls save the men!",
            ],
            [
                'user_id' => 1,
                'video_id' => 8,
                'description' => "I eat testosterone for breakfast",
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
