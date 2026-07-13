<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Department extends Model
{
    use HasFactory;
    use SoftDeletes; 
    protected $guarded = ['id'];
    protected $table='departments';
	
	
	public function categories()
    {
        return $this->hasMany(Category::class, 'department_id', 'id')->withTrashed();
    }

}