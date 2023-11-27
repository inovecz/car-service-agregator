<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'name' => 'Supplier',
        ]);

        Supplier::create([
            'name' => 'Anbieter',
        ]);

        Supplier::create([
            'name' => 'Dostawca',
        ]);
    }
}
