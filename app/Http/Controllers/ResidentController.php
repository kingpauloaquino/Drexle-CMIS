<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use App\Models\Transaction;

use App\Http\Controllers\CertController;
use Carbon\Carbon;
use DB;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function request_certificate()
    {
        $user = \Auth::user();

        if ($user->role != 0) {
            return redirect('/dashboard');
        }

        return view('pages.resident.request');
    }

}
