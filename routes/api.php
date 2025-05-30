<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ApiController::class)->group(function () {
    Route::get('/projects', 'getProjects');
    Route::post('/projects', 'createProject');
    Route::get('/projects/{id}', 'getProjectDetails');
    Route::put('/projects/{id}', 'updateProject');
    Route::delete('/projects/{id}', 'deleteProject');
    Route::get('/tasks', 'getTasks');
    Route::post('/tasks', 'createTask');
    Route::get('/tasks/{id}', 'getTaskDetails');
    Route::put('/tasks/{id}', 'updateTask');
    Route::delete('/tasks/{id}', 'deleteTask');
});