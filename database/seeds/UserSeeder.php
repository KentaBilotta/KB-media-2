<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'DANNY LAZZARIN',
                'email' => 'danny@gmail.com',
                'password' => Hash::make('password'),
                'logo' => 'uploads/images/danny_logo.jpg',
                'cover_img' => 'uploads/images/danny_cover.jpg',
                'slug' => Str::slug('DANNY LAZZARIN', '-'),
            ],
            [
                'name' => 'The Comments Section with Brett Cooper',
                'email' => 'brett@gmail.com',
                'password' => Hash::make('password'),
                'logo' => 'uploads/images/brett_logo.jpg',
                'cover_img' => 'uploads/images/brett_cover.jpg',
                'slug' => Str::slug('The Comments Section with Brett Cooper', '-'),
            ],
            [
                'name' => 'Courtney Ryan',
                'email' => 'courtney@gmail.com',
                'password' => Hash::make('password'),
                'logo' => 'uploads/images/courtney_logo.jpg',
                'cover_img' => 'uploads/images/courtney_cover.jpg',
                'slug' => Str::slug('Courtney Ryan', '-'),
            ],
            [
                'name' => 'Mark The Hammer / Marco Arata',
                'email' => 'mark@gmail.com',
                'password' => Hash::make('password'),
                'logo' => 'uploads/images/mark_logo.jpg',
                'cover_img' => 'uploads/images/mark_cover.jpg',
                'slug' => Str::slug('Mark The Hammer', '-'),
            ],
            [
                'name' => 'Kenta',
                'email' => 'kenta@gmail.com',
                'password' => Hash::make('password'),
                // 'logo' => 'https://www.creativefabrica.com/wp-content/uploads/2021/09/26/KB-initial-Business-logo-design-Graphics-17870046-1-580x387.jpg',
                // 'cover_img' => 'https://m.media-amazon.com/images/W/IMAGERENDERING_521856-T1/images/I/51JHiz19XrL._AC_SY450_.jpg',
                'slug' => Str::slug('Kenta', '-'),
            ],
            [
                'name' => 'Nalopia',
                'email' => 'nalopia@gmail.com',
                'password' => Hash::make('password'),
                'logo' => 'uploads/images/nalopia_logo.jpg',
                'cover_img' => 'uploads/images/nalopia_cover.jpg',
                'slug' => Str::slug('Nalopia', '-'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
