<?php

namespace App\Filament\Resources\Devices;

use App\Filament\Resources\Devices\DeviceResource\Pages;
use App\Models\Device;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables; // <--- IMPORT GENERIC
use Filament\Tables\Table;

class DeviceResource extends Resource
{
    protected static ?string $model = Device::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-computer-desktop';

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
{
    return $schema
        ->components([
            // Punem câmpurile direct, fără Section
            \Filament\Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->required()
                ->label('Categorie'),

            \Filament\Forms\Components\Select::make('room_id')
                ->relationship('room', 'name')
                ->required()
                ->label('Cameră / Locație'),

            \Filament\Forms\Components\TextInput::make('brand')
                ->required()
                ->label('Marcă'),

            \Filament\Forms\Components\TextInput::make('model')
                ->required()
                ->label('Model'),

            \Filament\Forms\Components\TextInput::make('inventory_number')
                ->label('Număr Inventar (Generat Automat)')
                ->placeholder('Va fi generat la salvare...')
                ->readOnly() // Utilizatorul nu poate scrie aici
                ->helperText('Acest număr este generat conform regulii: FIRMA-CATEGORIE-NUMAR'),

            \Filament\Forms\Components\Select::make('status')
                ->options([
                    'disponibil' => 'Disponibil',
                    'alocat' => 'Alocat',
                    'service' => 'Service',
                ])
                ->default('disponibil')
                ->required()
                ->label('Status'),

            \Filament\Forms\Components\TextInput::make('allocated_user')
                ->label('Utilizator Alocat'),
        ]);
}

public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
{
    return $table
        ->columns([
            \Filament\Tables\Columns\TextColumn::make('brand')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('model')->searchable(),
            \Filament\Tables\Columns\TextColumn::make('inventory_number')->label('Inv #'),
            \Filament\Tables\Columns\TextColumn::make('status')->badge() // Transformă textul într-o etichetă rotunjită
        ->color(fn (string $state): string => match ($state) {
            'alocat' => 'warning', // Galben
            'disponibil' => 'success',     // Verde
            'service' => 'danger',     // Roșu
        })
        ->label('Status'),
        ])
        ->filters([
            // 1. Filtru după STATUS
            \Filament\Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'disponibil' => 'Disponibil',
                    'alocat' => 'Alocat',
                    'service' => 'Service',
                    
                ]),

            // 2. Filtru după CATEGORIE
            \Filament\Tables\Filters\SelectFilter::make('category_id')
                ->label('Categorie')
                ->relationship('category', 'name'),

            // 3. Filtru după CAMERĂ
            \Filament\Tables\Filters\SelectFilter::make('room_id')
                ->label('Cameră')
                ->relationship('room', 'name')
                ->searchable()
                ->preload(),

            // 4. Filtru după SEDIU (Mai complex, deoarece trece prin Cameră)
            \Filament\Tables\Filters\SelectFilter::make('sediu')
                ->label('Sediu')
                ->form([
                    \Filament\Forms\Components\Select::make('headquarter_id')
                        ->label('Sediu')
                        ->options(\App\Models\Headquarter::pluck('name', 'id'))
                ])
                ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data) {
                    if (!empty($data['headquarter_id'])) {
                        // Caută dispozitivele care se află într-o cameră legată de sediul selectat
                        $query->whereHas('room', function ($q) use ($data) {
                            $q->where('headquarter_id', $data['headquarter_id']);
                        });
                    }
                }),
        ])
        ->actions([
            \Filament\Actions\Action::make('printLabel')
        ->label('Etichetă')
        ->icon('heroicon-o-printer')
        ->color('success')
        ->url(fn (Device $record): string => route('device.label', $record))
        ->openUrlInNewTab(),
        
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
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevice::route('/create'),
            'edit' => Pages\EditDevice::route('/{record}/edit'),
        ];
    }
}