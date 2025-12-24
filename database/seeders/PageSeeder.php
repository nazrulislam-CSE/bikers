<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'page_name'        => 'About Us',
                'page_title'       => 'About Us',
                'page_slug'        => 'about-us',
                'page_description' => 'This is About Us Page',
                'meta_title'       => 'about-us',
                'keywords'         => 'about, company, info',
                'meta_description' => 'This is About Us page',
                'status'           => 1,
                'is_default'       => 1,
                'created_by'       => 1,
                'position'         => 2,
                'created_at'       => now(),
            ],
            [
                'page_name'        => 'Testimonial',
                'page_title'       => 'Testimonial',
                'page_slug'        => 'testimonial',
                'page_description' => 'What our clients say.',
                'meta_title'       => 'testimonial',
                'keywords'         => 'testimonial,review',
                'meta_description' => 'Client testimonials',
                'status'           => 1,
                'is_default'       => 0,
                'created_by'       => 1,
                'position'         => 5,
                'created_at'       => now(),
            ],
         
            [
                'page_name'        => 'Services',
                'page_title'       => 'Services',
                'page_slug'        => 'services',
                'page_description' => 'Overview of our services.',
                'meta_title'       => 'services',
                'keywords'         => 'services,hospital,community',
                'meta_description' => 'List of all services',
                'status'           => 1,
                'is_default'       => 1,
                'created_by'       => 1,
                'position'         => 9,
                'created_at'       => now(),
            ],
            [
                'page_name'        => 'Contact Us',
                'page_title'       => 'Contact Us',
                'page_slug'        => 'contact-us',
                'page_description' => 'Get in touch with us.',
                'meta_title'       => 'contact-us',
                'keywords'         => 'contact,help,support',
                'meta_description' => 'Contact us page',
                'status'           => 1,
                'is_default'       => 1,
                'created_by'       => 1,
                'position'         => 20,
                'created_at'       => now(),
            ],
            [
                'page_name'              => 'Privecy Policy',
                'page_title'             => 'Privecy Policy',
                'page_slug'              => 'privecy-policy',
                'page_description'       => 'This is Privecy Policy Us Page',
                'meta_title'             => 'privecy-policy',
                'keywords'               => 'privecy,privecy,privecy',
                'meta_description'       => 'this is privecy page',
                'status'                 => 1,
                'is_default'             => 1,
                'created_by'             => 1,
                'position'               => 3,
                'created_at'             => new \DateTime ?: new \DateTime
            ],
            [
                'page_name'              => 'Terms & Conditions',
                'page_title'             => 'Terms & Conditions',
                'page_slug'              => 'terms-&-conditions',
                'page_description'       => 'This is Terms & Conditions Page',
                'meta_title'             => 'terms-&-conditions',
                'keywords'               => 'terms-&-conditions,terms-&-conditions,terms-&-conditions',
                'meta_description'       => 'this is terms-&-conditions page',
                'status'                 => 1,
                'is_default'             => 1,
                'created_by'             => 1,
                'position'               => 3,
                'created_at'             => new \DateTime ?: new \DateTime
            ],
            
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
