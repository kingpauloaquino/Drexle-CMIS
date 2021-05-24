<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Residence;
use App\Models\Transaction;
use App\Models\Schedule;
use App\Models\User;

use App\Http\Controllers\CertController;
use App\Http\Controllers\SMSController;
use Carbon\Carbon;
use DB;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile() {

        $user = \Auth::user();

        $res = Residence::where("brgy_id", $user->brgy_id)->first();

        return view("pages.resident.profile", compact('res'));
    }

    public function profile_edit(Request $request)
    {
        $user = \Auth::user();

        $uid = $user->brgy_id;

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
            return redirect("/personal/user/profile")->with("error", "Oops, year's stay cannot be negative.");
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

        $resident = Residence::where("brgy_id", $uid)->update($data);

        if ($resident) {
            return redirect("/personal/user/profile")->with("message", "Updated!");
        }
        return redirect("/personal/user/profile")->with("error", "Oops, something went wrong.");

    }

    public function settings()
    {
        $user = \Auth::user();

        return view("pages.resident.settings");
    }

    public function settings_edit(Request $request)
    {
        $user = \Auth::user();

        if($request->password != $request->rpassword) {
            return redirect("/personal/user/settings")->with("error", "Oops, Your new password did not match with the re-type password.");
        }

        $newpassword = Hash::make($request->password);

        $usr = User::where("id", $user->id)->update(["password" => $newpassword]);

        if ($usr) {
            return redirect("/personal/user/settings")->with("message", "Your password was updated!");
        }
        return redirect("/personal/user/settings")->with("error", "Oops, something went wrong.");
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

        $sms = new SMSController();
        $sms->sendSchedule($user->mobile, $user->firstname, $schedule);

        return ["status" => 200];
    }

    public function set_schedule() {

        $started = 1;
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
