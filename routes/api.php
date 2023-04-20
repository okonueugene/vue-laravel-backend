<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\StatusController;

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

Route::post('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);

Route::group([
    'middleware' => ['auth:api','ensure.json.header']
], function () {

    //user routes
    Route::put('user/update', [UserController::class, 'update']);
    Route::delete('user/delete', [UserController::class,'delete']);
    Route::get('user/profile', [UserController::class,'profile']);
    Route::get('user/logout', [UserController::class,'logout']);
    Route::get('user/getusers', [UserController::class,'getUsers']);

    //task routes
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/{task_id}', [TaskController::class, 'showTask']);
    Route::post('/tasks', [TaskController::class, 'addTask']);
    Route::put('/tasks/{task_id}', [TaskController::class, 'updateTask']);
    Route::delete('/tasks/{task_id}', [TaskController::class, 'destroyTask']);

    //status routes
    Route::get('/status', [StatusController::class, 'allStatus']);
    Route::get('/status/{status_id}', [StatusController::class, 'getSingleStatus']);
    Route::post('/status', [StatusController::class, 'addStatus']);
    Route::put('/status/{status_id}', [StatusController::class, 'updateStatus']);
    Route::delete('/status/{status_id}', [StatusController::class, 'destroyStatus']);


    // UserTasks routes
    Route::get('/user-tasks', [UserTasksController::class, 'userTasks']);
    Route::get('/user-tasks/{user_task_id}', [UserTasksController::class, 'showSingleUserTask']);
    Route::post('/user-tasks', [UserTasksController::class, 'addUserTask']);
    Route::put('/user-tasks/{user_task_id}', [UserTasksController::class, 'updateUserTask']);
    Route::delete('/user-tasks/{user_task_id}', [UserTasksController::class, 'destroyUserTask']);
    Route::get('/user-tasks/user/{user_id}', [UserTasksController::class, 'getUserTasksByUserId']);
    Route::get('/user-tasks/task/{task_id}', [UserTasksController::class, 'getUserTasksByTaskId']);
    Route::get('/user-tasks/status/{status_id}', [UserTasksController::class, 'getUserTasksByStatusId']);
    Route::put('/user-tasks/{user_task_id}/status/{status_id}', [UserTasksController::class, 'changeStatus']);

});
