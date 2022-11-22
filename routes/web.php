<?php

use Illuminate\Support\Facades\Auth;
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
	return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\UserController;

//HomePage
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/myprofile', [UserProfileController::class, 'show'])->name('myprofile');
	Route::post('/myprofile', [UserProfileController::class, 'update'])->name('myprofile.update');
	Route::put('/myprofile/update-password', [UserProfileController::class, 'updatePassword'])->name('myprofile.update_password');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::controller(UserController::class)->name('user.')->group(function () {
	Route::middleware(['auth', 'admin'])->group(function () {
		Route::get('/user-management/admin', 'indexAdmin')->name('admin');
		Route::get('/user-management/teacher', 'indexTeacher')->name('teacher');
		Route::get('/user-management/student', 'indexStudent')->name('student');
		Route::get('/user-management/create', 'create')->name('create');
		Route::get('/user-management/edit/{user}', 'edit')->name('edit');
		Route::post('/user-management/store', 'store')->name('store');
		Route::put('/user-management/update/{user}', 'update')->name('update');
		Route::delete('/user-management/delete/{user}', 'destroy')->name('delete');
		Route::put('/user-management/update-password/{user}', 'updatePassword')->name('update_password');
		Route::get('/user-management/delete-account', 'deleteAccount')->name('delete-account');
		Route::post('/user-management/restore/{user}', 'restore')->name('restore');
		Route::post('/user-management/restore-all', 'restoreAll')->name('restore-all');
		Route::delete('/user-management/force-delete/{user}', 'forceDelete')->name('force-delete');
	});
});;
