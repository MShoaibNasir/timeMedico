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
    ];
}
