<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $fillable = [
        'name',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'description',
    ];
}
