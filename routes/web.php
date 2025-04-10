<?php

use App\Http\Controllers\Libraries;
use Illuminate\Support\Facades\Route;

Route::get('/', [Libraries::class, 'index']);
Route::get('/create', [Libraries::class, 'create']);
Route::get('/libraries/{library}', [Libraries::class, 'edit']);

Route::post('/libraries', [Libraries::class, 'store']);

Route::put('/libraries/{library}', [Libraries::class, 'update']);

Route::delete('/libraries/{library}', [Libraries::class, 'delete']);

Route::get('/aggregate', [Libraries::class, 'aggregate']);
