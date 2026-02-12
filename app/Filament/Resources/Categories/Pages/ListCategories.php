<?php

namespace App\Filament\Resources\Categories\CategoryResource\Pages; // <--- Aici s-a schimbat

use App\Filament\Resources\Categories\CategoryResource; // <--- Și aici
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}