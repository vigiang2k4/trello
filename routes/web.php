<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

// Các route cho Account
Route::controller(AccountController::class)->group(function () {
    // Đăng ký
    Route::get('register', 'register')->name('register');
    Route::post('register', 'register_')->name('register_');
    // Đăng nhập
    Route::get('login', 'login')->name('login');
    Route::post('login', 'login_')->name('login_');
    // Cập nhật tài khoản
    Route::get('user/edit', 'edit')->name('edit');
    Route::post('user/update', 'update')->name('update');
    // Quên mật khẩu
    Route::get('password/forgot', 'forgot')->name('forgot');
    Route::post('password/forgot', 'forgot_')->name('forgot_');
    // Đặt lại mật khẩu sau khi send mail
    Route::get('password/reset/{token}', 'password')->name('password');
    Route::post('password/reset', 'password_')->name('password_');

    // Đăng xuất
    Route::post('logout', 'logout')->name('logout');
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
