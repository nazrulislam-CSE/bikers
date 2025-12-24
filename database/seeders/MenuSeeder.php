<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
         $menus = [
            [
                'name'              => 'Header Menu',
                'slug'              => 'header-menu',
                'type'              => 'megaMenu',
                'menu_source'       => 'category',
                'location'          => 'main_header',
                'status'            => 1,
                'created_at'        => new \DateTime ?: new \DateTime
            ],
            [
                'name'              => 'Footer Menu',
                'slug'              => 'footer-menu',
                'type'              => 'megaMenu',
                'menu_source'       => 'category',
                 'location'         => 'footer1',
                'status'            => 1,
                'created_at'        => new \DateTime ?: new \DateTime
            ],
            [
                'name'              => 'Footer Bottom Menu',
                'slug'              => 'footer-bottom-menu',
                'type'              => 'megaMenu',
                'menu_source'       => 'category',
                'location'          => 'footer2',
                'status'            => 1,
                'created_at'        => new \DateTime ?: new \DateTime
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['slug' => $menu['slug']], // Match by unique slug
                array_merge($menu, [
                    'updated_at' => Carbon::now(),
                ])
            );
        }
    }
}
