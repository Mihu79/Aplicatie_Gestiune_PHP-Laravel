<?php

namespace App\Filament\Resources\Headquarters\HeadquarterResource\Pages;

use App\Filament\Resources\Headquarters\HeadquarterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeadquarters extends ListRecords
{
    protected static string $resource = HeadquarterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}