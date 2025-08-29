<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $table = 'portofolios';
    protected $fillable = [
        'name',
        'tumbnail',
        'image',
        'create_date',
        'description',
    ];

     protected function casts(): array
    { 
        return [
            'image' => 'array',
        ];
    }
}
