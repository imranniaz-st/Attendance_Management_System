<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FingerDevicesController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\BiometricDeviceController;
use App\Http\Controllers\HomeController;
use App\http\controllers\VeltrixController;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('attended/{user_id}', [AttendanceController::class, 'attended'])->name('attended');
Route::get('attended-before/{user_id}', [AttendanceController::class, 'attendedBefore'])->name('attendedBefore');

Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {
    Route::resource('/employees', EmployeeController::class);
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('/latetime', [AttendanceController::class, 'indexLatetime'])->name('indexLatetime');
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave');
    Route::get('/overtime', [LeaveController::class, 'indexOvertime'])->name('indexOvertime');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::resource('/schedule', ScheduleController::class);
    Route::get('/check', [CheckController::class, 'index'])->name('check');
    Route::get('/sheet-report', [CheckController::class, 'sheetReport'])->name('sheet-report');
    Route::post('check-store', [CheckController::class, 'CheckStore'])->name('check_store');
    Route::resource('/finger_device', BiometricDeviceController::class);
    Route::delete('finger_device/destroy', [BiometricDeviceController::class, 'massDestroy'])->name('finger_device.massDestroy');
    Route::get('finger_device/{fingerDevice}/employees/add', [BiometricDeviceController::class, 'addEmployee'])->name('finger_device.add.employee');
    Route::get('finger_device/{fingerDevice}/get/attendance', [BiometricDeviceController::class, 'getAttendance'])->name('finger_device.get.attendance');
    Route::get('finger_device/clear/attendance', function () {
        $midnight = \Carbon\Carbon::createFromTime(23, 50, 00);
        $diff = now()->diffInMinutes($midnight);
        dispatch(new ClearAttendanceJob())->delay(now()->addMinutes($diff));
        toast("Attendance Clearance Queue will run in 11:50 P.M}!", "success");
        return back();
    })->name('finger_device.clear.attendance');
});

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Route::get('/attendance/assign', function () {
//     return view('attendance_leave_login');
// })->name('attendance.login');

// Route::post('/attendance/assign', [AttendanceController::class, 'assign'])->name('attendance.assign');

// Route::get('/leave/assign', function () {
//     return view('attendance_leave_login');
// })->name('leave.login');

// Route::post('/leave/assign', [LeaveController::class, 'assign'])->name('leave.assign');

// Route::get('{any}', [VeltrixController::class, 'index']);
