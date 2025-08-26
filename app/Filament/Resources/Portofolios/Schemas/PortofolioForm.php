<?php

namespace App\Filament\Resources\Portofolios\Schemas;

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
                    ->required(),
                Textarea::make('description')
                    ->autosize(),
                FileUpload::make('image')
                    ->multiple()
                    ->maxParallelUploads(6)
            ]);
    }
}