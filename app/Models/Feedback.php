<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Feedback extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table='feedback';
	
	
	public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}