<?php

use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::prefix('dashboard')->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/users/{user}/change-status',[UserController::class, 'changeStatus'])->name('user.change_status');
    Route::post('/users/{user}/change-role',[UserController::class, 'changeRole'])->name('user.change_role');
});