<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use Carbon\Carbon;
use DB;

class PublicController extends Controller
{
    public function personal_registration()
    {
        return view('pages.public.filloutform');
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

        $middlename = strlen($request->middlename) > 0 ? $request->middlename : " ";

        try {
            $data = new Residence();
            $data->id_number = $request->id_number;
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
            $data->mobile = $request->mobile;
            $data->work = $request->work;
            $data->skill = $request->skill;
            $data->schedule = $request->schedule;
            $data->purpose = $request->purpose;
            $data->is_read = 0;

            if ($data->save()) {
                return redirect("/personal/registration")->with("message", "Good Job!");
            }
            return redirect("/personal/registration")->with("error", "Oops, something went wrong.");
        } catch (\Exception $e) {
            return redirect("/personal/registration")->with("error", $e->getMessage());
        }


    }

}
