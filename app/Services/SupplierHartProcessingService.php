<?php

namespace App\Services;

use App\Models\Supplier;
use App\Models\SuppliersProduct;
use App\Models\SuppliersProductsPrice;
use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;
use Zip;
use App\Services\ImageUploadService;

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
        $imageUrl = null;

        if (Storage::disk('public')->exists('upload/54871_kth.zip')) {
            $zip = Zip::open(\storage_path('app/public/upload/54871_kth.zip'));
            $zip->extract(\storage_path('app/public/upload'));
            Storage::disk('public')->delete('upload/54871_kth.zip');

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

                $product = SuppliersProduct::where('supplier_internal_code', $csvDataItem['KOD_HART'])->first();

                $csvDataItemPriceArray = [
                    'tenant_id' => $tenant->getId(),
                    'price' => $csvDataItem['CENA'],
                ];

                if ($product) {
                    $product->update($csvDataItemArray);
                    $productPrice = SuppliersProductsPrice::where('tenant_id', $tenant->getId())->where('supplier_product_id', $product->getId())->first();
                    if ($productPrice) {
                        $productPrice->update($csvDataItemPriceArray);
                    } else {
                        $csvDataItemPriceArray['supplier_product_id'] = $product->getId();
                        $newSupplierProductPrice = SuppliersProductsPrice::create($csvDataItemPriceArray);
                    }
                } else {
                    $product = SuppliersProduct::create($csvDataItemArray);
                    $csvDataItemPriceArray['supplier_product_id'] = $product->getId();
                    $productPrice = SuppliersProductsPrice::create($csvDataItemPriceArray);
                };



                //$imageUrl = 'https://cdn.myshoptet.com/usr/www.gamadarky.cz/user/shop/big/151285_spejbl-a-hurvinek.png?6377f87c';
                if ($imageUrl) {
                    $service = new ImageUploadService();
                    $uploadImage = $service->process($product, $imageUrl);
                }

            }
        }

        return true;
    }
}
