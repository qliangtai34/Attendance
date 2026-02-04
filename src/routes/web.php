<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Admin\CorrectionController;
use App\Http\Controllers\Auth\RegisterController;

// 新規登録（自作）
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


/*
|--------------------------------------------------------------------------
| トップページ
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| メール認証（Fortify + Laravel標準）
|--------------------------------------------------------------------------
*/

// 認証誘導画面（verify.blade.php）
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// メール内リンククリック時
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    // 認証完了後の遷移先
    return redirect()->route('attendance.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 認証メール再送
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/*
|--------------------------------------------------------------------------
| 勤怠管理（ログイン + メール認証必須）
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])
        ->name('attendance.clockIn');

    Route::post('/attendance/break-start', [AttendanceController::class, 'breakStart'])
        ->name('attendance.breakStart');

    Route::post('/attendance/break-end', [AttendanceController::class, 'breakEnd'])
        ->name('attendance.breakEnd');

    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])
        ->name('attendance.clockOut');

    Route::get('/attendance/list', [AttendanceController::class, 'list'])
        ->name('attendance.list');

    Route::get('/attendance/list/{year}/{month}', [AttendanceController::class, 'list'])
        ->name('attendance.list.month');

    Route::get('/attendance/detail/{id}', [AttendanceController::class, 'detail'])
        ->name('attendance.detail');

    Route::post('/attendance/{id}/correction',
        [AttendanceController::class, 'requestCorrection'])
        ->name('attendance.requestCorrection');

});

Route::middleware(['auth'])->group(function () {
        Route::get('/stamp_correction_request/list',
        [CorrectionController::class, 'index'])
        ->name('admin.corrections.index');
});
/*
|--------------------------------------------------------------------------
| 管理者ログイン（Fortifyとは別）
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login',
    [App\Http\Controllers\Admin\AuthController::class, 'login'])
    ->name('admin.login.post');


/*
|--------------------------------------------------------------------------
| 管理者専用（ログイン必須・メール認証不要）
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/attendance/list',
        [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])
        ->name('admin.attendances');

    Route::get('/admin/attendance/list/{date}',
        [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])
        ->name('admin.attendances.date');

    Route::get('/admin/staff/list',
        [\App\Http\Controllers\Admin\UserController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/admin/attendance/staff/{id}',
        [\App\Http\Controllers\Admin\AttendanceController::class, 'showStaffAttendance'])
        ->name('admin.attendance.staff');

    Route::get('/admin/corrections/{id}',
        [\App\Http\Controllers\Admin\CorrectionController::class, 'show'])
        ->name('admin.corrections.show');

    Route::post('/stamp_correction_request/approve/{attendance_correct_request}',
        [CorrectionController::class, 'approve'])
        ->name('stamp_correction_request.approve');

    Route::post('/admin/corrections/{id}/reject',
        [\App\Http\Controllers\Admin\CorrectionController::class, 'reject'])
        ->name('admin.corrections.reject');

    Route::get('/admin/attendance/{id}',
        [\App\Http\Controllers\Admin\AttendanceController::class, 'show'])
        ->name('admin.attendance.detail');

    Route::post('/admin/attendances/{id}/update',
        [\App\Http\Controllers\Admin\AttendanceController::class, 'update'])
        ->name('admin.attendance.update');
});
