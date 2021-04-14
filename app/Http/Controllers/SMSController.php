<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KPAWork\MSG4wrdIO\Http\Controllers\MSG4wrdIOController;

class SMSController extends Controller
{
    //

    public function SMSSend() {
        $msg4wrd = new MSG4wrdIOController();
        $res = $msg4wrd->SendMessage("+639177715390", "test");
        return $res;
    }
}
