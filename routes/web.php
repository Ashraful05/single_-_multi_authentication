<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AdminController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',[WebsiteController::class,'index'])->name('home');

Route::get('dashboard/user',[WebsiteController::class,'dashboardUser'])->name('dashboard_user')->middleware('auth');

Route::get('login',[WebsiteController::class,'login'])->name('login');
Route::post('login/submit',[WebsiteController::class,'loginSubmit'])->name('login_submit');
Route::get('registration',[WebsiteController::class,'registration'])->name('registration');
Route::get('registration/verify/{token}/{email}',[WebsiteController::class,'registrationVerification']);
Route::post('submit/registration',[WebsiteController::class,'registrationSubmit'])->name('submit_registration');
Route::get('logout',[WebsiteController::class,'logout'])->name('logout');
Route::get('forgot/password',[WebsiteController::class,'PasswordForgot'])->name('forget_password');
Route::post('submit/forgot/password',[WebsiteController::class,'SubmitPasswordForgot'])->name('submit_forget_password');
Route::get('reset-password/{token}/{email}',[WebsiteController::class,'ResetPassword']);
Route::post('reset/password/submit',[WebsiteController::class,'ResetPasswordSubmit'])->name('reset_password_submit');

Route::controller(AdminController::class)->group(function(){
   Route::prefix('admin')->group(function(){
      Route::get('login','AdminLogin')->name('admin_login');
      Route::post('login/submit','AdminLoginSubmit')->name('admin_login_submit');
//       Route::get('dashboard','dashboardAdmin')->name('dashboard_admin')->middleware('admin:admin');
       Route::get('dashboard','dashboardAdmin')->name('dashboard_admin')->middleware('auth:admin');
       Route::get('settings','Settings')->name('admin_settings')->middleware('auth:admin');
       Route::get('logout','Logout')->name('admin_logout')->middleware('auth:admin');
   });
});
