<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name'  => 'site_name',
                'value' => ' BIKER CLUB',
            ],
            [
                'name'  => 'site_logo',
                'value' => 'upload/setting/logo/logo.jpg',
            ],
            [
                'name'  => 'site_favicon',
                'value' => 'upload/setting/favicon/logo.jpg',
            ],
            [
                'name'  => 'site_footer_logo',
                'value' => 'upload/setting/logo/logo.jpg',
            ],
            [
                'name'  => 'site_contact_logo',
                'value' => 'upload/setting/contact/logo.png',
            ],
            [
                'name'  => 'site_company_logo',
                'value' => 'upload/setting/company/banner.png',
            ],
            [
                'name'  => 'phone',
                'value' => '013',
            ],
            [
                'name'  => 'phone2',
                'value' => '013',
            ],
            [
                'name'  => 'email',
                'value' => 'test@gmail.com',
            ],
            [
                'name'  => 'email2',
                'value' => 'test1@gmail.com',
            ],
            [
                'name'  => 'business_name',
                'value' => 'BIKER CLUB',
            ],
            [
                'name'  => 'business_address',
                'value' => 'BIKER CLUB Dhaka',
            ],
            [
                'name'  => 'business_hours',
                'value' => '9:00 AM - 4:30 PM',
            ],
            [
                'name'  => 'copy_right',
                'value' => 'BIKER CLUB',
            ],
            [
                'name'  => 'developed_by',
                'value' => 'Speakup BD',
            ],
            [
                'name'  => 'developer_link',
                'value' => 'https://snazrul.speakupbd.com/',
            ],
            [
                'name'  => 'breaking_news',
                'value' => 'BIKER CLUB',
            ],
            [
                'name'  => 'about',
                'value' => 'BIKER CLUB',
            ],
            [
                'name' => 'facebook_url',
                'value' => 'https://www.facebook.com/',
            ],
            [
                'name'  => 'messenger_url',
                'value' => 'https://www.messenger.com/',
            ],
            [
                'name'  => 'twitter_url',
                'value' => 'https://www.twitter.com/',
            ],
            [
                'name'  => 'linkedin_url',
                'value' => 'https://www.linkedin.com/',
            ],
            [
                'name' => 'youtube_url',
                'value' => 'https://www.youtube.com/',
            ],
            [
                'name'  => 'instagram_url',
                'value' => 'https://www.instagram.com/',
            ],
            [
                'name'  => 'pinterest_url',
                'value' => 'https://www.pinterest.com/',
            ],
            [
                'name'  => 'whatsapp_url',
                'value' => 'https://www.whatsapp.com/',
            ],
            [
                'name'  => 'meta_title',
                'value' => 'BIKER CLUB',
            ],
            [
                'name'  => 'meta_keyword',
                'value' => 'BIKER CLUB',
            ],
            [
                'name'  => 'meta_description',
                'value' => 'BIKER CLUB',
            ],
            [
                'name'  => 'top_banner',
                'value' => '',
            ],
            [
                'name'  => 'top_banner1',
                'value' => '',
            ],
            [
                'name'  => 'middle_banner',
                'value' => '',
            ],
            [
                'name'  => 'middle_banner1',
                'value' => '',
            ],
            // ... add entries for other types
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['name' => $setting['name']], $setting);
        }
    }
}
