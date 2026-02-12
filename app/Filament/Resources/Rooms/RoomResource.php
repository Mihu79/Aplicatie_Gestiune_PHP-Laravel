<?php

namespace App\Filament\Resources\Rooms;

use App\Filament\Resources\Rooms\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables; // <--- IMPORT GENERIC
use Filament\Tables\Table;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
{
    return $schema
        ->components([
            \Filament\Forms\Components\Select::make('headquarter_id')
                ->relationship('headquarter', 'name')
                ->required()
                ->label('Sediu'),
            \Filament\Forms\Components\TextInput::make('name')
                ->required()
                ->label('Nume Cameră'),
        ]);
}

public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
{
    return $table
        ->columns([
            \Filament\Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            \Filament\Tables\Columns\TextColumn::make('headquarter.name')->label('Sediu'),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}