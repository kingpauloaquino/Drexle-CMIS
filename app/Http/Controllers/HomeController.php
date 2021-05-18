<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use App\Models\Transaction;

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

        if($user->role == 0) {
            return view('pages.resident.dashboard');
        }

        $total_released = DB::select("SELECT COUNT(*) AS totalCount FROM residence_transaction;");
        $total_pending_request = DB::select("SELECT COUNT(*) AS totalCount FROM db_brgy.residence WHERE is_read = 0;");

        return view('pages.dashboard', compact('total_released', 'total_pending_request'));
    }

    public function add_person()
    {
        return view('pages.add_person');
    }

    public function add_person_store(Request $request)
    {

        $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y');
        // $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y years, %m months and %d days');

        $validatedData = $request->validate([
            'stay' => 'required|min:0'
        ]);

        if ((int)$validatedData['stay'] < 0) {
            return redirect("/personal/add-person")->with("error", "Oops, year's stay cannot be negative.");
        }

        $middlename = strlen($request->middlename) > 0 ? $request->middlename : " ";

        $data = new Residence();
        $data->id_number = $request->id_number;
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
        $data->mobile = $request->mobile;
        $data->work = $request->work;
        $data->skill = $request->skill;

        if($data->save()) {
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
        $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y');

         $validatedData = $request->validate([
            'stay' => 'required|min:0'
        ]);

        if((int)$validatedData['stay'] < 0) {
            return redirect("/personal/edit-person/{$uid}")->with("error", "Oops, year's stay cannot be negative.");
        }

        $middlename = strlen($request->middlename) > 0 ? $request->middlename : " ";

        $data = [
            "id_number" => $request->id_number,
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
        $resident = Residence::where("id", $uid)->delete();

        if ($resident) {
            return redirect("/personal/residence-list")->with("message", "Updated!");
        }
        return redirect("/personal/edit-person/{$uid}")->with("error", "Oops, something went wrong.");
    }

    public function get_resident($uid)
    {
        $data = Residence::where("id", (int)$uid)->first();

        if($data == null) {
            return ["status" => 404];
        }
        return ["status" => 200, "data" => $data];
    }

    public function residence_list()
    {
        $data = Residence::orderBy("created_at", "DESC")->get();
        return view('pages.record_list', compact('data'));
    }

    public function residence_list_seasrch(Request $request)
    {

        $key = $request->search;

        $data = DB::select("SELECT * FROM residence WHERE firstname LIKE '%{$key}%' OR lastname LIKE '%{$key}%' OR mobile LIKE '%{$key}%' OR age LIKE '%{$key}%' OR work LIKE '%{$key}%' OR skill LIKE '%{$key}%' OR blood LIKE '%{$key}%';");

        // dd($data);

        return view('pages.search', compact('data'));
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

        switch($request->method) {
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

        return ["status" => 200, "html" => $res, "method" => $method, "uid" => $request->uid, "busines" => $busines] ;

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

         if($res["status"] == 200) {

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
        $resident = Residence::where("id", $request->uid)->update(["purpose" => "", "is_read" => 1]);

        $data = new Transaction();
        $data->method = $request->method;
        $data->residence_uid = $request->uid;
        $data->date_issued = Carbon::now();

        $data->purpose = $request->purpose;
        $data->requestor = $request->requestor;
        $data->remark = $request->remark;

        $data->business_renewal = $request->renewal;
        $data->business_code = $request->code;
        $data->business_name = $request->name;
        $data->business_address = $request->address1;
        $data->business_operator = $request->operator;
        $data->business_residence_address = $request->address2;

        if ($data->save()) {
            return ["status" => 200];
        }

        return ["status" => 500];
    }

    public function issue_closure_print(Request $request)
    {
        $data = Transaction::where("id", $request->buid)->update(["status"=>2, "method" => "businessclosure"]);

        if ($data) {
            return ["status" => 200];
        }

        return ["status" => 500];
    }

    public function get_resident_trans($method)
    {

        switch($method) {
            case "residency" :
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

        if(COUNT($data) > 0) {
            return ["status" => 200, "data" => $data];
        }

        return ["status" => 404, "data" => []];
    }
}
