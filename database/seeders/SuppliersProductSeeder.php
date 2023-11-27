<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\ProductsCode;
use App\Models\SuppliersProduct;

class SuppliersProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allSuppliers = Supplier::all();
        $productCodes = ProductsCode::all();

        foreach ($allSuppliers as $supplier) {

            foreach ($productCodes as $productCode) {
                SuppliersProduct::create([
                    'product_code' => $productCode->getCode(),
                    'supplier_id' => $supplier->getId()
                ]);
            }
        }
    }
}
