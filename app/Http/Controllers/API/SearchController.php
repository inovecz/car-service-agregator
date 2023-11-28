<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProductsCode;
use App\Models\SuppliersProduct;
use App\Http\Resources\SuppliersProductResource;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchProducts(Request $request)
    {
        $searchCode = $request->query('productCode');

        $codesResult = ProductsCode::where('code', 'like', '%' . $searchCode . '%')->get();

        $productsArray = [];

        foreach ($codesResult as $code) {
            $suppliersProduct = SuppliersProduct::where('product_code', $code->getCode())->first();
            $productsArray[] = new SuppliersProductResource($suppliersProduct);
        }

        if ($codesResult && !empty($productsArray)) {
            return response()->json([
                'products' => $productsArray
        ]);
        } else {
            return response()->json([
                'products' => null
            ]);
        }
    }

}
