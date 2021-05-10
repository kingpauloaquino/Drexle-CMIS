<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Dompdf\Dompdf;
use File;
use Carbon\Carbon;



class CertController extends Controller
{
    private function random_number($length = 12)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function bgry_indigency_pdf($resident, $pdf = false)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;

        $data = [
            "control_number" => "Control#: " . $this->SerializeNumber($resident->id),
            "title" => $title,
            "fullname" => ucwords(strtolower($fullname)),
            "age" => $resident->age,
            "address" => $resident->address1 . " " . $resident->address2,
            "day" => date("d"),
            "month" => date("M"),
            "year" => date("Y"),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        view()->share('data', $data);

        $html = view('pages.certificate.brgy_indigency', $data)->render();

        if (!$pdf) {
            return $html;
        }

        return $this->toPDF($html, $this->random_number(),"brg-clearance-indigency", $pdf);
    }

    public function bgry_residency_preview($uid, Request $request)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $home = new HomeController();

        $resident = $home->get_resident($uid);
        $resident = $resident["data"];

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        if ($resident->middlename == "N/A") {
            $fullname = $resident->firstname . " " . $resident->lastname;
        }

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;
        $gender = $resident->gender == 1 ? ["a" => "he", "b" => "his"] : ["a" => "she", "b" => "her"];

        $requestor = isset($request->requestor) ? $request->requestor : null;
        $purpose = $request->purpose;
        $remark = $request->remark;

        $data = [
            "uid" => $uid,
            "method" => "residency",
            "control_number" => $this->SerializeNumber($resident->id),
            "title" => $title,
            "fullname" => ucwords(strtolower($fullname)),
            "age" => $resident->age,
            "gender" => $gender,
            "address" => $resident->address1 . " " . $resident->address2,
            "requestor" => $requestor,
            "purpose" => $purpose,
            "remark" => $remark,
            "issued" => Carbon::now()->format('F j, Y'),
            "valid" => Carbon::now()->addMonth(1)->format('F j, Y'),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        return view('pages.certificate.brgy_residency', compact('data'));
    }

    public function bgry_soloparent_preview($uid, Request $request)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $home = new HomeController();

        $resident = $home->get_resident($uid);
        $resident = $resident["data"];

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        if ($resident->middlename == "N/A") {
            $fullname = $resident->firstname . " " . $resident->lastname;
        }

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;
        $gender = $resident->gender == 1 ? ["a" => "he", "b" => "his"] : ["a" => "she", "b" => "her"];

        $requestor = IsSet($request->requestor) ? $request->requestor : null;
        $purpose = $request->purpose;
        $remark = $request->remark;

        $data = [
            "uid" => $uid,
            "method" => "soloparent",
            "control_number" => $this->SerializeNumber($resident->id),
            "title" => $title,
            "fullname" => ucwords(strtolower($fullname)),
            "age" => $resident->age,
            "gender" => $gender,
            "address" => $resident->address1 . " " . $resident->address2,
            "requestor" => $requestor,
            "purpose" => $purpose,
            "remark" => $remark,
            "issued" => Carbon::now()->format('F j, Y'),
            "valid" => Carbon::now()->addMonth(1)->format('F j, Y'),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        return view('pages.certificate.brgy_indigency', compact('data'));
    }

    public function bgry_indigency_preview($uid, Request $request)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $home = new HomeController();

        $resident = $home->get_resident($uid);
        $resident = $resident["data"];

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        if ($resident->middlename == "N/A") {
            $fullname = $resident->firstname . " " . $resident->lastname;
        }

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;
        $gender = $resident->gender == 1 ? ["a" => "he", "b" => "his"] : ["a" => "she", "b" => "her"];

        $requestor = isset($request->requestor) ? $request->requestor : null;
        $purpose = $request->purpose;
        $remark = $request->remark;

        $data = [
            "uid" => $uid,
            "method" => "indigency",
            "control_number" => $this->SerializeNumber($resident->id),
            "title" => $title,
            "fullname" => ucwords(strtolower($fullname)),
            "age" => $resident->age,
            "gender" => $gender,
            "address" => $resident->address1 . " " . $resident->address2,
            "requestor" => $requestor,
            "purpose" => $purpose,
            "remark" => $remark,
            "issued" => Carbon::now()->format('F j, Y'),
            "valid" => Carbon::now()->addMonth(1)->format('F j, Y'),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        return view('pages.certificate.brgy_indigency', compact('data'));
    }

    public function bgry_clearance_preview($uid, Request $request)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');


        $home = new HomeController();

        $resident = $home->get_resident($uid);
        $resident = $resident["data"];

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        if ($resident->middlename == "N/A") {
            $fullname = $resident->firstname . " " . $resident->lastname;
        }

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;
        $gender = $resident->gender == 1 ? ["a" => "he", "b" => "his"] : ["a" => "she", "b" => "her"];

        $requestor = isset($request->requestor) ? $request->requestor : null;
        $purpose = $request->purpose;
        $remark = $request->remark;

        $data = [
            "uid" => $uid,
            "method" => "bgryclearance",
            "control_number" => $this->SerializeNumber($resident->id),
            "title" => $title,
            "fullname" => ucwords(strtolower($fullname)),
            "age" => $resident->age,
            "gender" => $gender,
            "address" => $resident->address1 . " " . $resident->address2,
            "requestor" => $requestor,
            "purpose" => $purpose,
            "remark" => $remark,
            "issued" => Carbon::now()->format('F j, Y'),
            "valid" => Carbon::now()->addMonth(1)->format('F j, Y'),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        return view('pages.certificate.brgy_clearance', compact('data'));
    }

    public function bgry_jobseeker_preview($uid, Request $request)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');


        $home = new HomeController();

        $resident = $home->get_resident($uid);
        $resident = $resident["data"];

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        if ($resident->middlename == "N/A") {
            $fullname = $resident->firstname . " " . $resident->lastname;
        }

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;
        $gender = $resident->gender == 1 ? ["a" => "he", "b" => "his"] : ["a" => "she", "b" => "her"];

        $requestor = isset($request->requestor) ? $request->requestor : null;
        $purpose = $request->purpose;
        $remark = $request->remark;

        $data = [
            "uid" => $uid,
            "method" => "jobseeker",
            "control_number" => $this->SerializeNumber($resident->id),
            "title" => $title,
            "fullname" => ucwords(strtolower($fullname)),
            "age" => $resident->age,
            "gender" => $gender,
            "address" => $resident->address1 . " " . $resident->address2,
            "requestor" => $requestor,
            "purpose" => $purpose,
            "remark" => $remark,
            "day" => date("d"),
            "month" => date("M"),
            "year" => date("Y"),
            "issued" => Carbon::now()->format('F j, Y'),
            "valid" => Carbon::now()->addMonth(1)->format('F j, Y'),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        return view('pages.certificate.brgy_firstjobseeker', compact('data'));
    }

    public function bgry_business_preview($uid, Request $request)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $home = new HomeController();

        $resident = $home->get_resident($uid);
        $resident = $resident["data"];

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        if ($resident->middlename == "N/A") {
            $fullname = $resident->firstname . " " . $resident->lastname;
        }

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;
        $gender = $resident->gender == 1 ? ["a" => "he", "b" => "his"] : ["a" => "she", "b" => "her"];

        $data = [
            "buid" => 0,
            "uid" => $uid,
            "method" => "businesspermit",
            "control_number" => $this->SerializeNumber($resident->id),
            "renewal" => (int)$request->renewal,
            "code" => $request->bcode,
            "name" => ucwords(strtolower($request->bname)),
            "address1" => $request->baddresss,
            "address2" => $request->raddress,
            "operator" => ucwords(strtolower($request->operator)),
            "issued" => Carbon::now()->format('F j, Y'),
            "valid" => Carbon::now()->addMonth(12)->format('F j, Y'),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        return view('pages.certificate.brgy_business', compact('data'));
    }

    public function bgry_business_closure_preview($buid)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $home = new HomeController();

        $business_details = Transaction::where("id", $buid)->first();

        $resident = $home->get_resident($business_details->residence_uid);
        $resident = $resident["data"];

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        if ($resident->middlename == "N/A") {
            $fullname = $resident->firstname . " " . $resident->lastname;
        }

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;
        $gender = $resident->gender == 1 ? ["a" => "he", "b" => "his"] : ["a" => "she", "b" => "her"];

        $data = [
            "buid" => $buid,
            "uid" => $business_details->residence_uid,
            "method" => "businessclosure",
            "control_number" => $this->SerializeNumber($resident->id),
            "renewal" => 0,
            "code" => $business_details->business_code,
            "name" => $business_details->business_name,
            "address1" => $business_details->business_address,
            "address2" => $business_details->business_residence_address,
            "requestor" => $fullname,
            "operator" => $business_details->business_operator,
            "issued" => $business_details->date_issued,
            "valid" => $business_details->date_issued,
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        return view('pages.certificate.brgy_business_closure', compact('data'));
    }

    public static function SerializeNumber($count)
    {
        if ($count >= 0 && $count <= 9) {
            $count = "000" . $count;
        } else if ($count >= 10 && $count <= 99) {
            $count = "00" . $count;
        } else if ($count >= 99 && $count <= 999) {
            $count = "0" . $count;
        } else if ($count >= 999 && $count <= 9999) {
            $count = $count;
        }
        return $count;
    }

    public function bgry_clearance_pdf($resident, $pdf = false)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        $misis = "Ms.";
        if((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;

        $data = [
            "control_number" => "Control#: " . $this->SerializeNumber($resident->id),
            "title" => $title,
            "fullname" => ucwords(strtolower($fullname)),
            "age" => $resident->age,
            "address" => $resident->address,
            "day" => date("d"),
            "month" => date("M"),
            "year" => date("Y"),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        view()->share('data', $data);

        $html = view('pages.certificate.brgy_clearance', $data)->render();

        if (!$pdf) {
            return $html;
        }

        return $this->toPDF($html, $this->random_number(),"brg-clearance", $pdf);
    }

    public function first_time_jobseekers_generate($resident, $pdf = false)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;

        $misis = "Ms.";
        if ((int)$resident->civil_status > 1) {
            $misis = "Mrs.";
        }

        $title = $resident->gender == 1 ? "Mr." : $misis;

        $data = [
            "control_number" => "Control#: " . $this->SerializeNumber($resident->id),
            "title" => $title,
            "fullname" => ucwords(strtolower($fullname)),
            "age" => $resident->age,
            "address" => $resident->address,
            "day" => date("d"),
            "month" => date("M"),
            "year" => date("Y"),
            "img_a"=> $img_a,
            "img_b" => $img_b
            ];

        view()->share('data', $data);

        $html = view('pages.certificate.brgy_firstjobseeker', $data)->render();

        if(!$pdf) {
            return $html;
        }

        return $this->toPDF($html, $this->random_number(), "brg-firstimejobseeker", $pdf);
    }

    public function business_permit_generate($resident, Request $request, $pdf = false)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $business = [
            "name" => ucwords(strtolower($request->bname)),
            "address1" => $request->baddresss,
            "address2" => $request->raddress,
            "operator" => ucwords(strtolower($request->operator))
        ];

        $data = [
            "control_number" => "Control#: " . $this->SerializeNumber($resident->id),
            "renewal" => false,
            "name" => ucwords(strtolower($request->bname)),
            "address1" => $request->baddresss,
            "address2" => $request->raddress,
            "operator" => ucwords(strtolower($request->operator)),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        view()->share('data', $data);

        $html = view('pages.certificate.business', $data)->render();


        if (!$pdf) {
            return ["html" => $html, "business" => $business];
        }

        return $this->toPDF($html, $this->random_number(), "brg-businesspermit", $pdf);
    }

    private function toPDF($html, $filename, $prefix, $pdf) {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->render();

        if($pdf) {
            $dompdf->stream($filename, array("Attachment" => 0));
            return array(
                "status" => 200
            );
        }

        $output = $dompdf->output();

        $file_name = "{$prefix}-{$filename}";

        $destinationPath = public_path() . "/download/" . $file_name . ".pdf";

        File::put($destinationPath, $output);

        $urlDownload = url('/download/' . $file_name . '.pdf');
        return array(
            "status" => 200,
            "url" => $urlDownload
        );
    }
}
