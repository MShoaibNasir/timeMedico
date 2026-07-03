<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UploadPrescription  extends Model
{
    use HasFactory;


    protected $table = 'upload_prescription';
    protected $guarded =['id'];

  
}
