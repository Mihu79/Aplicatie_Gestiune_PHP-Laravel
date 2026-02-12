<?php

namespace App\Filament\Resources\Headquarters\HeadquarterResource\Pages;

use App\Filament\Resources\Headquarters\HeadquarterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeadquarter extends EditRecord
{
    protected static string $resource = HeadquarterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}