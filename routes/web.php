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


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard']);
Route::get('/personal/add-person', [App\Http\Controllers\HomeController::class, 'add_person']);
Route::post('/personal/add-person/store', [App\Http\Controllers\HomeController::class, 'add_person_store']);

Route::get('/personal/residence-list', [App\Http\Controllers\HomeController::class, 'residence_list']);
Route::get('/personal/resident/get/{uid}', [App\Http\Controllers\HomeController::class, 'get_resident']);
Route::any('/personal/resident/issue/store', [App\Http\Controllers\HomeController::class, 'resident_issue_store']);

Route::any('/brgy/clearance/issue', [App\Http\Controllers\CertController::class, 'bgry_clearance']);
Route::any('/brgy/clearance/issue/pdf/{isHTML?}', [App\Http\Controllers\CertController::class, 'bgry_clearance_pdf']);


Auth::routes();
// Auth::routes(['register' => false]);
