<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogHeartController;
use App\Http\Controllers\CalendarController;
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
use App\Http\Controllers\ClassAnnouncementController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentHeartController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonDetailController;
use App\Http\Controllers\MyBlogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportCommentController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\UserController;
use App\Models\ClassAnnouncement;
use App\Models\TeacherAttendance;

//HomePage
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/periodic-table', [HomeController::class, 'periodicTable'])->name('home.periodic-table');

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
		Route::delete('/reportcomment/delete/{reportcomment}', 'destroy')->name('delete');
	});
	Route::post('/reportcomment/{comment}/store', 'store')->name('store');
});

Route::controller(NewsController::class)->name('news.')->group(function () {
	Route::get('/news/all-news', 'index')->name('index');
	Route::get('/news/{new}', 'show')->name('show');
	Route::middleware(['auth', 'admin'])->group(function () {
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

Route::controller(ClassController::class)->name('class.')->middleware('auth')->group(function () {
	Route::get('/class-management/all', 'management')->name('management');
	Route::get('/class-management/show/{class}', 'show')->name('show');
	Route::middleware(['auth', 'admin'])->group(function () {
		Route::get('/class-management/create/step-one', 'createStepOne')->name('create-step-one');
		Route::post('/class-management/store/step-one', 'storeStepOne')->name('store-step-one');
		Route::get('/class-management/create/step-two', 'createStepTwo')->name('create-step-two');
		Route::post('/class-management/store/step-two', 'storeStepTwo')->name('store-step-two');
		Route::get('/class-management/create/{class}/addStudent', 'addStudent')->name('add-student');
		Route::post('/class-management/create/{class}/addStudent', 'storeStudent')->name('store-student');
		Route::get('/class-management/create/{class}/addCalendar', 'addCalendar')->name('add-calendar');
		Route::post('/class-management/create/{class}/addCalendar', 'storeCalendar')->name('store-calendar');
		Route::get('/class-management/edit-teacher/{class}', 'editTeacher')->name('edit-teacher');
		Route::post('/class-management/update-teacher/{class}', 'updateTeacher')->name('update-teacher');
		Route::post('/class-management/update/{class}', 'update')->name('update');
		Route::delete('/class-management/delete/{class}', 'destroy')->name('delete');
		Route::get('/class-management/delete-class', 'deleteClass')->name('delete-class');
		Route::post('/class-management/restore/{class}', 'restore')->name('restore');
		Route::post('/class-management/restore-all', 'restoreAll')->name('restore-all');
		Route::delete('/class-management/force-delete/{class}', 'forceDelete')->name('force-delete');
	});
	Route::middleware(['auth'])->withoutMiddleware(['student'])->group(function () {
		Route::get('/class-management/show/{class}/show-attendance', 'showAttendance')->name('show-attendance');
		Route::get('/class-management/show/{class}/show-grade', 'showGrade')->name('show-grade');
	});
});

Route::controller(CalendarController::class)->name('calendar.')->middleware(['auth'])->group(function () {
	Route::get('/calendar-management/all', 'management')->name('management');
	Route::middleware(['auth', 'admin'])->group(function () {
		Route::get('/calendar-management/create', 'create')->name('create');
		Route::post('/calendar-management/create', 'store')->name('store');
	});
});

Route::controller(LessonController::class)->name('lesson.')->group(function () {
	Route::middleware(['auth'])->withoutMiddleware(['student'])->group(function () {
		Route::post('/lesson-management/{class}/create', 'store')->name('store');
		Route::get('/lesson-management/{class}/edit/{lesson}', 'edit')->name('edit');
		Route::post('/lesson-management/update/{lesson}', 'update')->name('update');
		Route::delete('/lesson-management/delete/{lesson}', 'destroy')->name('delete');
		Route::post('/lesson-management/{class}/add-exam/{lesson}', 'storeExam')->name('store-exam');
		Route::delete('/lesson-management/delete-exam/{lesson}/{exam}', 'destroyExam')->name('delete-exam');
	});
});

Route::controller(LessonDetailController::class)->name('lessondetail.')->group(function () {
	Route::middleware(['auth'])->withoutMiddleware(['student'])->group(function () {
		Route::post('/lesson-detail-management/{class}/{lesson}/create', 'store')->name('store');
		Route::delete('/lesson-detail-management/delete/{lesson_detail}', 'destroy')->name('delete');
		Route::get('/lesson-detail-management/{class}/create-attendance/{lesson}', 'addAttendance')->name('add-attendance');
		Route::post('/lesson-detail-management/{class}/create-attendance/{lesson}', 'storeAttendance')->name('store-attendance');
	});
	Route::middleware(['auth'])->group(function () {
		Route::get('/lesson-detail-management/{class}/{lesson}/{lesson_detail}', 'download')->name('download');
	});
});

Route::controller(PaymentController::class)->name('payment.')->group(function () {
	Route::middleware(['auth'])->withoutMiddleware(['teacher'])->group(function () {
		Route::get('/payment-management/student/{user}', 'showStudent')->name('show-student');
		Route::get('/payment/billing', 'billing')->name('billing');
	});
	Route::middleware(['auth'])->withoutMiddleware(['student'])->group(function () {
		Route::get('/payment-management/teacher/{user}', 'showTeacher')->name('show-teacher');
	});
	Route::middleware(['auth', 'admin'])->group(function () {
		Route::get('/payment-management/admin', 'managementAdmin')->name('management-admin');
		Route::get('/payment-management/admin/generate-pdf/{dateMonth}/{dateYear}', 'generatePdfAdmin')->name('generate-pdf-admin');
		Route::get('/payment-management/student', 'managementStudent')->name('management-student');
		Route::get('/payment-management/teacher', 'managementTeacher')->name('management-teacher');
		Route::put('/payment-management/student/{user}/update-status/{dateMonth}/{dateYear}', 'studentUpdateStatus')->name('student-update-status');
		Route::put('/payment-management/teacher/{user}/update-status/{dateMonth}/{dateYear}', 'teacherUpdateStatus')->name('teacher-update-status');
		Route::post('/payment-management/admin/store/{dateMonth}/{dateYear}', 'store')->name('store');
		Route::post('/payment-management/admin/update/{payment}', 'update')->name('update');
		Route::delete('/payment-management/admin/delete/{payment}', 'destroy')->name('delete');
	});
});

Route::controller(ClassAnnouncementController::class)->name('announcement.')->group(function () {
	Route::middleware(['auth'])->withoutMiddleware(['student'])->group(function () {
		Route::post('/announcement-management/{class}/create', 'store')->name('store');
		Route::put('/announcement-management/update/{announcement}', 'update')->name('update');
		Route::delete('/announcement-management/delete/{announcement}/{class}', 'destroy')->name('delete');
	});
});

Route::controller(ExamController::class)->name('exam.')->group(function () {
	Route::middleware(['auth', 'admin'])->group(function () {
		Route::get('/exam-management/all', 'management')->name('management');
		Route::post('/exam-management/store', 'store')->name('store');
		Route::get('/exam-management/{exam}/addQuestion', 'addQuestion')->name('add-question');
		Route::post('/exam-management/{exam}/storeQuestion', 'storeQuestion')->name('store-question');
		Route::post('/exam-management/update/{exam}', 'update')->name('update');
		Route::delete('/exam-management/delete/{exam}', 'destroy')->name('delete');
	});
	Route::middleware(['auth'])->group(function () {
		Route::get('/exam/{exam}/{lesson}/warning', 'warningExam')->name('warning-exam');
		Route::get('/exam/{exam}/{lesson}', 'doExam')->name('do-exam');
		Route::get('/exam/{exam}/{lesson}/result', 'resultExam')->name('result-exam');
	});
});

Route::controller(GradeController::class)->name('grade.')->group(function () {
	Route::middleware(['auth'])->group(function () {
		Route::post('/grade-management/store-grade/{exam}/{user}/{lesson}', 'storeGrade')->name('store-grade');
	});
	Route::middleware(['auth','admin'])->group(function () {
		Route::get('/grade-management/index', 'index')->name('index');
		Route::get('/grade-management/show/{user}', 'show')->name('show');
	});
	Route::middleware(['auth'])->withoutMiddleware(['teacher'])->group(function () {
		Route::get('/grade-management/my-grade', 'myGrade')->name('my-grade');
	});
});

Route::controller(TeacherAttendanceController::class)->name('teacher-attendance.')->group(function () {
	Route::middleware(['auth','admin'])->group(function () {
		Route::post('/teacher-attendance-management/store/{class}/{lesson}/{user}', 'store')->name('store');
	});
});
