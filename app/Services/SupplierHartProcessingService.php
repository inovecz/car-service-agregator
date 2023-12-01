<?php

namespace App\Services;

use App\Models\Supplier;
use App\Models\SuppliersProduct;
use App\Models\SuppliersProductsPrice;
use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;
use Zip;

class SupplierHartProcessingService
{
    public function process()
    {
        $tenants = Tenant::all();
        $supplier = Supplier::where('name', 'HART')->first();

        foreach ($tenants as $tenant) {
            $this->processTenant($tenant, $supplier);
        };

        return true;
    }

    public function processTenant($tenant, $supplier)
    {
        $csvData = null;

        if (Storage::disk('public')->exists('upload/54871_kth.csv')) { //
            /*  $zip = Zip::open(\storage_path('app/public/upload/54871_kth.zip'));
             $zip->extract(\storage_path('app/public/upload'));
             Storage::disk('public')->delete('upload/54871_kth.zip'); */

            $parsedCsv = \League\Csv\Reader::createFromPath(\storage_path('app/public/upload/54871_kth.csv'), 'r');
            $parsedCsv->setDelimiter(';');
            $parsedCsv->setHeaderOffset(0);
            $header = $parsedCsv->getHeader();
            $records = $parsedCsv->getRecords();
            $csvData = [];
            foreach ($records as $record) {
                $csvData[] = array_combine($header, $record);
            }
        }

        if ($csvData) {
            foreach ($csvData as $csvDataItem) {
                $csvDataItemArray = [
                    'supplier_id' => $supplier->getId(),
                    'supplier_internal_code' => $csvDataItem['KOD_HART'],
                    'tecdoc_code' => $csvDataItem['TECDOC_KOD'],
                    'product_code' => $csvDataItem['KOD_TOWARU'],
                    'name' => $csvDataItem['NAZWA'],
                    'category_name' => $csvDataItem['KATEGORIA'],
                    'provider' => $csvDataItem['DOSTAWCA'],
                    'units' => $csvDataItem['JEDNOSTKA_MIARY'],
                    'ean' => $csvDataItem['EAN_CODES'],
                    'origin' => $csvDataItem['ORIGIN'],
                    'original_data' => json_encode($csvDataItem)
                ];
                
                $existingProduct = SuppliersProduct::where('supplier_internal_code', $csvDataItem['KOD_HART'])->first();

                $csvDataItemPriceArray = [
                    'tenant_id' => $tenant->getId(),
                    'price' => $csvDataItem['CENA'],
                ];

                if ($existingProduct) {
                    $existingProduct->update($csvDataItemArray);
                    $existingProductPrice = SuppliersProductsPrice::where('tenant_id', $tenant->getId())->where('supplier_product_id', $existingProduct->getId())->first();
                    if ($existingProductPrice) {
                        $existingProductPrice->update($csvDataItemPriceArray);
                    } else {
                        $csvDataItemPriceArray['supplier_product_id'] = $existingProduct->getId();
                        $newSupplierProductPrice = SuppliersProductsPrice::create($csvDataItemPriceArray);
                    }
                } else {
                    $newSupplierProduct = SuppliersProduct::create($csvDataItemArray);
                    $csvDataItemPriceArray['supplier_product_id'] = $newSupplierProduct->getId();
                    $newSupplierProductPrice = SuppliersProductsPrice::create($csvDataItemPriceArray);
                };

            }
        }

        return true;
    }
}
