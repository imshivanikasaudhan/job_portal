<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');





Route::group(['account'], function () {
    //Guest Route

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/account/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::post('/account/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/account/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
    });
    //Authenticated Routes

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::put('/account/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get('/account/logout', [AccountController::class, 'logout'])->name('account.logout');
        Route::post('/update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::get('/account/create-job', [AccountController::class, 'createJob'])->name('account.createJob');
    });
});
