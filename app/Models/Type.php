<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 


class Type extends Model
{
    use HasFactory;
    use SoftDeletes; 


    protected $table = 'types';
    protected $guarded =['id'];

     public function product()
    {
        return $this->hasMany(Product::class, 'type', 'id')->withTrashed();
    }

  
}
