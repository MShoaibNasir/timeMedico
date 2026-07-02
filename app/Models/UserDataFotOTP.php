<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserDataFotOTP extends Model
{
    use HasFactory;


    protected $table = 'user_data_for_otp';
    protected $guarded = ['id'];
}
