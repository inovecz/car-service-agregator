<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at'];

    //Relationships
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'tenant_uuid', 'uuid');
    }

    //Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
