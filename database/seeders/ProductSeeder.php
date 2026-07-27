<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'         => 'Nusantara No.1',
                'type'         => 'Eau de Parfum',
                'gender'       => 'Unisex',
                'variant'      => 'Woody Floral',
                'top_notes'    => 'Bergamot, Lemon',
                'middle_notes' => 'Melati, Mawar',
                'base_notes'   => 'Sandalwood, Musk',
                'packaging'    => 'Botol kaca spray 30ml, dus karton',
                'size'         => '30ml',
                'price'        => 85000,
                'stock'        => 42,
                'best_seller'  => true,
                'image'        => 'assets/images/Nusantara1nobg.png',
                'description'  => 'Nusantara No.1 adalah simfoni aroma yang menyatukan keharuman bunga nusantara dengan sentuhan wood yang elegan. Wewangian unisex ini hadir dengan bukaan segar bergamot dan lemon, berkembang menjadi buket melati dan mawar yang menawan, dan menutup dengan landasan sandalwood hangat berpadu musk yang abadi.',
                'tagline'      => 'Elegan, segar, dan abadi',
            ],
            [
                'name'         => 'Nusantara No.2 – Rempah',
                'type'         => 'Eau de Parfum',
                'gender'       => 'Pria',
                'variant'      => 'Spicy Oriental',
                'top_notes'    => 'Cengkeh, Kayu Manis',
                'middle_notes' => 'Cendana',
                'base_notes'   => 'Amber, Vanilla',
                'packaging'    => 'Botol kaca spray 30ml, dus karton',
                'size'         => '30ml',
                'price'        => 95000,
                'stock'        => 18,
                'best_seller'  => false,
                'image'        => 'assets/images/nusantara_no2.png',
                'description'  => 'Nusantara No.2 Rempah membawa semangat kepulauan rempah Indonesia ke dalam sebuah botol. Diperkaya dengan cengkeh dan kayu manis yang kuat di awal, dihaluskan oleh cendana di hati, dan ditutup oleh amber serta vanilla yang hangat dan membekas.',
                'tagline'      => 'Berani, hangat, dan penuh karakter',
            ],
            [
                'name'         => 'Nusantara Roll-On Mini',
                'type'         => 'Roll-on',
                'gender'       => 'Wanita',
                'variant'      => 'Sweet Floral',
                'top_notes'    => 'Strawberry, Raspberry',
                'middle_notes' => 'Mawar, Peony',
                'base_notes'   => 'Musk, Vanilla',
                'packaging'    => 'Botol roll-on plastik 10ml',
                'size'         => '10ml',
                'price'        => 35000,
                'stock'        => 76,
                'best_seller'  => true,
                'image'        => 'assets/images/nusantara_rollon.png',
                'description'  => 'Nusantara Roll-On Mini adalah teman manis yang selalu siap menemani harimu. Dengan semburan buah beri segar di awal, jantung bunga yang feminin, dan akhir musk-vanilla yang lembut, ini adalah wewangian sempurna untuk wanita yang ceria dan percaya diri.',
                'tagline'      => 'Manis, segar, dan memikat',
            ],
            [
                'name'         => 'Dynamyst',
                'type'         => 'Eau de Parfum',
                'gender'       => 'Pria',
                'variant'      => 'Fresh Aquatic / Citrus',
                'top_notes'    => 'Grapefruit, Sea Salt',
                'middle_notes' => 'Sage, Rosemary',
                'base_notes'   => 'Cedarwood, Patchouli',
                'packaging'    => 'Botol kaca spray 50ml, dus karton',
                'size'         => '50ml',
                'price'        => 115000,
                'stock'        => 25,
                'best_seller'  => false,
                'image'        => 'assets/images/dynamyst.png',
                'description'  => 'Dynamyst adalah wewangian untuk pria yang dinamis dan penuh energi. Grapefruit dan garam laut membuka skenario dengan segar dan berani, sage dan rosemary memberi karakter herbal yang maskulin, sementara cedarwood dan patchouli menutup perjalanan dengan kedalaman yang tahan lama.',
                'tagline'      => 'Maskulin, tegas, dan penuh energi',
            ],
            [
                'name'         => 'Vanessence',
                'type'         => 'Eau de Parfum',
                'gender'       => 'Wanita',
                'variant'      => 'Gourmand Vanilla',
                'top_notes'    => 'Almond, Anise',
                'middle_notes' => 'Vanilla Orchid, Heliotrope',
                'base_notes'   => 'Bourbon Vanilla, Tonka Bean',
                'packaging'    => 'Botol kaca spray 50ml, dus karton',
                'size'         => '50ml',
                'price'        => 120000,
                'stock'        => 30,
                'best_seller'  => true,
                'image'        => 'assets/images/vanessence.png',
                'description'  => 'Vanessence adalah perpaduan bunga yang lembut dengan sentuhan vanilla hangat. Dibuat untuk wanita yang anggun namun berkarakter — wangi yang manis di awal, floral di tengah, dan meninggalkan jejak musky yang menggoda sepanjang hari.',
                'tagline'      => 'Feminin, manis, dan memikat',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
