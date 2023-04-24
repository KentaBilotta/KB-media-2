<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PlaylistsVideos = [
            [
                'playlist_id' => 5,
                'video_id' => 1,
            ],
            [
                'playlist_id' => 1,
                'video_id' => 11,
            ],
            [
                'playlist_id' => 2,
                'video_id' => 7,
            ],
            [
                'playlist_id' => 3,
                'video_id' => 4,
            ],
            [
                'playlist_id' => 4,
                'video_id' => 3,
            ],
            [
                'playlist_id' => 6,
                'video_id' => 9,
            ],
            [
                'playlist_id' => 6,
                'video_id' => 15,
            ],
        ];

        foreach($PlaylistsVideos as $association) {
            DB::table('playlist_video')->insert($association);
        }
    }
}
