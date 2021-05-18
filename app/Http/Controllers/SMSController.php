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

    public function sendOTP($mobile) {

        $res = $this->prefix($mobile);

        if($res["network_id"] == 4 || $res["network_id"] == 5) {
            return ["status" => 404];
        }

        $mobile = "+63" . substr($mobile, 1, 10);

        $otp = mt_rand(100000, 999999);

        $message = "Brgy EBB! ";
        $message .= "Your code is {$otp} Do not share it with anyone. Thank You!";

        $sms = new SMS();
        $sms->subject = "Sending OTP";
        $sms->mobile = $mobile;
        $sms->message = $message;

        if($sms->save()) {
            return ["status" => 200, "otp" => $otp];
        }

        return ["status" => 500];
    }

    public function sendWelcome($mobile, $firstname, $brgy_id, $password)
    {
        $message = "Welcome {$firstname}! your brgyid: {$brgy_id} and your password: {$password} Do not share it with anyone. Thank You!";

        $sms = new SMS();
        $sms->subject = "Welcome Message";
        $sms->mobile = $mobile;
        $sms->message = $message;

        if ($sms->save()) {
            return ["status" => 200];
        }

        return ["status" => 500];
    }

    public static function prefix($mobile)
    {
        $net = array(
            "network_id" => 5,
            "network_name" => "Invalid mobile number"
        );

        if (strlen($mobile) == 11) {
            switch (substr($mobile, 0, 4)) {
                case "0907":
                case "0908":
                case "0909":
                case "0910":
                case "0911":
                case "0912":
                case "0913":
                case "0914":
                case "0918":
                case "0919":
                case "0920":
                case "0921":
                case "0928":
                case "0929":
                case "0930":
                case "0938":
                case "0939":
                case "0946":
                case "0947":
                case "0948":
                case "0949":
                case "0950":
                case "0951":
                case "0961":
                case "0970":
                case "0981":
                case "0989":
                case "0998":
                case "0999":
                case "0813":
                    $net = array(
                        "network_id" => 1,
                        "network_name" => "SMART"
                    );
                    break;
                case "0905":
                case "0906":
                case "0915":
                case "0916":
                case "0917":
                case "0926":
                case "0927":
                case "0935":
                case "0936":
                case "0937":
                case "0945":
                case "0953":
                case "0954":
                case "0955":
                case "0956":
                case "0965":
                case "0966":
                case "0967":
                case "0975":
                case "0976":
                case "0977":
                case "0978":
                case "0979":
                case "0994":
                case "0995":
                case "0996":
                case "0997":
                case "0817":
                    $net = array(
                        "network_id" => 2,
                        "network_name" => "GLOBE"
                    );
                    break;
                case "0922":
                case "0923":
                case "0924":
                case "0925":
                case "0931":
                case "0932":
                case "0933":
                case "0934":
                case "0940":
                case "0941":
                case "0942":
                case "0943":
                case "0973":
                case "0974":
                    $net = array(
                        "network_id" => 3,
                        "network_name" => "SUN"
                    );
                    break;
                default:
                    $net = array(
                        "network_id" => 4,
                        "network_name" => "Invalid Prefixe"
                    );
                    break;
            }
        }
        return $net;
    }
}
