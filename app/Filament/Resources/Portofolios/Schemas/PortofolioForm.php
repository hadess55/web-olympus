<?php

namespace App\Filament\Resources\Portofolios\Schemas;

use DateTime;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PortofolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
    ->columns(2)
    ->components([
        TextInput::make('name')
            ->label('Nama Project')
            ->required()
            ->columnSpan(1),

        TextInput::make('slug')
            ->label('Slug')
            ->placeholder('Contoh: sistem-informasi')
            ->required()
            ->columnSpan(1),

        CheckboxList::make('technologies')
            ->label('Technologies')
            ->options([
                'tailwind'   => 'Tailwind CSS',
                'bootstrap'  => 'Bootstrap',
                'alpine'     => 'Alpine.js',
                'react'      => 'React',
                'nextjs'     => 'Next.js',
                'flutter'    => 'Flutter',
                'wordpress'  => 'WordPress',
                'laravel'    => 'Laravel',
                'javascript'   => 'Java Script',
            ])
            ->columns(3)
            ->bulkToggleable()
            ->helperText('Pilih teknologi yang digunakan pada project ini')
            ->columnSpanFull(),

        Textarea::make('description')
            ->label('Deskripsi')
            ->required()
            ->autosize()
            ->columnSpan(2),

        DatePicker::make('create_date')
            ->label('Tanggal Buat')
            ->native(false)
            ->displayFormat('d M Y')
            ->closeOnDateSelection()
            ->columnSpan(1),

        FileUpload::make('tumbnail')
            ->label('Thumbnail')
            ->image()
            ->maxFiles(1)
            ->disk('public')
            ->directory('tumbnail')
            ->visibility('public')
            ->imageEditor()
            ->imageResizeMode('cover')
            ->imageResizeTargetWidth(768)
            ->imageResizeTargetHeight(480)
            ->rules([
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:ratio=16/10,min_width=700,min_height=440',
            ])
            ->columnSpan(1),

        FileUpload::make('image')
            ->label('Gambar Lainnya')
            ->image()
            ->multiple()
            ->maxParallelUploads(8)
            ->maxFiles(8)
            ->disk('public')
            ->directory('portofolio')
            ->visibility('public')
            ->imageEditor()
            ->columnSpan(2),
    ]);

    }
}