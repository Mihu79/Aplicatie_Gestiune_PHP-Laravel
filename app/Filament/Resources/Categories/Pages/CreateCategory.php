<?php

namespace App\Filament\Resources\Categories\CategoryResource\Pages; // <--- Actualizat

use App\Filament\Resources\Categories\CategoryResource; // <--- Actualizat
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}