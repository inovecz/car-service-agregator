<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Supplier;
use App\Models\ProductsCode;

class SuppliersProduct extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relationships
    public function supplier(): ?HasOne
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function productCode(): HasOne
    {
        return $this->hasOne(ProductsCode::class, 'code', 'product_code');
    }

    //Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getSupplierId(): int
    {
        return $this->supplier_id;
    }

    public function getProductCode(): string
    {
        return $this->product_code;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }


}
