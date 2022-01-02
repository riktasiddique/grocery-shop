<?php

use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('admin.dashboard');
});


require __DIR__.'/auth.php';
Route::prefix('dashboard')->middleware('auth','check_status', 'admin' )->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'check_status'])->name('dashboard');
    // UsersController
    Route::resource('users', UserController::class);
    Route::get('/users/{user}/change-status',[UserController::class, 'changeStatus'])->name('user.change_status')->middleware('admin', 'check_status');
    Route::post('/users/{user}/change-role',[UserController::class, 'changeRole'])->name('user.change_role')->middleware('admin', 'check_status');
});