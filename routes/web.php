<?php

use App\Http\Controllers\WareHousesController;
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
use App\Http\Controllers\EquimentTypeController;

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('addnhansu');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

//personnel
Route::get('/personnel', [App\Http\Controllers\Admin\PersonnelController::class, 'index'])->name('personnel.index')->middleware('auth');
Route::get('/personnel/edit', [App\Http\Controllers\Admin\PersonnelController::class, 'edit'])->name('personnel.edit')->middleware('auth');
Route::delete('/personnel', [App\Http\Controllers\Admin\PersonnelController::class, 'destroy'])->name('delete')->middleware('auth');
Route::post('/personnel/add', [App\Http\Controllers\Admin\PersonnelController::class, 'store'])->name('create.user')->middleware('auth');
Route::post('/personnel', [App\Http\Controllers\Admin\PersonnelController::class, 'update'])->name('update.user')->middleware('auth');
Route::post('/personnel/profile', [App\Http\Controllers\UserProfileController::class, 'update_profile'])->name('update.profile')->middleware('auth');
Route::get('/personnel/search', [App\Http\Controllers\Admin\PersonnelController::class, 'search'])->name('Search')->middleware('auth');
Route::get('/personnel/fillter', [App\Http\Controllers\Admin\PersonnelController::class, 'fillter'])->name('fillter')->middleware('auth');
Route::get('/personnel/level', [App\Http\Controllers\Admin\PersonnelController::class, 'editLevel'])->name('editLevel')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	// Route::get('department', 'DepartmentController@Index');
	//Route thiết bị
	//Loại thiết bị
	Route::group(
		['prefix' => 'equimenttype'],
		function () {
			Route::get(
				'/',
				function () {
					return view('pages.Equiments.Equiment_Type.Index');
				}
			)->name('equimenttype');
			Route::get('get/{perpage?}/{orderby?}/{keyword?}', [EquimentTypeController::class, 'Get']);
			Route::post('post', [EquimentTypeController::class, 'Post']);
			Route::get('delete/{id?}', [EquimentTypeController::class, 'Delete']);
			Route::get('getbyid/{id?}', [EquimentTypeController::class, 'Get_By_Id']);
			Route::post('update/{id?}', [EquimentTypeController::class, 'Update']);
		}
	);

	//Kho
	Route::group(
		['prefix' => 'warehouse'],
		function () {
			Route::get(
				'/',
				function () {
					return view('pages.Equiments.warehouse.wavehouse');
				}
			)->name('warehouse');
			Route::get('get/{perpage?}/{orderby?}/{keyword?}', [WareHousesController::class, 'Get']);
			Route::get('delete/{id?}', [WareHousesController::class, 'Delete']);
			Route::get('getbyid/{id?}', [WareHousesController::class, 'GetById']);
			Route::post('post', [WareHousesController::class, 'Create']);
			Route::post('update/{id?}', [WareHousesController::class, 'Update']);
		}
	);
	//End route thiết bị
	Route::post(
		'get_departments',
		function (Request $request) {
			$search = $request->search;

			if ($search == '') {
				$departments = Department::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
			} else {
				$departments = Department::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
			}

			$response = array();
			foreach ($departments as $department) {
				$response[] = array("value" => $department->id, "label" => $department->name);
			}

			return response()->json($response);
		}
	)->name('department.get_departments');
	// Route::post('department', [DepartmentController::class, 'create'])->name('department.create');
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
