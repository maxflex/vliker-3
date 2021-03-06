<?php

use Illuminate\Http\Request;

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

Route::namespace('Api\v1')->prefix('v1')->group(function() {
    Route::prefix('tasks')->group(function() {
        Route::post('next', 'TasksController@next');
    });

    Route::apiResources([
        'tasks' => 'TasksController',
        'users' => 'UsersController',
    ]);

    Route::post('reports', 'ReportsController@store');
});
