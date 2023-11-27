<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Supplier;
use App\Models\ProductCode;

class SuppliersProduct extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relationships
    public function supplier(): ?HasOne
    {
        return $this->hasOne(Supplier::class, 'supplier_id', 'id');
    }

    public function productCode(): HasOne
    {
        return $this->hasOne(ProductCode::class, 'product_code', 'code');
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

    public function getProductCode(): int
    {
        return $this->product_code;
    }


}
