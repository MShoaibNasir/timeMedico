<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PaymentSlipHistory extends Model
{
    use HasFactory;


    protected $table = 'payment_slip_history';
    protected $guarded = ['id'];

    
}
