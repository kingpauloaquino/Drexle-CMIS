<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use PDF;
use File;


class CertController extends Controller
{
    public function bgry_clearance(){
        $data = ["title" => "Mr.", "fullname" => "King Paulo Aquino"];
        return view("pages.certificate.brgy_clearance", compact('data'));

    }

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
    public function bgry_clearance_pdf(Request $request, $isHTMLView = null)
    {

    }

    public function first_time_jobseekers_generate($resident, $isHTMLView = null)
    {
        // $img_a = $isHTMLView != null ? asset('/img/city-logo.png') : public_path() . "/img/city-logo.png";
        // $img_b = $isHTMLView != null ? asset('/img/city-logo.png') : public_path() . "/img/city-logo.png";

        $img_a = $isHTMLView != null ? asset('/img/city-logo.png') : asset('/img/city-logo.png');
        $img_b = $isHTMLView != null ? asset('/img/city-logo.png') : asset('/img/city-logo.png');

        $fullname = $resident->firstname . " " . $resident->middlename . " " . $resident->lastname;
        $title = $resident->gender == 1 ? "Mr." : "Mrs.";

        $data = [
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
        $html = view('pages.certificate.brgy_clearance', $data)->render();


        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->render();

        $output = $dompdf->output();

        $random_number = $this->random_number();

        $file_name = "brg-clearance-{$random_number}";

        $destinationPath = public_path() . "/download/" . $file_name . ".pdf";
        File::put($destinationPath, $output);

        $urlDownload = url('/download/' . $file_name .'.pdf');
        return array(
            "status" => 200,
            "url" => $urlDownload
        );
    }
}
