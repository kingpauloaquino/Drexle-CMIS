<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KPAWork\MSG4wrdIO\Http\Controllers\MSG4wrdIOController;
use App\Models\Residence;
use App\Models\SMS;

class SMSController extends Controller
{
    public function init()
    {
        return view('pages.sms.form');
    }

    public function execute(Request $request)
    {
        $subject = $request->subject;
        $message = $request->message;
        $recipients = (int)$request->recipients;
        $custom = $request->custom;

        if (strlen($subject) == 0) {
            return redirect("/sms-advisory")->with("error", "Oops, please enter the subject.");
        }

        if (strlen($message) == 0) {
            return redirect("/sms-advisory")->with("error", "Oops, message minimum character is 10.");
        }

        if (strlen($message) > 160) {
            return redirect("/sms-advisory")->with("error", "Oops, message maximum character is 160.");
        }

        if($recipients == 0) {
            return redirect("/sms-advisory")->with("error", "Oops, please select recipients.");
        }

        if($recipients == 1) {
            $residence = Residence::get();
            for ($i = 0; $i < COUNT($residence); $i++) {
                $sms = new SMS();
                $sms->subject = $subject;
                $sms->mobile = $residence[$i]->mobile;
                $sms->message = $message;
                $sms->save();
            }
        }
        else {
            $customs = explode(",", $custom);
            for ($i = 0; $i < COUNT($customs); $i++) {
                $sms = new SMS();
                $sms->subject = $subject;
                $sms->mobile = $customs[$i];
                $sms->message = $message;
                $sms->save();
            }
        }

        return redirect("/sms-advisory")->with("message", "Submitted!");
    }

    public function sms_list()
    {
        $data = SMS::get();
        return view('pages.sms.view', compact('data'));
    }

    public function SMSSend() {
        $msg4wrd = new MSG4wrdIOController();
        $res = $msg4wrd->SendMessage("+639177715390", "test");
        return $res;
    }
}
