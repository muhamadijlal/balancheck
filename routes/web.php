<?php

use App\Http\Controllers\Select2Controller;
use App\Livewire\Login;
use App\Livewire\Pages\Qrcode;
use App\Livewire\Pages\Tarif;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/show-qr-code');

Route::middleware('guest')->group(function(){
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function(){
    Route::get('/show-qr-code', Qrcode::class)->name('show-qr-code');
    Route::get('/list-tarif', Tarif::class)->name('tarif');
    Route::post("/getCluster", [Select2Controller::class, 'selectCluster'])->name("selectCluster");
    Route::post("/getRuas", [Select2Controller::class, 'selectRuas'])->name("selectRuas");
    Route::post("/getGerbang", [Select2Controller::class, 'selectGerbang'])->name("selectGerbang");
});


