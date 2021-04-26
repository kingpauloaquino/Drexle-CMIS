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

    public function resident_issue_store(Request $request)
    {
        $resident = $this->get_resident($request->uid);

        $cert = new CertController();

        switch($request->method) {
            case "Indigency":
                $res = $cert->bgry_indigency_pdf($resident["data"], null);
                break;
            case "First Time JobSeeker":
                $res = $cert->first_time_jobseekers_generate($resident["data"], null);
                break;
            default:
                $res = $cert->bgry_clearance_pdf($resident["data"], null);
        }

        if($res["status"] == 200) {
            $data = new Transaction();
            $data->method = $request->method;
            $data->residence_uid = $request->uid;
            $data->date_issued = Carbon::now();
            if ($data->save()) {
                return ["status" => 200, "url" => $res["url"]];
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

        // $data = DB::select("
        //     SELECT *,
        //     (SELECT firstname FROM residence WHERE id = x.residence_uid)  AS fullname
        //     FROM residence_transaction AS x
        //     WHERE x.method = {$type}"
        // );

        $data = DB::select("SELECT * FROM get_trans WHERE method = '{$type}';");

        // dd($data);

        return view('pages.trans', compact('data'));
    }
}
