<?php

namespace App\Filament\Resources\Devices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DeviceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                TextInput::make('room_id')
                    ->required()
                    ->numeric(),
                TextInput::make('brand')
                    ->required(),
                TextInput::make('model')
                    ->required(),
                TextInput::make('serial_number')
                    ->default(null),
                TextInput::make('inventory_number')
                    ->default(null),
                Select::make('status')
                    ->options([
            'disponibil' => 'Disponibil',
            'alocat' => 'Alocat',
            'service' => 'Service',
            'retras' => 'Retras',
        ])
                    ->default('disponibil')
                    ->required(),
                TextInput::make('allocated_user')
                    ->default(null),
            ]);
    }
}
