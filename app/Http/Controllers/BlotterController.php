<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blotter;

class BlotterController extends Controller
{
    //

    public function create() {
        return view('pages.blotter.create');
    }

    public function store(Request $request)
    {
        $blotter = new Blotter();
        $blotter->subject = $request->subject;
        $blotter->complainant_name = $request->complainant;
        $blotter->suspect_name = $request->suspect;
        $blotter->description = $request->description;
        $blotter->status = $request->status;

        if($blotter->save()) {
            return redirect("/blotter/create")->with("message", "Submitted!");
        }

        return redirect("/blotter/create")->with("error", "Oops, something went wrong.");


    }

    public function view_list()
    {
        $blotters = Blotter::get();
        return view('pages.blotter.view', compact('blotters'));
    }

    public function update_status(Request $request)
    {
        $blotters = Blotter::where("id", $request->uid)->update(["status" => $request->status]);

        return ["status" => $blotters ? 200 : 500];
    }
}
