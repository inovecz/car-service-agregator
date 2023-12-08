<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TenantSetting extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected $primaryKey = null;
    protected $keyType = null;
    public $incrementing = false;

    protected $casts = [
        'value' => 'array',
    ];


    //Relationships
    public function tenant(): HasMany
    {
        return $this->hasOne(Tenant::class, 'id', 'tenant_id');
    }

    //Getters
    public function getTenantId(): int
    {
        return $this->tenant_id;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): ?array
    {
        return $this->value;
    }
}
