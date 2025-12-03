<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'question' => 'Jam berapa Soto Vokasi buka?',
                'answer' => 'Soto Vokasi buka setiap hari dari pukul 08.00 - 21.00 WIB. Kami siap melayani Anda untuk sarapan, makan siang, hingga makan malam.',
                'order' => 1,
            ],
            [
                'question' => 'Apakah bisa melakukan reservasi tempat?',
                'answer' => 'Ya, tentu saja! Anda dapat melakukan reservasi tempat melalui WhatsApp kami di +62 877 8571 1752 atau melalui halaman Contact.',
                'order' => 2,
            ],
            [
                'question' => 'Apakah tersedia layanan pesan antar?',
                'answer' => 'Ya, kami menyediakan layanan pesan antar melalui aplikasi GoFood, GrabFood, dan ShopeeFood.',
                'order' => 3,
            ],
            [
                'question' => 'Apakah tersedia paket catering?',
                'answer' => 'Ya, kami menyediakan paket catering untuk berbagai acara seperti ulang tahun, pernikahan, dan acara perusahaan.',
                'order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}