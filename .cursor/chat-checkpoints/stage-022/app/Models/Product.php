<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Added for Soft Deletes


class Product extends Model
{
    use HasFactory;
    use SoftDeletes; // Added for Soft Deletes


    protected $table = 'products';
    protected $guarded = ['id'];
    protected $appends = [
        'discount_amount',
        'final_price',
    ];



    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withTrashed();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function type_data()
    {
        return $this->HasOne(Type::class, 'id', 'type')->withTrashed();
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
    public function getDiscountAmountAttribute()
    {
        $price = (float) $this->price;
        $discount = (float) $this->discount;
        return ($price * $discount) / 100;
    }
    public function getFinalPriceAttribute()
    {
        $price = (float) $this->price;
        $discountAmount = ($price * (float) $this->discount) / 100;
        return $price - $discountAmount;
    }
}
