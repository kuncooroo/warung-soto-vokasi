<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentHistory;
use App\Models\Product;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedUsers();
        $this->seedCategories();
        $this->seedProducts();
        $this->seedTestimonis();
        $this->seedContactMessages();
        $this->seedBanners();
        $this->seedGalleries();
        $this->seedOrders();
    }

    private function seedUsers(): void
    {
        User::updateOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo Customer',
                'password' => 'password',
                'phone' => '081234567892',
                'address' => 'Jl. Gajayana No. 50, Malang',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Budi Santoso',
                'password' => 'password',
                'phone' => '085712345678',
                'address' => 'Jl. Soekarno Hatta No. 12, Malang',
            ]
        );
    }

    private function seedCategories(): void
    {
        $categories = [
            ['name' => 'Soto', 'slug' => 'soto', 'description' => 'Aneka soto khas Nusantara dengan kuah hangat yang gurih'],
            ['name' => 'Minuman', 'slug' => 'minuman', 'description' => 'Minuman segar untuk menemani santap soto Anda'],
            ['name' => 'Pelengkap', 'slug' => 'pelengkap', 'description' => 'Nasi, lauk, dan camilan pendamping soto'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }

    private function seedProducts(): void
    {
        $products = [
            [
                'slug' => 'soto-ayam-lamongan', 'category' => 'soto',
                'name' => 'Soto Ayam Lamongan', 'price' => 18000, 'stock' => 80,
                'description' => 'Soto ayam khas Lamongan dengan kuah kuning segar, suwiran ayam, bihun, kol, dan koya yang gurih.',
                'ingredients' => 'Ayam suwir, bihun, kol, tauge, koya, bawang goreng, jeruk nipis, sambal',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'soto-ayam-kampung', 'category' => 'soto',
                'name' => 'Soto Ayam Kampung', 'price' => 22000, 'stock' => 45,
                'description' => 'Soto dengan ayam kampung pilihan yang lebih kenyal dan gurih, kuah kaldu bening kaya rasa.',
                'ingredients' => 'Ayam kampung, bihun, kol, tauge, bawang goreng, jeruk nipis, sambal',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'soto-daging-sapi', 'category' => 'soto',
                'name' => 'Soto Daging Sapi', 'price' => 25000, 'stock' => 50,
                'description' => 'Soto dengan irisan daging sapi empuk, kuah gurih, cocok untuk penggemar soto berdaging.',
                'ingredients' => 'Daging sapi, bihun, kol, tauge, kentang, tomat, bawang goreng',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'soto-betawi', 'category' => 'soto',
                'name' => 'Soto Betawi', 'price' => 26000, 'stock' => 40,
                'description' => 'Soto khas Betawi dengan kuah santan dan susu yang creamy, daging sapi, kentang, dan emping.',
                'ingredients' => 'Daging sapi, kuah santan, susu, kentang, tomat, emping, bawang goreng',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'soto-kombinasi', 'category' => 'soto',
                'name' => 'Soto Kombinasi (Ayam + Telur)', 'price' => 24000, 'stock' => 60,
                'description' => 'Perpaduan suwiran ayam dan telur rebus dalam satu mangkuk, lebih kenyang dan nikmat.',
                'ingredients' => 'Ayam suwir, telur rebus, bihun, kol, tauge, bawang goreng',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'soto-babat', 'category' => 'soto',
                'name' => 'Soto Babat', 'price' => 23000, 'stock' => 0,
                'description' => 'Soto dengan babat empuk yang sudah dibersihkan sempurna. Menu sedang kosong.',
                'ingredients' => 'Babat, bihun, kol, tauge, bawang goreng, jeruk nipis',
                'is_halal' => true, 'is_active' => false,
            ],
            [
                'slug' => 'nasi-putih', 'category' => 'pelengkap',
                'name' => 'Nasi Putih', 'price' => 5000, 'stock' => 200,
                'description' => 'Nasi putih pulen hangat sebagai pendamping soto.',
                'ingredients' => 'Beras, air',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'telur-rebus', 'category' => 'pelengkap',
                'name' => 'Telur Rebus', 'price' => 4000, 'stock' => 150,
                'description' => 'Telur rebus segar, pelengkap soto yang mengenyangkan.',
                'ingredients' => 'Telur ayam',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'perkedel-kentang', 'category' => 'pelengkap',
                'name' => 'Perkedel Kentang', 'price' => 7000, 'stock' => 120,
                'description' => 'Perkedel kentang gurih dengan taburan bawang goreng.',
                'ingredients' => 'Kentang, telur, bawang putih, bawang merah, seledri, garam',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'kerupuk-udang', 'category' => 'pelengkap',
                'name' => 'Kerupuk Udang', 'price' => 5000, 'stock' => 200,
                'description' => 'Kerupuk udang renyah sebagai pelengkap santap soto.',
                'ingredients' => 'Tepung tapioka, udang, bawang putih, garam',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'es-teh-manis', 'category' => 'minuman',
                'name' => 'Es Teh Manis', 'price' => 5000, 'stock' => 100,
                'description' => 'Es teh manis segar dengan gula asli.',
                'ingredients' => 'Teh, gula, es batu',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'es-jeruk-peras', 'category' => 'minuman',
                'name' => 'Es Jeruk Peras', 'price' => 8000, 'stock' => 100,
                'description' => 'Jeruk peras asli tanpa pengawet, manis asam menyegarkan.',
                'ingredients' => 'Jeruk peras, gula, es batu',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'jus-alpukat', 'category' => 'minuman',
                'name' => 'Jus Alpukat', 'price' => 12000, 'stock' => 60,
                'description' => 'Jus alpukat kental dengan susu cokelat, nikmat dan mengenyangkan.',
                'ingredients' => 'Alpukat, susu kental manis, cokelat, es batu',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'es-kopi-susu-gula-aren', 'category' => 'minuman',
                'name' => 'Es Kopi Susu Gula Aren', 'price' => 15000, 'stock' => 60,
                'description' => 'Kopi susu kekinian dengan gula aren asli, cocok setelah menyantap soto.',
                'ingredients' => 'Kopi, susu, gula aren, es batu',
                'is_halal' => true, 'is_active' => true,
            ],
            [
                'slug' => 'air-mineral', 'category' => 'minuman',
                'name' => 'Air Mineral', 'price' => 4000, 'stock' => 300,
                'description' => 'Air mineral kemasan 600ml.',
                'ingredients' => 'Air',
                'is_halal' => true, 'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            $product['category_id'] = Category::where('slug', $product['category'])->value('id');
            unset($product['category']);

            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }
    }

    private function seedTestimonis(): void
    {
        $testimonis = [
            [
                'name' => 'Aisyah Rahma', 'email' => 'aisyah@example.com', 'rating' => 5,
                'message' => 'Soto Ayam Lamongannya juara! Kuahnya segar dan koyanya bikin ketagihan. Harga juga bersahabat.',
                'is_approved' => true,
            ],
            [
                'name' => 'Rizky Pratama', 'email' => 'rizky@example.com', 'rating' => 4,
                'message' => 'Pesan lewat WhatsApp cepat banget, makanannya sampai hangat. Soto Daging Sapinya empuk.',
                'is_approved' => true,
            ],
            [
                'name' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'rating' => 5,
                'message' => 'Tempatnya bersih dan pelayanannya ramah. Es Jeruk Perasnya segar sekali.',
                'is_approved' => true,
            ],
            [
                'name' => 'Andi Firmansyah', 'email' => 'andi@example.com', 'rating' => 4,
                'message' => 'Catering untuk acara kantor kami sukses, semua teman suka. Recommended!',
                'is_approved' => true,
            ],
            [
                'name' => 'Fajar Nugroho', 'email' => 'fajar@example.com', 'rating' => 5,
                'message' => 'Soto Betawinya mirip banget sama yang di Jakarta. Rasanya autentik.',
                'is_approved' => false,
            ],
        ];

        foreach ($testimonis as $testimoni) {
            Testimoni::updateOrCreate(
                ['email' => $testimoni['email']],
                $testimoni
            );
        }
    }

    private function seedContactMessages(): void
    {
        $messages = [
            [
                'name' => 'Siti Nurhaliza', 'email' => 'siti@example.com', 'phone' => '081234567111',
                'subject' => 'Tanya paket catering',
                'message' => 'Halo, apakah tersedia paket catering untuk acara 50 orang? Mohon info harganya ya.',
                'is_read' => true,
            ],
            [
                'name' => 'Joko Widodo', 'email' => 'joko@example.com', 'phone' => '081234567222',
                'subject' => 'Reservasi tempat',
                'message' => 'Saya ingin reservasi tempat untuk 10 orang hari Sabtu pukul 13.00. Apakah masih ada slot?',
                'is_read' => false,
            ],
            [
                'name' => 'Rina Sulistia', 'email' => 'rina@example.com', 'phone' => '081234567333',
                'subject' => 'Info menu',
                'message' => 'Apakah Soto Babat sudah tersedia lagi? Terima kasih.',
                'is_read' => false,
            ],
        ];

        foreach ($messages as $message) {
            ContactMessage::updateOrCreate(
                ['name' => $message['name'], 'subject' => $message['subject']],
                $message
            );
        }
    }

    private function seedBanners(): void
    {
        $banners = [
            [
                'page' => 'home',
                'title' => 'Kelezatan Otentik,<br>Disajikan Hangat.',
                'subtitle' => 'Temukan cita rasa soto warisan yang tak terlupakan di Soto Vokasi.',
                'background_image' => 'images/home/slider.png',
                'button_text' => 'Explore Menu',
                'button_url' => '/menu',
                'is_active' => true,
            ],
            [
                'page' => 'testimonial',
                'title' => 'Bagikan Testimoni Anda',
                'subtitle' => 'Ceritakan pengalaman anda menikmati soto kami.',
                'background_image' => 'images/home/slider.avif',
                'button_text' => 'Tulis Testimoni',
                'button_url' => null,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(['page' => $banner['page']], $banner);
        }
    }

    private function seedGalleries(): void
    {
        $galleries = [
            ['image' => 'images/gallery/sotovokasi.jpg', 'caption' => 'Warung Soto Vokasi', 'order' => 1, 'is_active' => true],
            ['image' => 'images/gallery/pakde.jpeg', 'caption' => 'Sajian soto hangat', 'order' => 2, 'is_active' => true],
            ['image' => 'images/gallery/grobak.webp', 'caption' => 'Gerobak legendaris', 'order' => 3, 'is_active' => true],
            ['image' => 'images/gallery/soto_1.jpg', 'caption' => 'Semangkuk soto nikmat', 'order' => 4, 'is_active' => true],
            ['image' => 'images/gallery/paklek.jpeg', 'caption' => 'Suasana warung', 'order' => 5, 'is_active' => true],
            ['image' => 'images/gallery/hole.jpeg', 'caption' => 'Pelanggan setia', 'order' => 6, 'is_active' => true],
            ['image' => 'images/gallery/kk.jpeg', 'caption' => 'Momen bersama', 'order' => 7, 'is_active' => true],
            ['image' => 'images/gallery/makan.jpg', 'caption' => 'Sepiring lengkap', 'order' => 8, 'is_active' => true],
            ['image' => 'images/gallery/pak.jpeg', 'caption' => 'Sang pendiri', 'order' => 9, 'is_active' => true],
            ['image' => 'images/gallery/soto.jpg', 'caption' => 'Soto khas Vokasi', 'order' => 10, 'is_active' => true],
        ];

        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(['image' => $gallery['image']], $gallery);
        }
    }

    private function seedOrders(): void
    {
        $orderNumbers = [
            'ORD-20260913-7F3K9Z',
            'ORD-20260913-H5T8NQ',
            'ORD-20260912-C4R7VP',
            'ORD-20260911-M2N8BW',
            'ORD-20260910-Q1W5EH',
            'ORD-20260909-T9Y3ZA',
        ];

        Order::whereIn('order_number', $orderNumbers)->delete();

        $demoUser = User::where('email', 'demo@example.com')->first();
        $secondUser = User::where('email', 'customer@example.com')->first();

        $orders = [
            [
                'order_number' => $orderNumbers[0],
                'user_id' => $demoUser?->id,
                'customer_name' => 'Demo Customer',
                'customer_email' => 'demo@example.com',
                'customer_phone' => '081234567892',
                'customer_address' => 'Jl. Gajayana No. 50, Malang',
                'payment_status' => 'completed',
                'order_status' => 'completed',
                'payment_method' => 'va_bca',
                'transaction_id' => 'TRX-7F3K9Z-DEMO',
                'notes' => 'Pesan lewat online, sambal dipisah.',
                'items' => [
                    'soto-ayam-lamongan' => 2,
                    'nasi-putih' => 2,
                    'es-teh-manis' => 2,
                ],
            ],
            [
                'order_number' => $orderNumbers[1],
                'user_id' => $demoUser?->id,
                'customer_name' => 'Demo Customer',
                'customer_email' => 'demo@example.com',
                'customer_phone' => '081234567892',
                'customer_address' => 'Jl. Gajayana No. 50, Malang',
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'payment_method' => 'qris',
                'transaction_id' => 'TRX-H5T8NQ-DEMO',
                'notes' => null,
                'items' => [
                    'soto-daging-sapi' => 1,
                    'jus-alpukat' => 1,
                ],
            ],
            [
                'order_number' => $orderNumbers[2],
                'user_id' => $secondUser?->id,
                'customer_name' => 'Budi Santoso',
                'customer_email' => 'customer@example.com',
                'customer_phone' => '085712345678',
                'customer_address' => 'Jl. Soekarno Hatta No. 12, Malang',
                'payment_status' => 'completed',
                'order_status' => 'processing',
                'payment_method' => 'go_pay',
                'transaction_id' => 'TRX-C4R7VP-DEMO',
                'notes' => 'Tolong dibungkus rapi untuk dibawa.',
                'items' => [
                    'soto-betawi' => 1,
                    'perkedel-kentang' => 2,
                    'es-kopi-susu-gula-aren' => 3,
                ],
            ],
            [
                'order_number' => $orderNumbers[3],
                'user_id' => null,
                'customer_name' => 'Rina Sulistia',
                'customer_email' => 'rina@example.com',
                'customer_phone' => '081234567333',
                'customer_address' => 'Jl. Arjuno No. 8, Malang',
                'payment_status' => 'failed',
                'order_status' => 'failed',
                'payment_method' => 'va_bni',
                'transaction_id' => 'TRX-M2N8BW-DEMO',
                'notes' => null,
                'items' => [
                    'soto-ayam-kampung' => 1,
                    'kerupuk-udang' => 1,
                ],
            ],
            [
                'order_number' => $orderNumbers[4],
                'user_id' => $demoUser?->id,
                'customer_name' => 'Demo Customer',
                'customer_email' => 'demo@example.com',
                'customer_phone' => '081234567892',
                'customer_address' => 'Jl. Gajayana No. 50, Malang',
                'payment_status' => 'completed',
                'order_status' => 'cancelled',
                'payment_method' => 'shopeepay',
                'transaction_id' => 'TRX-Q1W5EH-DEMO',
                'notes' => 'Dibatalkan oleh pembeli.',
                'items' => [
                    'soto-kombinasi' => 1,
                    'es-jeruk-peras' => 1,
                ],
            ],
            [
                'order_number' => $orderNumbers[5],
                'user_id' => null,
                'customer_name' => 'Andi Firmansyah',
                'customer_email' => 'andi@example.com',
                'customer_phone' => '081234567444',
                'customer_address' => 'Jl. Ijen No. 5, Malang',
                'payment_status' => 'completed',
                'order_status' => 'completed',
                'payment_method' => 'va_mandiri',
                'transaction_id' => 'TRX-T9Y3ZA-DEMO',
                'notes' => 'Datang langsung jam 12.',
                'items' => [
                    'soto-ayam-kampung' => 2,
                    'nasi-putih' => 2,
                    'telur-rebus' => 2,
                ],
            ],
        ];

        foreach ($orders as $order) {
            $items = $order['items'];
            unset($order['items']);

            $transactionId = $order['transaction_id'];
            unset($order['transaction_id']);

            $orderStatus = $order['order_status'];
            $total = 0;

            foreach ($items as $slug => $quantity) {
                $product = Product::where('slug', $slug)->first();
                $total += $product->price * $quantity;
            }

            $orderEntity = Order::create(array_merge($order, [
                'total_amount' => $total,
                'midtrans_transaction_id' => $transactionId,
            ]));

            $orderEntity->order_status = $orderStatus;
            $orderEntity->save();

            foreach ($items as $slug => $quantity) {
                $product = Product::where('slug', $slug)->first();

                OrderItem::create([
                    'order_id' => $orderEntity->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $product->price * $quantity,
                ]);
            }

            $historyStatus = match ($order['payment_status']) {
                'completed' => 'settlement',
                'failed' => 'expire',
                default => 'pending',
            };

            PaymentHistory::updateOrCreate(
                ['transaction_id' => $transactionId],
                [
                    'order_id' => $orderEntity->id,
                    'payment_method' => $order['payment_method'],
                    'status' => $historyStatus,
                    'amount' => $total,
                    'metadata' => [
                        'transaction_id' => $transactionId,
                        'payment_type' => str_starts_with($order['payment_method'], 'va_') ? 'bank_transfer' : 'echannel',
                        'transaction_status' => $historyStatus,
                        'fraud_status' => $historyStatus === 'settlement' ? 'accept' : 'unchecked',
                        'channel' => $order['payment_method'],
                    ],
                ]
            );
        }
    }
}