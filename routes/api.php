<?php

use App\Http\Controllers\Api\JwtAuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::group(['prefix' => 'auth'], function(){    
    Route::post('signup', [JwtAuthController::class, 'register']);
});