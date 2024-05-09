<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
//use App\Http\Controllers\googleController;
use App\Http\Controllers\RoleContoller;
// use App\Http\Controllers\AddRoleController;
// use App\Http\Controllers\RightsController;
// use App\Http\Controllers\ShowUserController;
// use App\Http\Controllers\AddRightsController;
use App\Http\Controllers\UsersController;



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

// Route::get('/sendemail', function () {
//     return view('welcome');
// });

// Route::get('/sendpage', [otpController::class, 'smsPage']);
// Route::post('/sendotp', [otpController::class, 'sendOTP'])->name('send.otp');




// for social google login
// Route::get('auth/google',[googleController::class,'googleLogin'])->name('login');
// Route::get('auth/google/callback',[googleController::class,'googleHandle'])->name('callback');

Route::get('auth/google',[LoginController::class,'googleLogin'])->name('login');
Route::get('auth/google/callback',[LoginController::class,'googleHandle'])->name('callback');

Route::get('/home', function () {
    return view('layouts.app-web-layout');
});


//for google captcha
// Route::get('login',[googleController::class,'getuser']);
// Route::post('login/formstore',[googleController::class,'formstore'])->name('login.formstore');


// for reCaptcha
Route::get('register',[LoginController::class,'getuser']);
Route::post('captcha',[LoginController::class,'store'])->name('captcha.store');

// //for admin user register
// Route::get('admin',[RoleController::class,'getuser'])->name('admin');
// Route::post('userrole',[RoleController::class,'store'])->name('userrole.store');


// Route::get('/role', function () {
//     return view('admin');
// });


// for add the role of admin user
// Route::get('addrole',[AddRoleController::class,'getrole'])->name('addrole');
// Route::post('addedrole',[AddRoleController::class,'store'])->name('addedrole.store');


// for add the rights of admin user
// Route::get('addrights',[AddRightsController::class,'getrights'])->name('addrights');
// Route::post('addedrights',[AddRightsController::class,'store'])->name('addedrights.store');

// for view the role of admin user
// Route::get('show',[RightsController::class,'showData'])->name('showrole');
// Route::get('show',[RightsController::class,'showData'])->name('showrights');
//Route::post('userrights',[RightsController::class,'store'])->name('userrights.store');

// // for view user
// Route::get('showuser',[ShowUserController::class,'showData'])->name('showusers');


////////////////////////////////////////////////

//Route::group(['middleware' => ['role:super-admin|admin']], function() {
Route::group(['middleware' => ['isAdmin']], function() {
// for permissions
Route::resource('permissions',App\Http\Controllers\PermissionController::class);
Route::get('permissions/{permissionId}/delete',[App\Http\Controllers\PermissionController::class,'destroy']);

//for roles
Route::resource('roles',App\Http\Controllers\RoleContoller::class);
Route::get('roles/{roleId}/delete',[App\Http\Controllers\RoleContoller::class,'destroy']);
Route::get('roles/{roleId}/give-permissions',[App\Http\Controllers\RoleContoller::class,'addPermissionToRole']);
Route::put('roles/{roleId}/give-permissions',[App\Http\Controllers\RoleContoller::class,'givePermissionToRole']);

//for users
Route::resource('users',App\Http\Controllers\UsersController::class);
Route::get('users/{userId}/delete',[App\Http\Controllers\UsersController::class,'destroy']);
});