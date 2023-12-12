<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Tenant extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at'];

    protected $casts = [
        'active_date_to' => 'datetime:Y-m-d HH:MM:SS',
    ];

    //Relationships
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'tenant_uuid', 'uuid');
    }

    public function tenantSettings(): HasMany
    {
        return $this->hasMany(TenantSetting::class, 'tenant_id', 'id');
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

    public function getActiveDateTo()
    {
        return $this->active_date_to;
    }

    public function isSubscriptionActive() {
        return $this->getActiveDateTo() > Carbon::now();
    }
}
