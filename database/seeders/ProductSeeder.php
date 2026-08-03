<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Reset table before seeding
        Product::truncate();

        $products = [
            [
                'name'         => 'Vanessence',
                'type'         => 'Eau de Parfum',
                'gender'       => 'Wanita',
                'variant'      => 'Gourmand Vanilla',
                'top_notes'    => 'Rose, Jasmine, Ylang',
                'middle_notes' => 'Vanilla, Sandalwood',
                'base_notes'   => 'Musk, Amber, Cedarwood',
                'packaging'    => 'Botol kaca spray 30ml, dus karton',
                'size'         => '30ml',
                'price'        => 45000,
                'stock'        => 30,
                'best_seller'  => true,
                'image'        => 'assets/images/penisence.webp',
                'description'  => 'Vanessence adalah perpaduan bunga yang lembut dengan sentuhan vanilla hangat. Dibuat untuk wanita yang anggun namun berkarakter.',
                'tagline'      => 'Feminin, manis, dan memikat',
            ],
            [
                'name'         => 'Dynamyst',
                'type'         => 'Eau de Parfum',
                'gender'       => 'Pria',
                'variant'      => 'Spicy Woody',
                'top_notes'    => 'Grapefruit, Sea Salt',
                'middle_notes' => 'Sage, Rosemary',
                'base_notes'   => 'Cedarwood, Patchouli',
                'packaging'    => 'Botol kaca spray 30ml, dus karton',
                'size'         => '30ml',
                'price'        => 45000,
                'stock'        => 25,
                'best_seller'  => true,
                'image'        => 'assets/images/dynamist.webp',
                'description'  => 'Dynamyst adalah wewangian untuk pria yang dinamis dan penuh energi.',
                'tagline'      => 'Maskulin, tegas, penuh energi',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
