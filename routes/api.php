<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Middleware\JwtMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); 

Route::prefix('/buku')
    ->middleware([JwtMiddleware::class])
    ->group(function(){
    Route::get('/',[BukuController::class,'index'])->name('buku.index');
    Route::post('/simpan',[BukuController::class,'store'])->name('buku.simpan');
    Route::put('/simpan/{id}', [BukuController::class, 'update'])->name('buku.Rest.Update');
    Route::get('/simpan/{id}', [BukuController::class,'show']);
    Route::delete('/hapus/{id}', [BukuController::class, 'destroy']);
});

Route::prefix('/auth')->group(function() {
   //http://localhost:8000/api/auth/login method post
   Route::post('/login', [AuthController::class,'login'])->name('api.auth.login');
});