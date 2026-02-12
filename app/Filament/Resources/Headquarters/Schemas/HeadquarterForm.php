<?php

namespace App\Filament\Resources\Headquarters\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HeadquarterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('address')
                    ->default(null),
            ]);
    }
}
