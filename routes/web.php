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

Route::get('/forgot/password', function () {
    return view('auth.forgot');
});

Route::get('/forgot/barangay-id', function () {
    return view('auth.barangay-id');
});

Route::get('/home', function () {
    return redirect("/dashboard");
});

Route::get('/personal/registration', [App\Http\Controllers\PublicController::class, 'personal_registration']);
Route::post('/personal/registration/store', [App\Http\Controllers\PublicController::class, 'personal_registration_store']);
Route::get('/personal/mobile-verify', [App\Http\Controllers\PublicController::class, 'send_otp']);


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard']);
Route::any('/forgot/password-brgy-id/post', [App\Http\Controllers\PublicController::class, 'forgot_everything']);

Route::get('/personal/add-person', [App\Http\Controllers\HomeController::class, 'add_person']);
Route::post('/personal/add-person/store', [App\Http\Controllers\HomeController::class, 'add_person_store']);
Route::get('/personal/edit-person/{uid}', [App\Http\Controllers\HomeController::class, 'edit_person']);
Route::post('/personal/edit-person/update/{uid}', [App\Http\Controllers\HomeController::class, 'edit_person_update']);
Route::get('/personal/delete-person/{uid}', [App\Http\Controllers\HomeController::class, 'delete_person']);
Route::post('/personal/delete-person/delete/{uid}', [App\Http\Controllers\HomeController::class, 'delete_person_delete']);

Route::get('/personal/archived-list', [App\Http\Controllers\HomeController::class, 'archived_list']);
Route::get('/personal/residence-list', [App\Http\Controllers\HomeController::class, 'residence_list']);
Route::get('/personal/request-list', [App\Http\Controllers\HomeController::class, 'request_list']);
Route::get('/personal/request-list/get-details', [App\Http\Controllers\HomeController::class, 'request_single']);
Route::get('/personal/released-list', [App\Http\Controllers\HomeController::class, 'released_list']);

Route::any('/personal/residence-list/search', [App\Http\Controllers\HomeController::class, 'residence_list_seasrch']);
Route::any('/personal/request-list/search', [App\Http\Controllers\HomeController::class, 'request_list_seasrch']);
Route::any('/personal/released-list/search', [App\Http\Controllers\HomeController::class, 'released_list_seasrch']);
Route::any('/personal/cert-list/search', [App\Http\Controllers\HomeController::class, 'cert_list_seasrch']);

Route::get('/personal/resident/get/{uid}', [App\Http\Controllers\HomeController::class, 'get_resident']);

Route::any('/personal/resident/issue/summary', [App\Http\Controllers\HomeController::class, 'resident_issue_store']);
Route::get('/personal/resident/issue/download/{uid}/{method}', [App\Http\Controllers\HomeController::class, 'resident_issue_download']);

Route::get('/personal/clearance/get/{method}', [App\Http\Controllers\HomeController::class, 'get_resident_trans']);
Route::get('/business/clearance/get/{method}', [App\Http\Controllers\HomeController::class, 'get_resident_trans']);

Route::any('/brgy/clearance/issue/pdf', [App\Http\Controllers\CertController::class, 'bgry_clearance_pdf']);


Route::any('/brgy/residency/issue/preview/{uid}/{cid}/{method}', [App\Http\Controllers\CertController::class, 'check_cert']);
Route::any('/brgy/soloparent/issue/preview/{uid}', [App\Http\Controllers\CertController::class, 'bgry_soloparent_preview']);
Route::any('/brgy/indigency/issue/preview/{uid}', [App\Http\Controllers\CertController::class, 'bgry_indigency_preview']);
Route::any('/brgy/jobseeker/issue/preview/{uid}', [App\Http\Controllers\CertController::class, 'bgry_jobseeker_preview']);
Route::any('/brgy/clearance/issue/preview/{uid}', [App\Http\Controllers\CertController::class, 'bgry_clearance_preview']);
Route::any('/brgy/business/issue/preview/{uid}', [App\Http\Controllers\CertController::class, 'bgry_business_preview']);
Route::any('/brgy/closure/issue/preview/{uid}', [App\Http\Controllers\CertController::class, 'bgry_business_closure_preview']);

Route::any('/brgy/clearance/save/print', [App\Http\Controllers\HomeController::class, 'issue_save_print']);
Route::any('/brgy/clearance/closure/print', [App\Http\Controllers\HomeController::class, 'issue_closure_print']);
Route::any('/brgy/issue/list/{uid}/{method}', [App\Http\Controllers\HomeController::class, 'get_resident_trans_detailed']);

Route::get('/blotter/create', [App\Http\Controllers\BlotterController::class, 'create']);
Route::get('/blotter/view-list', [App\Http\Controllers\BlotterController::class, 'view_list']);
Route::any('/blotter/create/store', [App\Http\Controllers\BlotterController::class, 'store']);
Route::any('/blotter/status/update', [App\Http\Controllers\BlotterController::class, 'update_status']);


Route::get('/sms-advisory', [App\Http\Controllers\SMSController::class, 'init']);
Route::post('/sms-advisory/execute', [App\Http\Controllers\SMSController::class, 'execute']);
Route::get('/sms/message-history', [App\Http\Controllers\SMSController::class, 'sms_list']);

Route::get('/account/add-new', [App\Http\Controllers\HomeController::class, 'account_add_new']);
Route::any('/account/add-new/post', [App\Http\Controllers\HomeController::class, 'account_add_new_store']);
Route::get('/account/list', [App\Http\Controllers\HomeController::class, 'account_list']);



Route::get('/personal/user/profile', [App\Http\Controllers\ResidentController::class, 'profile']);
Route::any('/personal/user/profile/execute', [App\Http\Controllers\ResidentController::class, 'profile_edit']);
Route::get('/personal/user/settings', [App\Http\Controllers\ResidentController::class, 'settings']);
Route::any('/personal/user/settings/execute', [App\Http\Controllers\ResidentController::class, 'settings_edit']);
Route::get('/personal/clearance/request', [App\Http\Controllers\ResidentController::class, 'request_certificate']);
Route::any('/personal/clearance/request/check-point', [App\Http\Controllers\ResidentController::class, 'check_request']);
Route::any('/personal/clearance/request/post', [App\Http\Controllers\ResidentController::class, 'submit_request']);
Route::any('/personal/clearance/trans/request', [App\Http\Controllers\ResidentController::class, 'get_request_trans']);
Route::any('/personal/1212121', [App\Http\Controllers\ResidentController::class, 'set_schedule']);

Auth::routes();
// Auth::routes(['register' => false]);
