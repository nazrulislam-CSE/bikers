<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create(
            [
                'title' => 'Test',
                'experience_no' => '10',
                'experience_title' => 'Years Of Experience',
                'mission' => '',
                'vission' => '',
                'description' => '',
                'video_link' => '#',
                'image' => 'upload/about/about.jpg',
                'image1' => '#',
                'status' => '1',
                'created_at' => now()
            ],
        );
    }
}
