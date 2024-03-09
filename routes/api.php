<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['db-transaction'], 'namespace' => 'App\\Http\\Controllers\\API', 'as' => 'api.'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::get('user', 'AuthController@user')->middleware('auth:sanctum');
    });

    Route::group(['middleware' => ['auth:sanctum', 'user-scope']], function () {

        Route::group(['prefix' => 'files', 'as' => 'files.'], function () {
            Route::post('upload', 'FilesController@upload')->name('upload');
        });

        Route::resource('notes', 'NotesController');
        Route::resource('tasks', 'TasksController');
    });
});
