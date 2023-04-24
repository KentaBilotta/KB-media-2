<?php

use App\Playlist;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $playlists = [
            [
                'user_id' => 1,
                'name' => "Guarda più tardi",
            ],
            [
                'user_id' => 2,
                'name' => "Watch later",
            ],
            [
                'user_id' => 3,
                'name' => "Watch later",
            ],
            [
                'user_id' => 4,
                'name' => "Guarda più tardi",
            ],
            [
                'user_id' => 5,
                'name' => "Guarda più tardi",
            ],
            [
                'user_id' => 6,
                'name' => "Watch later",
            ],
            [
                'user_id' => 5,
                'name' => "Playlist personale",
            ],
        ];

        foreach($playlists as $playlist) {
            Playlist::create($playlist);
        }
    }
}
