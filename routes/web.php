<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogHeartController;
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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentHeartController;
use App\Http\Controllers\MyBlogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReportCommentController;
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
});

Route::controller(MyBlogController::class)->name('myblog.')->group(function () {
	Route::middleware(['auth'])->group(function () {
		Route::get('/myblog/active', 'indexActive')->name('active');
		Route::get('/myblog/inactive', 'indexInactive')->name('inactive');
		Route::get('/myblog/create', 'create')->name('create');
		Route::post('/myblog/store', 'store')->name('store');
		Route::get('/myblog/edit/{blog}', 'edit')->name('edit');
		Route::post('/myblog/update/{blog}', 'update')->name('update');
		Route::delete('/myblog/delete/{blog}', 'destroy')->name('delete');
		Route::get('/myblog/delete-blog', 'deleteBlog')->name('delete-blog');
		Route::post('/myblog/restore/{blog}', 'restore')->name('restore');
		Route::post('/myblog/restore-all', 'restoreAll')->name('restore-all');
		Route::delete('/myblog/force-delete/{blog}', 'forceDelete')->name('force-delete');
	});
});

Route::controller(BlogController::class)->name('blog.')->group(function () {
	Route::get('/blog/all-blog', 'index')->name('index');
	Route::get('/blog/{blog}', 'show')->name('show');
	Route::middleware(['auth'])->group(function () {
		Route::middleware(['admin'])->group(function () {
			Route::get('/blog-management/active', 'indexActive')->name('active');
			Route::get('/blog-management/inactive', 'indexInactive')->name('inactive');
			Route::get('/blog-management/approved-management/{blog}', 'showCheckApproved')->name('show-check-approved');
			Route::put('/blog-management/approved-management/{blog}/update-status', 'updateStatus')->name('update-status');
			Route::delete('/blog-management/delete/{blog}', 'destroy')->name('delete');
			Route::get('/blog-management/delete-blog', 'deleteBlog')->name('delete-blog');
			Route::post('/blog-management/restore/{blog}', 'restore')->name('restore');
			Route::post('/blog-management/restore-all', 'restoreAll')->name('restore-all');
			Route::delete('/blog-management/force-delete/{blog}', 'forceDelete')->name('force-delete');
		});
	});
});

Route::controller(BlogHeartController::class)->name('postheart.')->middleware(['auth'])->group(function () {
	Route::put('/blog/heart/{blog}/{user}', 'heart')->name('update');
});

Route::controller(CommentHeartController::class)->name('commentheart.')->middleware(['auth'])->group(function () {
	Route::put('/comment/heart/{comment}/{user}', 'heart')->name('update');
});

Route::controller(CommentController::class)->name('comment.')->middleware(['auth'])->group(function () {
	Route::post('/comment/{blog}/store', 'store')->name('store');
	Route::put('/comment/update/{comment}', 'update')->name('update');
	Route::delete('/comment/delete/{comment}', 'destroy')->name('delete');
});

Route::controller(ReportCommentController::class)->name('report-comment.')->middleware(['auth'])->group(function () {
	Route::middleware(['admin'])->group(function () {
		Route::get('/reportcomment/index', 'index')->name('index');
	});
	Route::post('/reportcomment/{comment}/store', 'store')->name('store');
});

Route::controller(NewsController::class)->name('news.')->group(function () {
	Route::get('/news/all-news', 'index')->name('index');
	Route::get('/news/{new}', 'show')->name('show');
	Route::middleware(['auth','admin'])->group(function () {
		Route::get('/news-management/all', 'management')->name('management');
		Route::get('/news-management/create', 'create')->name('create');
		Route::post('/news-management/store', 'store')->name('store');
		Route::get('/news-management/edit/{new}', 'edit')->name('edit');
		Route::post('/news-management/update/{new}', 'update')->name('update');
		Route::delete('/news-management/delete/{new}', 'destroy')->name('delete');
		Route::get('/news-management/delete-new', 'deleteNew')->name('delete-new');
		Route::post('/news-management/restore/{new}', 'restore')->name('restore');
		Route::post('/news-management/restore-all', 'restoreAll')->name('restore-all');
		Route::delete('/news-management/force-delete/{new}', 'forceDelete')->name('force-delete');
	});
});
