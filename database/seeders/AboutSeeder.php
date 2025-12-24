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
                'mission' => 'Being a local charitable organization, Cox’s Bazar Baitush
                Sharaf Hospital participates in social work with local,
                national, and international organizations.',
                'vission' => 'A society, that ensure sustain system of health, education, safe
                water and sanitation to all. People (normal & disable)
                participate in the society with equal right, scope and
                opportunity avoiding all adverse.',
                'description' => 'Cox’s Bazar Baitush Sharaf Hospital is situated in the premises of Cox’s Bazar Baitush Sharaf Complex as a part of it. Cox’s Bazar Baitush Sharaf Complex is a unit of Baitush Sharaf Anjuman –E- Ittehad Bangladesh, a renowned national humanitarian organization working voluntarily for mankind in religious ideology and values. The Cox’s Bazar Baitush Sharaf Hospital (CBBSH) is large humanitarian organization of the southern part of Bangladesh. It has been rendering charitable activities Eye hospital and Rehabilitation of blind on voluntary basis for under privilege, under served, poor and distressed people of remote hilly and coastal areas with excellent reputation and goodwill. At the beginning, the hospital started its activities as an independent eye hospital to serve the child, the father of future. As eye is a complicated organ and its treatment is quite expensive, so there had not been any eye care centre in Cox’s Bazar as well as around Cox’s Bazar. On the other hand, people of this region are too poor to bear the cost of eye treatment going in the big city of capital. As a result, a large number of people including children were being blind for the lack of eye treatment. Realizing the root causes of blindness of large people, Cox’s Bazar Baitush Sharaf Hospital started comprehensive eye care service from 1995 to save the sight of mass people.In the year 1997, the CBBSH had started Modular Eye Care (MEC) service with the technical and financial support of Royal Commonwealth Society for the Blind (RCSB) – Sightsavers Int. Bangladesh in order to give back the light to the blind people. Then Community Based Rehabilitation (CBR) is added with modular eye care service in 2000. In 2005, Modular Eye Care (MEC) service is converted into Comprehensive Eye Care Service (CES) aiming to satisfy the goal of Vision – 2020. In the year 2006, Low Vision (LV) clinic is included to comprehensive Eye Care Service (CES) to make the project more comprehensive.',
                'video_link' => '#',
                'image' => 'upload/about/about.jpg',
                'image1' => '#',
                'status' => '1',
                'created_at' => now()
            ],
        );
    }
}
