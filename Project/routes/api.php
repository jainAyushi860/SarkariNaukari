<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationController;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\emailController;
// use App\Http\Controllers\otpController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AddRoleController;




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

      // For Login Data

      Route::group(['middleware'=>'api'],function($routes){
        Route::post('/register',[LoginController::class,'store']); 
        Route::post('/loginData',[LoginController::class,'login']);
        Route::post('/profile',[LoginController::class,'profile']);
        Route::post('/logout',[LoginController::class,'logout']);
        Route::post('/otpBySms', [LoginController::class,'sendOTP']);
        Route::get('/forgotPassword',[LoginController::class,'generateOTP']);
        Route::get('/verifyOTP',[LoginController::class,'OTPverificationEmail']);
        Route::put('/resetPassword',[LoginController::class,'passwordReset']);
        Route::delete('/deleteData',[LoginController::class,'deleteRecord']);
        Route::get('/sendemail',[LoginController::class,'generateOTP']);  
    });

   


    