<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Portofolio extends Model
{
    protected $table = 'portofolios';
    protected $fillable = [
        'name',
        'tumbnail',
        'slug',
        'image',
        'technologies',
        'create_date',
        'description',
    ];

     protected function casts(): array
    { 
        return [
            'technologies' => 'array',
            'image' => 'array',
            'create_date' => 'datetime',
        ];
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

       
    public function getCoverUrlAttribute(): string
    {
        $thumb = $this->thumbnail
            ?? $this->tumbnail
            ?? $this->tumbnall
            ?? (is_array($this->image) ? ($this->image[0] ?? null) : $this->image);

        return $thumb ? Storage::url($thumb) : asset('default/Baner.png');
    }

    public function getFormattedDateAttribute(): ?string
    {
        if (!$this->create_date) return null;
        // jika sudah di-cast datetime, cukup:
        try { return $this->create_date->translatedFormat('d M Y'); } catch (\Throwable $e) { return null; }
    }

    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->description ?? ''), 100);
    }
}
