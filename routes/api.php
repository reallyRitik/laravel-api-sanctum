<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/student', function(){
//     return 'my name is hritik singh';
// });
//PUBLIC ROUTE
// Route::get('/students', [StudentController::class, 'index']);
// Route::get('/students/{id}', [StudentController::class, 'show']);
// Route::post('/students', [StudentController::class, 'store']);
// Route::put('/students/{id}', [StudentController::class, 'update']);
// Route::delete('/students/{id}', [StudentController::class, 'destroy']);
// Route::get('/students/search/{city}', [StudentController::class, 'search']);

Route::post('/register', [UserController::class, 'register']);

//Protected Route

Route::middleware(['auth:sanctum'])->group (function(){
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
    Route::get('/students/search/{city}', [StudentController::class, 'search']);
    Route::post('/logout', [UserController::class, 'logout']);
});
