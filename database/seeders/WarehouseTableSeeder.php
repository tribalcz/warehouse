<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class WarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $warehouse = new Warehouse();
            $warehouse->address = 'Adresa skladu ' . $i;

            if(random_int(1, 4) === 1) {
                $warehouse->deleted_at = now();
            }

            $warehouse->save();
        }
    }
}
