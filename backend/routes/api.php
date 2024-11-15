<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\XmlController;

// Rutas para API Hello
Route::get('/hello', [HelloWorldController::class, 'index']);
Route::get('/hello/{filename}', [HelloWorldController::class, 'show']);
Route::post('/hello', [HelloWorldController::class, 'store']);
Route::put('/hello/{filename}', [HelloWorldController::class, 'update']);
Route::delete('/hello/{filename}', [HelloWorldController::class, 'destroy']);

// Rutas para API JSON
Route::get('/json', [JsonController::class, 'index']);
Route::get('/json/{filename}', [JsonController::class, 'show']);
Route::post('/json', [JsonController::class, 'store']);
Route::put('/json/{filename}', [JsonController::class, 'update']);
Route::delete('/json/{filename}', [JsonController::class, 'destroy']);

// Rutas para API CSV
Route::get('/csv', [CsvController::class, 'index']);
Route::get('/csv/{filename}', [CsvController::class, 'show']);
Route::post('/csv', [CsvController::class, 'store']);
Route::put('/csv/{filename}', [CsvController::class, 'update']);
Route::delete('/csv/{filename}', [CsvController::class, 'destroy']);

// Rutas para API XML
Route::get('/xml', [XmlController::class, 'index']);
Route::get('/xml/{filename}', [XmlController::class, 'show']);
Route::post('/xml', [XmlController::class, 'store']);
Route::put('/xml/{filename}', [XmlController::class, 'update']);
Route::delete('/xml/{filename}', [XmlController::class, 'destroy']);
