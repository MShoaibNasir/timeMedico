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
    public function getDeliveryChargesAttribute($value)
    { 
        return $value;
        // return number_format($value);
    }

    //  public function product()
    // {
    //     return $this->belongsTo(Product::class, 'product_id', 'id');
    // }


}
