<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImgBreed extends Model
{
    protected $fillable = [
        'url',
        'breed_id',
        'breed'          
    ];
}
