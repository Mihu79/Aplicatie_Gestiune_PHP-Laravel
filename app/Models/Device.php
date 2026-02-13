<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($device) {
            // 1. Luăm categoria din care face parte dispozitivul
            $category = Category::find($device->category_id);
            
            // 2. Definim prefixul firmei 
            $prefixFirma = 'GTN'; 
            
            // 3. Luăm prefixul categoriei (ex: NB, PR) definit la crearea categoriei
            $prefixCat = $category->prefix ?? 'XX';
            
            // 4. Calculăm numărul incremental pentru ACEASTĂ categorie
            // Numărăm câte dispozitive există deja în această categorie și adunăm 1
            $nextNumber = Device::where('category_id', $device->category_id)->count() + 1;
            
            // 5. Formatăm numărul să aibă 4 cifre (ex: 0001)
            $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            
            // 6. Asamblăm numărul final de inventar conform cerinței
            $device->inventory_number = "{$prefixFirma}-{$prefixCat}-{$formattedNumber}";
        });

        static::saving(function ($device) {
        // Cazul A: Dacă ai scris un utilizator, statusul devine automat 'alocat'
        if (!empty($device->allocated_user)) {
            $device->status = 'alocat';
        } 
        // Cazul B: Dacă NU ai utilizator (câmpul e gol)
        else {
            // Modificăm statusul în 'disponibil' DOAR dacă era 'alocat' înainte.
            // Dacă tu ai selectat manual 'service', sistemul NU se mai atinge de el.
            if ($device->status === 'alocat') {
                $device->status = 'disponibil';
            }
        }
    });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}