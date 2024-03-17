<?php

use Sienekib\Alquimist\Routing\Route;


Route::middleware('web:auth', function() {
	Route::get('/user/{id}/dados', [App\Http\Controllers\AppController::class, 'index']);
});

Route::get('/', [App\Http\Controllers\AppController::class, 'index']);