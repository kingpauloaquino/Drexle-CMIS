<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use App\Models\Transaction;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CertController;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = \Auth::user();

        if ($user->role == 0) {

            $schedule_date = Schedule::where("residence_uid", $user->id)->where("status", 0)->first();
            $trans_pending = Transaction::where("residence_uid", $user->id)->where("status", 0)->get()->count();
            $trans_released = Transaction::where("residence_uid", $user->id)->where("status", 1)->get()->count();
            return view('pages.resident.dashboard', compact('schedule_date', 'trans_pending', 'trans_released'));
        }

        $total_registered = DB::select("SELECT COUNT(*) AS totalCount FROM residence;");
        $total_released = DB::select("SELECT COUNT(*) AS totalCount FROM residence_transaction;");
        $total_pending_request = DB::select("SELECT COUNT(*) AS totalCount FROM db_brgy.residence WHERE is_read = 0;");

        return view('pages.dashboard', compact('total_registered', 'total_released', 'total_pending_request'));
    }


    public function add_person()
    {
        return view('pages.add_person');
    }

    public function add_person_store(Request $request)
    {
        $path = storage_path('/public/image-library');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $fileOrigName = "";
        $fileName = "";
        $filePath = "";
        if ($request->file()) {
            $fileOrigName = $request->file->getClientOriginalName();
            $fileName = time() . '_' . $fileOrigName;
            $relPathAndName = $request->file->storePubliclyAs('/public/image-library', $fileName);
            $filePath  = str_replace('public', 'storage', $relPathAndName);
        }

        $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y');
        // $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y years, %m months and %d days');

        $validatedData = $request->validate([
            'stay' => 'required|min:0'
        ]);

        if ((int)$validatedData['stay'] < 0) {
            return redirect("/personal/add-person")->with("error", "Oops, year's stay cannot be negative.");
        }

        $middlename = strlen($request->middlename) > 0 ? $request->middlename : "N/A";

        $mobile = "+63" . substr($request->mobile, 1, 10);

        if ((int)$request->verified != 1) {
            return redirect("/personal/add-person")->with("error", "Oops, your mobile number is not valid.");
        }

        $brgId = "EBB" .  date("ymds") . mt_rand(100000, 999999);

        $password = mt_rand(10000000, 99999999);
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $brgId;
        $user->mobile = $mobile;
        $user->brgy_id = $brgId;
        $user->password = Hash::make($password);

        if (!$user->save()) {
            return redirect("/personal/add-person")->with("error", "Oops, something went wrong.");
        }

        $sms = new SMSController();
        $sms->sendWelcome($mobile, $request->firstname, $brgId, $password);

        $data = new Residence();
        $data->brgy_id = $brgId;
        $data->firstname = $request->firstname;
        $data->middlename = $middlename;
        $data->lastname = $request->lastname;
        $data->age = (int)$age;
        $data->address1 = $request->address1;
        $data->address2 = $request->address2;
        $data->address3 = $request->address3;
        $data->year_stay = $request->stay;
        $data->household = $request->household;
        $data->birthdate = $request->birthdate;
        $data->birthplace = $request->birhtplace;
        $data->gender = $request->gender;
        $data->civil_status = $request->civil;
        $data->nationality = $request->nationality;
        $data->blood = $request->blood;
        $data->email = $request->email;
        $data->mobile = $mobile;
        $data->work = $request->work;
        $data->skill = $request->skill;
        $data->image = $filePath;
        $data->is_read = 1;

        if ($data->save()) {
            return redirect("/personal/residence-list")->with("message", "Good Job!");
        }
        return redirect("/personal/add-person")->with("error", "Oops, something went wrong.");
    }

    public function edit_person($uid)
    {
        $resident = Residence::where("id", $uid)->first();

        return view('pages.edit_person', compact('resident'));
    }

    public function edit_person_update($uid, Request $request)
    {

        $path = storage_path('/public/image-library');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $fileOrigName = "";
        $fileName = "";
        $filePath = "";
        if ($request->file()) {
            $fileOrigName = $request->file->getClientOriginalName();
            $fileName = time() . '_' . $fileOrigName;
            $relPathAndName = $request->file->storePubliclyAs('/public/image-library', $fileName);
            $filePath  = str_replace('public', 'storage', $relPathAndName);
        }

        $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y');

        $validatedData = $request->validate([
            'stay' => 'required|min:0'
        ]);

        if ((int)$validatedData['stay'] < 0) {
            return redirect("/personal/edit-person/{$uid}")->with("error", "Oops, year's stay cannot be negative.");
        }

        $middlename = strlen($request->middlename) > 0 ? $request->middlename : " ";

        $data = [
            "firstname" => $request->firstname,
            "middlename" => $middlename,
            "lastname" => $request->lastname,
            "age" => (int)$age,
            "address1" => $request->address1,
            "address2" => $request->address2,
            "address3" => $request->address3,
            "year_stay" => $request->stay,
            "household" => $request->household,
            "birthdate" => $request->birthdate,
            "birthplace" => $request->birhtplace,
            "gender" => $request->gender,
            "civil_status" => $request->civil,
            "nationality" => $request->nationality,
            "blood" => $request->blood,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "work" => $request->work,
            "skill" => $request->skill,
            "image" => $filePath
        ];

        $resident = Residence::where("id", $uid)->update($data);

        if ($resident) {
            return redirect("/personal/edit-person/{$uid}")->with("message", "Updated!");
        }
        return redirect("/personal/edit-person/{$uid}")->with("error", "Oops, something went wrong.");
    }

    public function delete_person($uid)
    {
        return view('pages.delete_person', compact('uid'));
    }

    public function delete_person_delete($uid, Request $request)
    {
        $resident = Residence::where("id", $uid)->update(["status" => 99]);

        if ($resident) {
            return redirect("/personal/residence-list")->with("message", "Updated!");
        }
        return redirect("/personal/edit-person/{$uid}")->with("error", "Oops, something went wrong.");
    }

    public function get_resident($uid)
    {
        $data = Residence::where("id", (int)$uid)->first();

        if ($data == null) {
            return ["status" => 404];
        }
        return ["status" => 200, "data" => $data];
    }

    public function get_resident_transaction($uid)
    {
        $data = Transaction::where("id", (int)$uid)->first();

        if ($data == null) {
            return ["status" => 404];
        }
        return ["status" => 200, "data" => $data];
    }

    public function residence_list()
    {
        $data = Residence::where("status", 0)->orderBy("created_at", "DESC")->get();
        return view('pages.record_list', compact('data'));
    }

    public function request_list()
    {
        $dateToday = Carbon::today();
        $dateTodayFormated = $dateToday->format('Y-m-d');
        // $data = DB::select("SELECT * FROM get_request_list WHERE scheduled = '{$dateTodayFormated}';");
        $data = DB::select("SELECT * FROM get_request_list WHERE cstatus = 0;");
        return view('pages.trans', compact('data'));
    }

    public function released_list()
    {
        $data = DB::select("SELECT * FROM get_request_list WHERE cstatus = 1;");
        return view('pages.released', compact('data'));
    }

    public function request_single(Request $request)
    {

        $cert = new CertController();

        $intUid = (int)$request->cid;
        $method = $request->method;
        $cert_string = "";

        switch ($method) {
            case "residency":
                $record_method = "Residency";
                $cert_string = $cert->bgry_indigency_pdf($request);
                break;
            case "soloparent":
                $record_method = "Solo Parent";
                break;
            case "indigency":
                $record_method = "Indigency";
                break;
            case "bgryclearance":
                $record_method = "Barangay Clearance";
                break;
            case "jobseeker":
                $record_method = "First Time Job Seeker";
                break;
            case "businesspermit":
                $record_method = "Business Permit";
                break;
            case "businessclosure":
                $record_method = "Business Closure";
                break;
        }

        $data = DB::select("SELECT * FROM get_request_list WHERE cid = {$intUid};");

        if (COUNT($data) > 0) {
            return ["status" => 200, "data" => $data];
        }

        return ["status" => 404];
    }

    public function residence_list_seasrch(Request $request)
    {
        $key = $request->search;

        $data = DB::select("SELECT * FROM residence WHERE firstname LIKE '%{$key}%' OR lastname LIKE '%{$key}%' OR mobile LIKE '%{$key}%' OR age LIKE '%{$key}%' OR work LIKE '%{$key}%' OR skill LIKE '%{$key}%' OR blood LIKE '%{$key}%';");

        return view('pages.search', compact('data'));
    }

    public function request_list_seasrch(Request $request)
    {
        $key = $request->search;

        $data = DB::select("SELECT * FROM get_request_list WHERE firstname LIKE '%{$key}%' OR middlename LIKE '%{$key}%' OR lastname LIKE '%{$key}%' OR mobile LIKE '%{$key}%' OR age LIKE '%{$key}%' OR work LIKE '%{$key}%' OR skill LIKE '%{$key}%' OR blood LIKE '%{$key}%' AND cstatus = 0;");

        return view('pages.trans', compact('data'));
    }

    public function released_list_seasrch(Request $request)
    {
        $key = $request->search;

        $data = DB::select("SELECT * FROM get_request_list WHERE firstname LIKE '%{$key}%' OR middlename LIKE '%{$key}%' OR lastname LIKE '%{$key}%' OR mobile LIKE '%{$key}%' OR age LIKE '%{$key}%' OR work LIKE '%{$key}%' OR skill LIKE '%{$key}%' OR blood LIKE '%{$key}%' AND cstatus = 1;");

        return view('pages.released', compact('data'));
    }

    public function cert_list_seasrch(Request $request)
    {

        $method = $request->method;
        $key = $request->search;

        switch ($method) {
            case "residency":
                $record_method = "Residency";
                break;
            case "soloparent":
                $record_method = "Solo Parent";
                break;
            case "indigency":
                $record_method = "Indigency";
                break;
            case "bgryclearance":
                $record_method = "Barangay Clearance";
                break;
            case "jobseeker":
                $record_method = "First Time Job Seeker";
                break;
            case "businesspermit":
                $record_method = "Business Permit";
                break;
            case "businessclosure":
                $record_method = "Business Closure";
                break;
        }

        $data_count = DB::select("SELECT COUNT(*) AS totalCount FROM get_cert_trans WHERE method = '{$method}';");

        $data = DB::select("SELECT * FROM get_cert_trans WHERE method = '{$method}' AND fullname LIKE '%{$key}%';");

        return view('pages.trans_search', compact('data', 'data_count', 'record_method', 'method'));
    }

    public function resident_issue_store(Request $request)
    {
        $resident = $this->get_resident($request->uid);

        $busines = null;

        $cert = new CertController();

        switch ($request->method) {
            case "Solo Parent":
            case "Indigency":
                $method = 1;
                $res = $cert->bgry_indigency_pdf($resident["data"]);
                break;
            case "First Time JobSeeker":
                $method = 2;
                $res = $cert->first_time_jobseekers_generate($resident["data"]);
                break;
            case "Business Permit":
                $method = 3;
                $results = $cert->business_permit_generate($resident["data"], $request);
                $res = $results["html"];
                $busines = $results["business"];
                break;
            default:
                $method = 0;
                $res = $cert->bgry_clearance_pdf($resident["data"]);
        }

        return ["status" => 200, "html" => $res, "method" => $method, "uid" => $request->uid, "busines" => $busines];
    }

    public function resident_issue_download($uid, $method, Request $request)
    {
        $resident = $this->get_resident($uid);

        $cert = new CertController();

        switch ((int)$method) {
            case 1:
                $res = $cert->bgry_indigency_pdf($resident["data"], true);
                break;
            case 2:
                $res = $cert->first_time_jobseekers_generate($resident["data"], true);
                break;
            case 3:
                $res = $cert->business_permit_generate($resident["data"], $request, true);
                break;
            default:
                $res = $cert->bgry_clearance_pdf($resident["data"], true);
        }

        if ($res["status"] == 200) {

            $resident = Residence::where("id", $uid)->update(["purpose" => "", "is_read" => 1]);

            $data = new Transaction();
            $data->method = $method;
            $data->residence_uid = $uid;
            $data->date_issued = Carbon::now();
            $data->business_name = $request->bname;
            $data->business_address = $request->baddresss;
            $data->business_operator = $request->operator;
            $data->business_residence_address = $request->raddress;
            if ($data->save()) {
                return redirect($res["url"]);
            }
        }

        return ["status" => 500];
    }

    public function issue_save_print(Request $request)
    {
        $resident = Residence::where("id", $request->uid)->update(["is_read" => 1]);
        $resident = Transaction::where("id", $request->cid)->update(["date_issued" => Carbon::now(), "status" => 1, "control_number" => $request->cn]);

        if ($resident) {
            return ["status" => 200];
        }

        return ["status" => 500];
    }

    public function issue_closure_print(Request $request)
    {
        $data = Transaction::where("id", $request->buid)->update(["status" => 2, "method" => "businessclosure"]);

        if ($data) {
            return ["status" => 200];
        }

        return ["status" => 500];
    }

    public function get_resident_trans($method)
    {

        switch ($method) {
            case "residency":
                $record_method = "Residency";
                break;
            case "soloparent":
                $record_method = "Solo Parent";
                break;
            case "indigency":
                $record_method = "Indigency";
                break;
            case "bgryclearance":
                $record_method = "Barangay Clearance";
                break;
            case "jobseeker":
                $record_method = "First Time Job Seeker";
                break;
            case "businesspermit":
                $record_method = "Business Permit";
                break;
            case "businessclosure":
                $record_method = "Business Closure";
                break;
        }

        $data_count = DB::select("SELECT COUNT(*) AS totalCount FROM get_cert_trans WHERE method = '{$method}';");
        $data = DB::select("SELECT * FROM get_cert_trans WHERE method = '{$method}';");

        return view('pages.trans', compact('data', 'data_count', 'record_method', 'method'));
    }

    public function get_resident_trans_detailed($uid, $method)
    {
        $data = Transaction::where("residence_uid", $uid)->where("method", $method)->get();

        if (COUNT($data) > 0) {
            return ["status" => 200, "data" => $data];
        }

        return ["status" => 404, "data" => []];
    }

    public function account_add_new()
    {
        return view('pages.account_add');
    }

    public function account_add_new_store(Request $request)
    {
        $password = mt_rand(10000000, 99999999);

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = $password;
        $user->role = $request->role;
        $user->status = $request->status;

        $msg = "You have successfully added " . $request->firstname . ". The password is: {$password}";

        if ($user->save()) {
            return redirect("/account/add-new")->with("message", $msg);
        }

        return redirect("/account/add-new")->with("error", "Oops, something went wrong.");
    }

    public function account_list()
    {
        $data = User::where("role", ">", 0)->get();

        return view('pages.account', compact('data'));
    }
}
