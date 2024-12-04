<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// TODO authentication kontrolu eklenecek toplantidan sonra
Route::post('/login', function (Request $request) {
    // $token = $request->user()->createToken($request->token_name);
 
    // return ['token' => $token->plainTextToken];
});

// TODO authentication kontrolu eklenecek toplantidan sonra
Route::prefix('v1')->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::get('/employees/{id}/tasks', [TaskController::class, 'getTasks']);
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{id}/complete', [TaskController::class, 'markComplete']);
});