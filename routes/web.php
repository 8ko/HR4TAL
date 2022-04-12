<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequirementController;
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
    
    Route::post('requirement/store/{employee_id}', [RequirementController::class, 'store'])->name('admin.requirement.store');
    Route::post('requirement/destroy/{employee_id}', [RequirementController::class, 'destroy'])->name('admin.requirement.destroy');

    Route::post('profile/avatar/upload/{employee_id}', [ProfileController::class, 'uploadAvatar'])->name('admin.profile.avatar.upload');
    Route::post('profile/comment/save/{employee_id}', [ProfileController::class, 'saveComment'])->name('admin.profile.comment.save');

    Route::resource('accounts', AccountController::class, ['as' => 'admin']);
    Route::resource('profile', ProfileController::class, ['as' => 'admin'])->only(['show', 'update']);
});

Route::group(['prefix' => 'engr','middleware' => ['role:engr']], function() {
    Route::get('timein', [LogController::class, 'timein'])->name('engr.timein');
    Route::get('timeout', [LogController::class, 'timeout'])->name('engr.timeout');

    Route::post('requirement/store/{employee_id}', [RequirementController::class, 'store'])->name('engr.requirement.store');
    
    Route::resource('accounts', AccountController::class, ['as' => 'engr']);
    Route::resource('profile', ProfileController::class, ['as' => 'engr'])->only(['show']);
});

Route::group(['prefix' => 'hr','middleware' => ['role:hr']], function() {
    Route::get('logs', [LogController::class, 'index'])->name('hr.logs');
    Route::get('timein', [LogController::class, 'timein'])->name('hr.timein');
    Route::get('timeout', [LogController::class, 'timeout'])->name('hr.timeout');

    Route::post('requirement/store/{employee_id}', [RequirementController::class, 'store'])->name('hr.requirement.store');
    Route::post('profile/avatar/upload/{employee_id}', [ProfileController::class, 'uploadAvatar'])->name('hr.profile.avatar.upload');
    Route::post('profile/comment/save/{employee_id}', [ProfileController::class, 'saveComment'])->name('hr.profile.comment.save');

    Route::resource('profile', ProfileController::class, ['as' => 'hr'])->only(['show', 'update']);
});

Route::group(['prefix' => 'user','middleware' => ['role:user']], function() {
    Route::get('timein', [LogController::class, 'timein'])->name('user.timein');
    Route::get('timeout', [LogController::class, 'timeout'])->name('user.timeout');
    
    Route::post('requirement/store/{employee_id}', [RequirementController::class, 'store'])->name('user.requirement.store');

    Route::resource('profile', ProfileController::class, ['as' => 'user'])->only(['show']);
});

Auth::routes();
