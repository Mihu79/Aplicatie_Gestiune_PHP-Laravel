<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Models\Device;

Route::get('/device-label/{device}', function (Device $device) {
    return view('device-label.print', ['device' => $device]);
})->name('device.label');