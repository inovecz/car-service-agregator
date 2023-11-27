<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\ProductsCode;

class ProductsCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductsCode::create([
            'code' => 'AAA000',
            'name' => 'Brzdy',
        ]);

        ProductsCode::create([
            'code' => 'BBB000',
            'name' => 'Brzdy',
        ]);

        ProductsCode::create([
            'code' => 'CCC000',
            'name' => 'Brzdy',
        ]);

        ProductsCode::create([
            'code' => 'DDD000',
            'name' => 'Brzdy',
        ]);

        ProductsCode::create([
            'code' => 'EEE000',
            'name' => 'Brzdy',
        ]);


        ProductsCode::create([
            'code' => 'AAA001',
            'name' => 'Volant',
        ]);

        ProductsCode::create([
            'code' => 'BBB001',
            'name' => 'Volant',
        ]);

        ProductsCode::create([
            'code' => 'CCC001',
            'name' => 'Volant',
        ]);

        ProductsCode::create([
            'code' => 'DDD001',
            'name' => 'Volant',
        ]);

        ProductsCode::create([
            'code' => 'EEE001',
            'name' => 'Volant',
        ]);

        ProductsCode::create([
            'code' => 'AAA002',
            'name' => 'Pneumatika',
        ]);

        ProductsCode::create([
            'code' => 'BBB002',
            'name' => 'Pneumatika',
        ]);

        ProductsCode::create([
            'code' => 'CCC002',
            'name' => 'Pneumatika',
        ]);

        ProductsCode::create([
            'code' => 'DDD002',
            'name' => 'Pneumatika',
        ]);

        ProductsCode::create([
            'code' => 'EEE002',
            'name' => 'Pneumatika',
        ]);

        ProductsCode::create([
            'code' => 'AAA003',
            'name' => 'Kapota',
        ]);

        ProductsCode::create([
            'code' => 'BBB003',
            'name' => 'Kapota',
        ]);

        ProductsCode::create([
            'code' => 'CCC003',
            'name' => 'Kapota',
        ]);

        ProductsCode::create([
            'code' => 'DDD003',
            'name' => 'Kapota',
        ]);

        ProductsCode::create([
            'code' => 'EEE003',
            'name' => 'Kapota',
        ]);

        ProductsCode::create([
            'code' => 'AAA004',
            'name' => 'Nárazník',
        ]);

        ProductsCode::create([
            'code' => 'BBB004',
            'name' => 'Nárazník',
        ]);

        ProductsCode::create([
            'code' => 'CCC004',
            'name' => 'Nárazník',
        ]);

        ProductsCode::create([
            'code' => 'DDD004',
            'name' => 'Nárazník',
        ]);

        ProductsCode::create([
            'code' => 'EEE004',
            'name' => 'Nárazník',
        ]);
    }
}
