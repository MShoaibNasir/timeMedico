<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Category extends Model
{
    use HasFactory;
    use SoftDeletes; 
    protected $guarded = ['id'];
    protected $table='categories';

     public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')->withTrashed();
    }
     public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->withTrashed();
    }
     public function products_with_out_trashed()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

}