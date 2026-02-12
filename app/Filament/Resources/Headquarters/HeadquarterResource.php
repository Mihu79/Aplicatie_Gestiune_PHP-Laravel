<?php

namespace App\Filament\Resources\Headquarters;

use App\Filament\Resources\Headquarters\HeadquarterResource\Pages;
use App\Models\Headquarter;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables; // <--- IMPORT GENERIC
use Filament\Tables\Table;

class HeadquarterResource extends Resource
{
    protected static ?string $model = Headquarter::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office';

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
{
    return $schema
        ->components([
            \Filament\Forms\Components\TextInput::make('name')
                ->required()
                ->label('Nume Sediu'),
            \Filament\Forms\Components\TextInput::make('address')
                ->label('Adresă'),
        ]);
}

public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
{
    return $table
        ->columns([
            \Filament\Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            \Filament\Tables\Columns\TextColumn::make('address'),
        ])
        ->actions([
            \Filament\Actions\EditAction::make(),
        ])
        ->bulkActions([
            \Filament\Actions\DeleteBulkAction::make(),
        ]);
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
            'index' => Pages\ListHeadquarters::route('/'),
            'create' => Pages\CreateHeadquarter::route('/create'),
            'edit' => Pages\EditHeadquarter::route('/{record}/edit'),
        ];
    }
}