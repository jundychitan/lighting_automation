<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\LASSwitchController;
use App\Http\Controllers\LASUserListController;
use App\Http\Controllers\LASWebpageController;

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

/*Login Page*/
Route::get('/',[UserAuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::post('login-user', [UserAuthController::class,'loginUser'])->name('login-user');

/*Logout*/
Route::get('logout', [UserAuthController::class,'logout']);

/*Load Switch*/
Route::get('/switch', [LASSwitchController::class,'switch'])->name('switch')->middleware('isLoggedIn');
/*Get List of Switch*/
Route::post('switch_list', [LASSwitchController::class, 'getSwitch'])->name('SwitchList');

/*Get List of Switch*/
Route::post('switch_list_user', [LASSwitchController::class, 'getSwitch_user'])->name('SwitchListUser');
/*ON Switch*/
Route::post('ONSwitch', [LASSwitchController::class, 'ONSwitch'])->name('ONSwitch')->middleware('isLoggedIn');
/*OFF Switch*/
Route::post('OFFSwitch', [LASSwitchController::class, 'OFFSwitch'])->name('OFFSwitch')->middleware('isLoggedIn');
/*OFF Switch*/
Route::post('SENDSwitch', [LASSwitchController::class, 'SENDSwitch'])->name('SENDSwitch')->middleware('isLoggedIn');

/*Create Switch*/
Route::post('/create_switch_post', [LASSwitchController::class,'create_switch_post'])->name('create_switch_post')->middleware('isLoggedIn');
/*GET Switch Info*/
Route::post('/switch_info', [LASSwitchController::class, 'switch_info'])->name('switch_info')->middleware('isLoggedIn');
/*Update Site*/
Route::post('/update_switch_post', [LASSwitchController::class,'update_switch_post'])->name('update_switch_post')->middleware('isLoggedIn');

/*Confirm Delete Switch*/
Route::post('/delete_switch_confirmed', [LASSwitchController::class, 'delete_switch_confirmed'])->name('delete_switch_confirmed')->middleware('isLoggedIn');

/*Load User Account List for Admin Only*/
Route::get('/user', [LASUserListController::class,'user'])->name('user')->middleware('isLoggedIn');
/*Get List of User*/
Route::post('user_list', [LASUserListController::class, 'getUserList'])->name('UserList')->middleware('isLoggedIn');
/*Create User*/
Route::post('/create_user_post', [LASUserListController::class,'create_user_post'])->name('create_user_post')->middleware('isLoggedIn');

/*GET User Info*/
Route::post('/user_info', [LASUserListController::class, 'user_info'])->name('user_info')->middleware('isLoggedIn');
/*Update User*/
Route::post('/update_user_post', [LASUserListController::class,'update_user_post'])->name('update_user_post')->middleware('isLoggedIn');
/*Confirm Delete Switch*/
Route::post('/delete_user_confirmed', [LASUserListController::class, 'delete_user_confirmed'])->name('delete_user_confirmed')->middleware('isLoggedIn');
/*Update User Account*/
Route::post('/user_account_post', [LASUserListController::class,'user_account_post'])->name('user_account_post')->middleware('isLoggedIn');

/*Toggle all On/Off*/
Route::post('/toggle_all_state', [LASSwitchController::class,'toggle_all_state'])->name('toggle_all_state')->middleware('isLoggedIn');
/*Send All*/
Route::post('/toggle_all_send', [LASSwitchController::class,'toggle_all_send'])->name('toggle_all_send')->middleware('isLoggedIn');

/*Web Page Settings*/
/*Get Web Page Info*/
Route::post('/web_settings_info', [LASWebpageController::class, 'web_settings_info'])->name('web_settings_info')->middleware('isLoggedIn');


Route::post('/update_web_navigation_header_title_settings_post', [LASWebpageController::class, 'update_web_navigation_header_title_settings_post'])->name('update_web_navigation_header_title_settings_post')->middleware('isLoggedIn');
Route::post('/update_logo', [LASWebpageController::class, 'update_logo'])->name('update_logo')->middleware('isLoggedIn');