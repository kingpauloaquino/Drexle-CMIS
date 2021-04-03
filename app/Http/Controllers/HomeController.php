<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use App\Models\Transaction;
use Carbon\Carbon;

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
        $data = new Residence();
        $data->firstname = $request->firstname;
        $data->middlename = $request->middlename;
        $data->lastname = $request->lastname;
        $data->address = $request->address;
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

    public function residence_list()
    {
        $data = Residence::get();
        return view('pages.record_list', compact('data'));
    }

    public function resident_issue_store(Request $request)
    {
        $data = new Transaction();
        $data->method = $request->method;
        $data->residence_uid = $request->uid;
        $data->details = json_encode(['data' => $request->details]);
        $data->date_issued = Carbon::now();
        if($data->save()) {
            return ["status" => 200];
        }
        return ["status" => 500];

    }
}
