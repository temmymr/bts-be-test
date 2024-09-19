<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ListitemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();

    });

    Route::apiResource('checklist', ChecklistController::class);
    Route::get('checklist/{checklistId}/item', [ListitemController::class, 'index']);
    Route::post('checklist/{checklistId}/item', [ListitemController::class, 'store']);
    Route::get('checklist/{checklistId}/item/{checklistItemId}', [ListitemController::class, 'show']);
    Route::put('checklist/{checklistId}/item/{checklistItemId}', [ListitemController::class, 'update']);
    Route::delete('checklist/{checklistId}/item/{checklistItemId}', [ListitemController::class, 'destroy']);
    // Route::get('checklist/{checklistId}/item', [ListitemController::class, 'index']);
    Route::patch('checklist/{checklistId}/item/rename/{checklistItemId}', [ListitemController::class, 'update']);
});
