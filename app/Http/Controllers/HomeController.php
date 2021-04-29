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
        return view('pages.dashboard');
    }

    public function add_person()
    {
        return view('pages.add_person');
    }

    public function add_person_store(Request $request)
    {

        $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y');
        // $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y years, %m months and %d days');

        $data = new Residence();
        $data->id_number = $request->id_number;
        $data->firstname = $request->firstname;
        $data->middlename = $request->middlename;
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
            return redirect("/personal/add-person")->with("message", "Good Job!");
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

        $data = [
            "id_number" => $request->id_number,
            "firstname" => $request->firstname,
            "middlename" => $request->middlename,
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
        $data = Residence::get();
        return view('pages.record_list', compact('data'));
    }

    public function residence_list_seasrch(Request $request)
    {
        // $data = Residence::whereLike(['firstname','lastname','mobile','id_number'], $request->search)->get();

        $key = $request->search;

        $data = DB::select("SELECT * FROM residence WHERE firstname LIKE '%{$key}%' OR lastname LIKE '%{$key}%' OR mobile LIKE '%{$key}%' OR id_number LIKE '%{$key}%';");

        // dd($data);

        return view('pages.search', compact('data'));
    }

    public function resident_issue_store(Request $request)
    {
        $resident = $this->get_resident($request->uid);

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
                $res = $cert->business_permit_generate($resident["data"]);
                break;
            default:
                $method = 0;
                $res = $cert->bgry_clearance_pdf($resident["data"]);
        }

        return ["status" => 200, "html" => $res, "method" => $method, "uid" => $request->uid] ;

    }

    public function resident_issue_download($uid, $method)
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
                $res = $cert->business_permit_generate($resident["data"], true);
                break;
            default:
                $res = $cert->bgry_clearance_pdf($resident["data"], true);
        }

         if($res["status"] == 200) {
            $data = new Transaction();
            $data->method = $method;
            $data->residence_uid = $uid;
            $data->date_issued = Carbon::now();
            if ($data->save()) {
                return redirect($res["url"]);
            }
        }

        return ["status" => 500];
    }

    public function get_resident_trans($method)
    {

        $type = "Barangay Clearance";
        switch($method) {
            case "jobseeker";
                $type = "First Time JobSeeker";
                break;
            case "indigency";
                $type = "Indigency";
                break;
            case "lot-certication";
                $type = "Application Cert. Form";
                break;
            default:
                break;
        }

        $data_count = DB::select("SELECT COUNT(*) AS totalCount FROM get_trans WHERE method = '{$type}';");
        $data = DB::select("SELECT * FROM get_trans WHERE method = '{$type}';");

        return view('pages.trans', compact('data', 'data_count'));
    }
}
