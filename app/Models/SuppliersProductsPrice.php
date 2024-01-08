<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Model\SuppliersProduct;


class SuppliersProductsPrice extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'price' => 'double'
    ];

    //Relationships
    public function suppliersProduct(): HasOne
    {
        return $this->hasOne(SuppliersProduct::class, 'supplier_product_identifier', 'supplier_product_identifier');
    }

    //Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTenantId(): string
    {
        return $this->id;
    }

    public function getSuppliersProductId(): int
    {
        return $this->supplier_product_id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }
}
