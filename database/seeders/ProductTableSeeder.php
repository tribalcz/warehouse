<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $product = new Product();
            $product->name = 'Produkt ' . $i;
            $product->price = rand(1, 10000);
            $product->qty = rand(1, 100);
            $product->supplier_id = random_int(1, 20);
            $product->warehouse_id = random_int(1, 10);

            if(random_int(1, 4) === 1) {
                $product->deleted_at = now();
            }

            $product->save();
        }

    }
}
