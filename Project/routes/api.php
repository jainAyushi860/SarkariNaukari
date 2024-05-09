<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\emailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
//    }); 


    // // For Login Data
    // Route::controller(LoginController::class)->group(function(){
    // Route::post('/signupData','store')->name('signupData');
    // Route::get('/loginData','login');
    // Route::get('/forgotPassword','generateOTP');
    // Route::get('/verifyOTP','OTPverification');
    // Route::put('/resetPassword','passwordReset')->name('resetPassword');
    // Route::delete('/deleteData','deleteRecord');
    // });



    // For Media Data
    Route::controller(MediaController::class)->group(function(){
    Route::get('/getList', 'fetchRecord');
    Route::post('/insertList', 'store')->name('insertList');
    Route::put('/updateList', 'update')->name('updateList');
    Route::delete('/deleteList', 'destroy');
    });


    //For Notification Data
    Route::controller(notificationController::class)->group(function(){
    Route::post('/insertRecord','addNotification')->name('insertRecord');
    Route::get('/getRecords','fetchRecords');
    Route::get('/getSubscribe','subscriptionRecord');
    });



    // Route::group(['middleware'=>'api'],function($routes){

    //     Route::post('/register',[UserController::class,'register']);
    //     Route::post('/login',[UserController::class,'login']);
    //     Route::post('/profile',[UserController::class,'profile']);
    //     Route::post('/logout',[UserController::class,'logout']);

    // });


      // For Login Data

      Route::group(['middleware'=>'api'],function($routes){

        Route::post('/signupData',[LoginController::class,'store']);
        Route::post('/loginData',[LoginController::class,'login']);
        Route::post('/profile',[LoginController::class,'profile']);
        Route::post('/logout',[LoginController::class,'logout']);
        Route::get('/forgotPassword',[LoginController::class,'generateOTP']);
        Route::get('/verifyOTP',[LoginController::class,'OTPverification']);
        Route::put('/resetPassword',[LoginController::class,'passwordReset']);
        Route::delete('/deleteData',[LoginController::class,'deleteRecord']);

    //   Route::controller(LoginController::class)->group(function(){
    //     Route::post('/signupData','store')->name('signupData');
    //     Route::get('/loginData','login');
    //     Route::get('/forgotPassword','generateOTP');
    //     Route::get('/verifyOTP','OTPverification');
    //     Route::put('/resetPassword','passwordReset')->name('resetPassword');
    //     Route::delete('/deleteData','deleteRecord');
    //     });
    });

    // Route::middleware(['auth:sanctum'])->group(function(){
    // Route::post('/login', [AuthController::class, 'login'])->name('login');
    // });


    Route::get('/sendemail',[emailController::class,'sendEmail']);