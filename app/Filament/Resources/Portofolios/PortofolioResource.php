<?php

namespace App\Filament\Resources\Portofolios;

use App\Filament\Resources\Portofolios\Pages\CreatePortofolio;
use App\Filament\Resources\Portofolios\Pages\EditPortofolio;
use App\Filament\Resources\Portofolios\Pages\ListPortofolios;
use App\Filament\Resources\Portofolios\Schemas\PortofolioForm;
use App\Filament\Resources\Portofolios\Tables\PortofoliosTable;
use App\Models\Portofolio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PortofolioResource extends Resource
{
    protected static ?string $model = Portofolio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Portofolio';

    public static function form(Schema $schema): Schema
    {
        return PortofolioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortofoliosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPortofolios::route('/'),
            'create' => CreatePortofolio::route('/create'),
            'edit' => EditPortofolio::route('/{record}/edit'),
        ];
    }
}
