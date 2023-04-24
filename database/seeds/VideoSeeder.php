<?php

use App\Video;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $videos = config('videos');

        foreach ($videos as $video) {
            Video::create($video);
        }

        // for($i = 0; $i < 8; $i++) {
        //     $video = Video::create([
        //         'user_id' => rand(1, 4),
        //         'title' => $faker->sentence(),
        //         'description' => $faker->paragraph(),
        //         'thumbnail' => 'uploads/images/' . implode($faker->randomElements(
        //             ['masterchef-italia.png', 'hardcore-paws.png', 'jimmy-fallon-show.png', 'Man-vs-Food.png', '1000_modi_per_morire.png']
        //         )),

        //         'video_path' => 'uploads/videos/' . implode($faker->randomElements(
        //             ['deluca.mp4', 'comparazione.mp4', 'PAZIENTE ZERO - Hyst .mp4']
        //         )),
        //     ]);
        // }
    }
}
