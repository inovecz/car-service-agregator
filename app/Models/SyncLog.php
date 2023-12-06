<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncLog extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    //Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTenantUuid(): string
    {
        return $this->tenant_id;
    }

    public function getSupplierName(): string
    {
        return $this->supplier_name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

}
