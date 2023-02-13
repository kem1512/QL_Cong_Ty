<?php

use App\Http\Controllers\Admin\DepartmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Department;
use Illuminate\Http\Request;

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\PersonnelController;

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/personnel', [PersonnelController::class, 'show'])->name('personnel')->middleware('auth');
Route::get('/personnel/delete', [App\Http\Controllers\PersonnelController::class, 'destroy'])->name('delete')->middleware('auth');
Route::post('/personnel/add', [App\Http\Controllers\PersonnelController::class, 'store'])->middleware('auth')->name('create.user');

Route::group(['middleware' => 'auth'], function () {
	Route::get('department', [DepartmentController::class, 'index']);
	Route::get('overview', [DepartmentController::class, 'overview'])->name('overview');
	Route::get('getEmployeeInDepartment/{id?}', [DepartmentController::class, 'getEmployeeInDepartment']);
	Route::get('getDepartment', [DepartmentController::class, 'getDepartment']);
	Route::post('search', [DepartmentController::class, 'search'])->name('department.search');
	Route::get('filter', [DepartmentController::class, 'filter'])->name('department.filter');
	Route::post('department', [DepartmentController::class, 'createOrUpdate'])->name('department.createOrUpdate');
	Route::delete('department', [DepartmentController::class, 'delete'])->name('department.delete');
	Route::get('department/{id?}', [DepartmentController::class, 'display'])->name('department.display');

	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
