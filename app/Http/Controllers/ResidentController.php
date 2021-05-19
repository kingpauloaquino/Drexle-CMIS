<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use App\Models\Transaction;
use App\Models\Schedule;

use App\Http\Controllers\CertController;
use Carbon\Carbon;
use DB;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile() {
        return view("pages.resident.profile");
    }

    public function request_certificate()
    {
        $user = \Auth::user();


        if ($user->role != 0) {
            return redirect('/dashboard');
        }

        return view('pages.resident.request');
    }

    public function check_request(Request $request)
    {
        $user = \Auth::user();

        $trans = Transaction::where("residence_uid", $user->id)->where("method", $request->method)->where("status", 0)->first();

        return $trans != null ? ["status" => 200, "method" => $request->method] : ["status" => 0];
    }

    public function submit_request(Request $request) {

        $user = \Auth::user();
        $schedule = $this->set_schedule();

        $certs = $request->certificates;
        $other_info = $request->other_info;
        $business_info = $request->business_info;

        for($i = 0; $i < COUNT($certs); $i++) {

            if($certs[$i] != "businesspermit") {
                $data = new Transaction();
                $data->method = $certs[$i];
                $data->residence_uid = $user->id;
                $data->date_issued = Carbon::now();
                $data->purpose = $other_info["purpose"];
                $data->requestor = $other_info["requestor"];
                $data->remark = $other_info["remark"];
                $data->scheduled = $schedule;
                $data->save();
            }
            else {
                $data = new Transaction();
                $data->method = $certs[$i];
                $data->residence_uid = $user->id;
                $data->date_issued = Carbon::now();
                $data->purpose = "BUSINESS";
                $data->business_renewal = $business_info["btype"];
                $data->business_code = $business_info["bcode"];
                $data->business_name = $business_info["bname"];
                $data->business_address = $business_info["baddresss"];
                $data->business_operator = $business_info["operator"];
                $data->business_residence_address = $business_info["raddress"];
                $data->scheduled = $schedule;
                $data->save();
            }
        }

        $sched = new Schedule();
        $sched->residence_uid=$user->id;
        $sched->date_assigned= $schedule;
        $sched->save();

        return ["status" => 200];
    }

    public function set_schedule() {

        $started = 3;
        do {
            $dateAdd3day = Carbon::today()->addDay($started);
            $dateAdd3dayFormated = $dateAdd3day->format('Y-m-d');
            $sched = DB::select("SELECT * FROM schedule WHERE date_assigned = '{$dateAdd3dayFormated}' AND status = 0;");
            $started++;
        }while(COUNT($sched) >= 30);

       return $dateAdd3dayFormated;
    }

    public function get_request_trans() {
        $user = \Auth::user();

        $trans= Transaction::where("residence_uid", $user->id)->get();

        return view('pages.resident.trans', compact('trans'));
    }


}
