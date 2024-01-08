<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Supplier;
use App\Models\ProductsCode;
use App\Models\SuppliersProductsPrice;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SuppliersProduct extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = ['created_at', 'updated_at'];

    //Relationships
    public function supplier(): ?HasOne
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function productCode(): HasOne
    {
        return $this->hasOne(ProductsCode::class, 'code', 'product_code');
    }

    public function suppliersProductsPrices(): ?HasMany
    {
        return $this->hasMany(SuppliersProductsPrice::class, 'supplier_product_identifier', 'supplier_product_identifier');
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getSupplierInternalCode(): string
    {
        return $this->supplier_internal_code;
    }

    public function getTecdocCode(): string
    {
        return $this->tecdoc_code;
    }

    public function getCategoryName(): string
    {
        return $this->category_name;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function getUnits(): string
    {
        return $this->units;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getOriginalData(): ?string
    {
        return $this->original_data;
    }

    public function getMediaUrl()
    {
        return $this->getFirstMedia('Images') ? $this->getFirstMedia('Images')->getFullUrl() : null;
    }
}
