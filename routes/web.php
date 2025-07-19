<?php


use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Course\CatalogController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Course\FavoriteController;
use App\Http\Controllers\Course\ItemCourseController;
use App\Http\Controllers\Course\EnrollmentController;
use App\Http\Controllers\Course\LessonController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\SupportController;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\isAdmin;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::post('/support', [SupportController::class, 'store'])->name('support.store');

Route::prefix('courses')->group(function () {
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/{prog_language}', [CatalogController::class, 'filter'])->name('catalog.filter');
    Route::get('/entry/{course}', [ItemCourseController::class, 'show'])->name('courses.show');

    Route::middleware(CheckAuth::class)->group(function () {
        Route::post('/{course}/enrollAndRedirect', [EnrollmentController::class, 'enrollAndRedirect'])->name('enrollment.enrollAndRedirect');
        Route::delete('/{course}/unenroll', [EnrollmentController::class, 'unenroll'])->name('enrollment.unenroll');
        Route::post('/{course}/favorite/toggle', [FavoriteController::class, 'toggle'])->name('courses.favorite.toggle');
    });
});

Route::prefix('lessons')->middleware(CheckAuth::class)->group(function () {
    Route::get('/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
    Route::post('/{lesson}/complete', [CourseController::class, 'markLessonAsCompleted'])->name('lessons.complete');
});

Route::prefix('auth')->group(function(){
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('register');
        Route::post('/register', 'store')->name('register.store');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'store')->name('login.store');

        Route::post('/logout', 'destroy')->name('logout');
    });
});

Route::controller(ProfileController::class)->prefix('user')->middleware(CheckAuth::class)->group(function () {
    Route::get('/profile', 'index')->name('profile');
});

Route::prefix('admin')->middleware(isAdmin::class)->group(function () {
    Route::get('admin', function () {
        return view('admin.admin');
    })->name('admin');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('/courses', AdminCourseController::class)->except(['show', 'edit', 'update']);

    Route::prefix('courses/{course}')->group(function () {
        Route::get('/lessons', [AdminLessonController::class, 'index'])->name('lessons.index');
        Route::get('/lessons-create', [AdminLessonController::class, 'create'])->name('lessons.create');
        Route::post('/lessons-create', [AdminLessonController::class, 'store'])->name('lessons.store');
        Route::delete('/lessons/{lesson}', [AdminLessonController::class, 'destroy'])->name('lessons.destroy');
    });
});
