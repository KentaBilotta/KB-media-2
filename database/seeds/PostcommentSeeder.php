<?php

use App\Postcomment;
use Illuminate\Database\Seeder;

class PostcommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postcomments = [
            [
                'user_id' => 5,
                'post_id' => 1,
                'description' => "Vai Danny, GENTLEMEN FOREVER!",
            ],
            [
                'user_id' => 5,
                'post_id' => 9,
                'description' => "Get in there Courtney, you DESERVE IT",
            ],
            [
                'user_id' => 5,
                'post_id' => 7,
                'description' => "Brett 2 milion TOP G!",
            ],
            [
                'user_id' => 4,
                'post_id' => 1,
                'description' => "Adesso faccio la sigla dei gentelment senza talento",
            ],
            [
                'user_id' => 2,
                'post_id' => 9,
                'description' => "Let's go girls, keep saving our men!!!",
            ],
            [
                'user_id' => 5,
                'post_id' => 12,
                'description' => "Pazzo fra, anche io voglio volare pero",
            ],
        ];

        foreach ($postcomments as $postcomment) {
            Postcomment::create($postcomment);
        }
    }
}
