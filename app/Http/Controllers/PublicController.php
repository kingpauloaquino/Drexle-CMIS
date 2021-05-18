<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SMS;
use Carbon\Carbon;
use DB;

class PublicController extends Controller
{
    public function personal_registration()
    {
        return view('pages.public.filloutform');
    }

    public function send_otp(Request $request)
    {
        $sms = new SMSController();
        return $sms->sendOTP($request->mobile);
    }

    public function personal_registration_store(Request $request)
    {
        $age = Carbon::parse($request->birthdate)->diff(Carbon::now())->format('%y');


        $validatedData = $request->validate([
            'stay' => 'required|min:0'
        ]);

        if((int)$validatedData['stay'] < 0) {
            return redirect("/personal/registration")->with("error", "Oops, year's stay cannot be negative.");
        }

        $middlename = strlen($request->middlename) > 0 ? $request->middlename : "N/A";

        $mobile = "+63" . substr($request->mobile, 1, 10);

        if((int)$request->verified != 1) {
            return redirect("/personal/registration")->with("error", "Oops, your mobile number is not valid.");
        }

        $brgId = "EBB" .  date("ymds") . mt_rand(100000, 999999);

        try {
            $password = mt_rand(10000000, 99999999);
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $brgId;
            $user->mobile = $mobile;
            $user->brgy_id = $brgId;
            $user->password = Hash::make($password);

            if(!$user->save()) {
                return redirect("/personal/registration")->with("error", "Oops, something went wrong.");
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
            $data->is_read = 0;

            if ($data->save()) {
                return redirect("/")->with("message", "Good Job!");
            }
            return redirect("/personal/registration")->with("error", "Oops, something went wrong.");
        } catch (\Exception $e) {
            return redirect("/personal/registration")->with("error", $e->getMessage());
        }


    }

}
