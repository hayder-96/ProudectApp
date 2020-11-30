<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('egister',[RegisterController::class,'Register']);
Route::post('logi',[RegisterController::class,'login']);




Route::middleware('auth:api')->group(function(){

    
    Route::resource('product',ProductController::class);
    

});










