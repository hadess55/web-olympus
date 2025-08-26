<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
    ];

     protected function casts(): array
    { 
        return [
            'image' => 'array',
        ];
    }
}
