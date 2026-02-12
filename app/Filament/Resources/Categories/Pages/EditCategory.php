<?php

namespace App\Filament\Resources\Categories\CategoryResource\Pages; // <--- Actualizat

use App\Filament\Resources\Categories\CategoryResource; // <--- Actualizat
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}