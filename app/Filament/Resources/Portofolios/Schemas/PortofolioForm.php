<?php

namespace App\Filament\Resources\Portofolios\Schemas;

use DateTime;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PortofolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Project')
                    ->required(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->autosize(),
                DatePicker::make('create_date')
                    ->label('Tanggal Buat')
                    ->native(false)
                    ->format('d/m/y'),
                FileUpload::make('tumbnail')
                    ->label('Tumbnail')
                    ->image()
                    ->maxFiles(1) 
                    ->disk('public')              
                    ->directory('tumbnail')   
                    ->visibility('public'),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->multiple()
                    ->maxParallelUploads(6)
                    ->maxFiles(6) 
                    ->disk('public')              
                    ->directory('portofolio')   
                    ->visibility('public')
            ]);
    }
}