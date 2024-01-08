<?php

namespace App\Services;

use App\Models\Supplier;
use App\Models\SuppliersProduct;
use App\Models\SuppliersProductsPrice;
use App\Models\Tenant;
use App\Models\TenantSetting;
use App\Http\Resources\SuppliersProductResource;
use Illuminate\Support\Facades\Storage;
use Zip;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class SupplierLKQProcessingService
{
    public function process($productLkqId)
    {
        $tenants = Tenant::all();
        $supplier = Supplier::where('name', 'LKQ')->first();
        $isActivated = false;

        foreach ($tenants as $tenant) {
            $tenantSetting = TenantSetting::where('tenant_id', $tenant->getId())->where('key', 'integration.lkq')->first();

            if ($tenantSetting) {
                $isActivated = filter_var($tenantSetting['value']['activated'], FILTER_VALIDATE_BOOLEAN);
            }

            if($isActivated) {
                return $this->processTenant($tenant, $supplier, $tenantSetting, $productLkqId);
            }
        };

        return;
    }

    public function processTenant($tenant, $supplier, $tenantSetting, $productLkqId)
    {

        $headers = ['Content-Type' => 'application/x-www-form-urlencoded'];

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.lkq-europe.com',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        //Authorization, get access token
        $bodyForAuthorization = ['scope' => 'vpom', 'grant_type' => 'client_credentials', 'client_id' => 'NMEg1QhKLGMnGYzhwTKYXeeazzGE52TU', 'client_secret' => 'gmLhoyamwZJSxaa4'];

        $response =
        $client->post('/vpom-oauth/token', [
            'headers' => $headers,
            'form_params' => $bodyForAuthorization
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);
        $accessToken = ($responseBody['access_token']);

        //Search
        $headersForSearch = ['Authorization' => 'Bearer ' . $accessToken,'Content-Type' => 'application/json'];
        /*  $bodyForSearch = [
             'credentials' =>    [
                                     'userId' => '869790',
                                     'systemName' => 'ISAK',
                                     'additionalParams' => [
                                         ['type' => 'branch', 'value' => '125']
                                     ]
                                 ],
             'ids' => [
                         ['type' => 'ISAK', 'id' => 'BA SL 180P']
                     ]
         ];
 */

        $bodyForSearch = json_decode('{
            "credentials": {
              "userId": "869790",
              "systemName": "ISAK",
              "additionalParams": [
                {
                    "type" : "branch",
                    "value" : "125" 
                }
            ]
            },
              "ids": [
                {
                    "type" : "ISAK",
                    "id" : "' . $productLkqId . '"
                } ]
                
           
          }', true);


        // isak = objednaci kod produktu, hleda se podle interniho objednavaciho kodu
        $searchResponse = $client->post('/core/orders-management/v1/products', ['headers' => $headersForSearch, 'json' => $bodyForSearch]);
        $searchResponseBody = json_decode($searchResponse->getBody()->getContents(), true);

        /* var_dump($searchResponseBody);
        die; */
       /*  dd(!$searchResponseBody['response']['data'] . isEmpty()); */
        if (!empty($searchResponseBody['response']['data'])) {
            $foundProduct = new SuppliersProduct([
                'id' => 0,
                'supplier_id' => $supplier->getId(),
                'supplier_internal_code' => '',
                'supplier_product_identifier' => $searchResponseBody['response']['data'][0]['productId']['id'],
                'tecdoc_code' => null,
                'product_code' => $searchResponseBody['response']['data'][0]['productId']['id'],
                'name' => '',
                'category_name' => '',
                'provider' => '',
                'units' => '',
                'ean' => '',
                'origin' => '',
                'original_data' => null,
            ]);

            $foundProductPrice = new SuppliersProductsPrice([
                'id' => 0,
                'tenant_id' => $tenant->getId(),
                'supplier_product_id' => 0,
                'supplier_product_identifier' => $searchResponseBody['response']['data'][0]['productId']['id'],
                'price' => $searchResponseBody['response']['data'][0]['prices'][0]['value'],
            ]);

            $foundProduct->suppliersProductsPrices->push($foundProductPrice);

            return $foundProduct;
        }
        return false;

        /* if ($csvData) {
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
        } */

        return true;
    }
}
