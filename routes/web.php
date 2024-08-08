<?php

use App\Livewire\AutoevalComponent;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('prueba');
// });
Route::get('/{id}', AutoevalComponent::class);
