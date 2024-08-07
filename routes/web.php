<?php

use App\Livewire\AutoevalComponent;
use Illuminate\Support\Facades\Route;

Route::get('/{id}', AutoevalComponent::class);
