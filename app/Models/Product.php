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
    protected $guarded =['id'];

 

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withTrashed();
    }
    public function type_data()
    {
        return $this->HasOne(Type::class, 'id', 'type')->withTrashed();
    }
   
  
}
