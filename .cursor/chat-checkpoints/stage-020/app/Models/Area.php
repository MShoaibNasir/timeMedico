<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Area extends Model
{
    use HasFactory;


    protected $table = 'area';
    protected $guarded = ['id'];

    protected $casts = [
        'delivery_charges' => 'float',
        'status' => 'integer',
        'is_service_able' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeServiceable($query)
    {
        return $query->where('is_service_able', 1);
    }

    public function scopeNonServiceable($query)
    {
        return $query->where('is_service_able', 0);
    }

    public function isServiceable(): bool
    {
        return (bool) $this->is_service_able;
    }
}
