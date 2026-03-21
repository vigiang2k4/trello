<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

// Các route cho Account
Route::controller(AccountController::class)->group(function () {

    Route::get('register', 'register')->name('register');
    Route::post('register', 'register_')->name('register_');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'login_')->name('login_');

    Route::post('logout', 'logout')->name('logout');


    Route::get('user/edit', 'edit')->name('edit');
    Route::post('user/update', 'update')->name('update');

    Route::get('password/forgot', 'forgot')->name('forgot');
    Route::post('password/forgot', 'forgot_')->name('forgot_');

    Route::get('password/reset/{token}', 'password')->name('password');
    Route::post('password/reset', 'password_')->name('password_');
});

Route::controller(WorkspaceController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('workspaces/create', 'create')->name('workspaces.create');
    Route::post('workspaces', 'store')->name('workspaces.store');
    Route::get('workspaces/{workspace}', 'show')->name('workspaces.show');
    Route::get('workspaces/{workspace}/edit', 'edit')->name('workspaces.edit');
    Route::put('workspaces/{workspace}', 'update')->name('workspaces.update');
    Route::delete('workspaces/{workspace}', 'destroy')->name('workspaces.destroy');
});

Route::controller(BoardController::class)->group(function () {
    Route::post('boards', 'store')->name('boards.store');
    Route::get('boards/{board}', 'show')->name('boards.show');
    Route::get('boards/{board}/edit', 'edit')->name('boards.edit');
    Route::put('boards/{board}', 'update')->name('boards.update');
    Route::delete('boards/{board}', 'destroy')->name('boards.destroy');
});

Route::controller(TaskController::class)->group(function () {
    Route::post('tasks', 'store')->name('tasks.store');
    Route::get('tasks/{task}', 'show')->name('tasks.show');
    Route::get('tasks/{task}/edit', 'edit')->name('tasks.edit');
    Route::put('tasks/{task}', 'update')->name('tasks.update');
    Route::delete('tasks/{task}', 'destroy')->name('tasks.destroy');
});
