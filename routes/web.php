<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperheroController;


Route::get('/', function () {
    return view('welcome');
});


//Superheroes
Route::group(['prefix' => 'superheroes'] ,function () {
   Route::get('/all',[App\Http\Controllers\SuperheroController::class,'all'] );
});
