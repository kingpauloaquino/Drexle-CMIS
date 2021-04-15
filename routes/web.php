<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/personal/registration', [App\Http\Controllers\PublicController::class, 'personal_registration']);
Route::post('/personal/registration/store', [App\Http\Controllers\PublicController::class, 'personal_registration_store']);


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard']);

Route::get('/personal/add-person', [App\Http\Controllers\HomeController::class, 'add_person']);
Route::post('/personal/add-person/store', [App\Http\Controllers\HomeController::class, 'add_person_store']);

Route::get('/personal/residence-list', [App\Http\Controllers\HomeController::class, 'residence_list']);
Route::get('/personal/resident/get/{uid}', [App\Http\Controllers\HomeController::class, 'get_resident']);
Route::any('/personal/resident/issue/store', [App\Http\Controllers\HomeController::class, 'resident_issue_store']);

Route::any('/brgy/clearance/issue/pdf', [App\Http\Controllers\CertController::class, 'bgry_clearance_pdf']);

Route::get('/sms-advisory', [App\Http\Controllers\SMSController::class, 'init']);
Route::post('/sms-advisory/execute', [App\Http\Controllers\SMSController::class, 'execute']);
Route::get('/sms/message-history', [App\Http\Controllers\SMSController::class, 'sms_list']);

Auth::routes();
// Auth::routes(['register' => false]);
