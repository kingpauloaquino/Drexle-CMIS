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

Route::get('/home', function () {
    return redirect("/dashboard");
});

Route::get('/personal/registration', [App\Http\Controllers\PublicController::class, 'personal_registration']);
Route::post('/personal/registration/store', [App\Http\Controllers\PublicController::class, 'personal_registration_store']);


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard']);

Route::get('/personal/add-person', [App\Http\Controllers\HomeController::class, 'add_person']);
Route::post('/personal/add-person/store', [App\Http\Controllers\HomeController::class, 'add_person_store']);
Route::get('/personal/edit-person/{uid}', [App\Http\Controllers\HomeController::class, 'edit_person']);
Route::post('/personal/edit-person/update/{uid}', [App\Http\Controllers\HomeController::class, 'edit_person_update']);
Route::get('/personal/delete-person/{uid}', [App\Http\Controllers\HomeController::class, 'delete_person']);
Route::post('/personal/delete-person/delete/{uid}', [App\Http\Controllers\HomeController::class, 'delete_person_delete']);

Route::get('/personal/residence-list', [App\Http\Controllers\HomeController::class, 'residence_list']);
Route::any('/personal/residence-list/search', [App\Http\Controllers\HomeController::class, 'residence_list_seasrch']);
Route::get('/personal/resident/get/{uid}', [App\Http\Controllers\HomeController::class, 'get_resident']);

Route::any('/personal/resident/issue/summary', [App\Http\Controllers\HomeController::class, 'resident_issue_store']);
Route::get('/personal/resident/issue/download/{uid}/{method}', [App\Http\Controllers\HomeController::class, 'resident_issue_download']);

Route::get('/personal/clearance/get/{method}', [App\Http\Controllers\HomeController::class, 'get_resident_trans']);

Route::any('/brgy/clearance/issue/pdf', [App\Http\Controllers\CertController::class, 'bgry_clearance_pdf']);

Route::get('/sms-advisory', [App\Http\Controllers\SMSController::class, 'init']);
Route::post('/sms-advisory/execute', [App\Http\Controllers\SMSController::class, 'execute']);
Route::get('/sms/message-history', [App\Http\Controllers\SMSController::class, 'sms_list']);

Auth::routes();
// Auth::routes(['register' => false]);
