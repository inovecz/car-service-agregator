<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //Relationships
    public function suppliersProduct(): HasMany
    {
        return $this->hasMany(SuppliersProduct::class, 'code', 'product_code');
    }

    //Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
