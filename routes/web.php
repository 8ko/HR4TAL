<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AppController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','middleware' => ['role:admin']], function() {
    Route::get('logs', [LogController::class, 'index'])->name('admin.logs');
    Route::get('timein', [LogController::class, 'timein'])->name('admin.timein');
    Route::get('timeout', [LogController::class, 'timeout'])->name('admin.timeout');

    Route::get('accounts', [AccountController::class, 'accounts'])->name('admin.accounts');
    Route::get('create', [AccountController::class, 'create'])->name('admin.create');
    
    Route::get('{employee_id}', [AccountController::class, 'index'])->name('admin.profile');
    Route::patch('{employee_id}', [AccountController::class, 'update'])->name('admin.profile.update');
    Route::post('{employee_id}/avatar', [AccountController::class, 'uploadAvatar'])->name('admin.profile.avatar');

    Route::post('{employee_id}/requirements', [AccountController::class, 'uploadRequirement'])->name('admin.requirement.upload');
    Route::get('{employee_id}/view/requirement', [AccountController::class, 'viewRequirement'])->name('admin.view.requirement');
    Route::post('{employee_id}/delete/requirement', [AccountController::class, 'deleteRequirement'])->name('admin.delete.requirement');
    Route::post('{employee_id}/comment/save', [AccountController::class, 'saveComment'])->name('admin.comment.save');
});

Route::group(['prefix' => 'engr','middleware' => ['role:engr']], function() {
    Route::get('timein', [LogController::class, 'timein'])->name('engr.timein');
    Route::get('timeout', [LogController::class, 'timeout'])->name('engr.timeout');
    
    Route::get('{employee_id}', [AccountController::class, 'index'])->name('engr.profile');

    Route::post('{employee_id}/requirements', [AccountController::class, 'uploadRequirement'])->name('engr.requirement.upload');
    Route::get('{employee_id}/view/requirement', [AccountController::class, 'viewRequirement'])->name('engr.view.requirement');
});

Route::group(['prefix' => 'hr','middleware' => ['role:hr']], function() {
    Route::get('logs', [LogController::class, 'index'])->name('hr.logs');
    Route::get('timein', [LogController::class, 'timein'])->name('hr.timein');
    Route::get('timeout', [LogController::class, 'timeout'])->name('hr.timeout');
    
    Route::get('{employee_id}', [AccountController::class, 'index'])->name('hr.profile');
    Route::patch('{employee_id}', [AccountController::class, 'update'])->name('hr.profile.update');
    Route::post('{employee_id}/avatar', [AccountController::class, 'uploadAvatar'])->name('hr.profile.avatar');

    Route::post('{employee_id}/requirements', [AccountController::class, 'uploadRequirement'])->name('hr.requirement.upload');
    Route::get('{employee_id}/view/requirement', [AccountController::class, 'viewRequirement'])->name('hr.view.requirement');
    Route::post('{employee_id}/comment/save', [AccountController::class, 'saveComment'])->name('hr.comment.save');
});

Route::group(['prefix' => 'user','middleware' => ['role:user']], function() {
    Route::get('timein', [LogController::class, 'timein'])->name('user.timein');
    Route::get('timeout', [LogController::class, 'timeout'])->name('user.timeout');
    
    Route::get('{employee_id}', [AccountController::class, 'index'])->name('user.profile');

    Route::post('{employee_id}/requirements', [AccountController::class, 'uploadRequirement'])->name('user.requirement.upload');
    Route::get('{employee_id}/view/requirement', [AccountController::class, 'viewRequirement'])->name('user.view.requirement');
});

Auth::routes();

