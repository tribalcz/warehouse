<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $suppliers = new Supplier();
            $suppliers->name = 'Dodavatel ' . $i;
            $suppliers->address = 'Adresa dodavatele ' . $i;

            if(random_int(1, 4) === 1) {
                $suppliers->deleted_at = now();
            }

            $suppliers->save();
        }
    }
}
