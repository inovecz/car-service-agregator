<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuppliersProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        
        return [
             'id' => $this->getId(),
             'product_code' => $this->getProductCode(),
             'supplier_name' => $this->supplier->getName(),
             'product_name' => $this->getName(),
             //'product_name' => $this->productCode->getName(),
             'price' => $this->suppliersProductsPrices->first(),
             'availability' => $this->getAvailability(),
             'url' => $this->getUrl(),
             'media_url' => $this->getMediaUrl()
         ];
    }
}
