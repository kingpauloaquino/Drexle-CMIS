<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;

class PublicController extends Controller
{
    public function personal_registration()
    {
        return view('pages.public.filloutform');
    }

    public function personal_registration_store(Request $request)
    {
        $data = new Residence();
        $data->firstname = $request->firstname;
        $data->middlename = $request->middlename;
        $data->lastname = $request->lastname;
        $data->age = $request->age;
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

        if ($data->save()) {
            return redirect("/personal/registration")->with("message", "Good Job!");
        }
        return redirect("/personal/registration")->with("error", "Oops, something went wrong.");
    }

}
