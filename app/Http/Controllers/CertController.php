<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use PDF;
use File;


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
        if ((int)$resident->civil_status >1) {
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

    public function business_permit_generate($resident, $pdf = false)
    {
        $img_a = asset('/img/barangay-logo.png');
        $img_b = asset('/img/city-logo.png');

        $data = [
            "control_number" => "Control#: " . $this->SerializeNumber($resident->id),
            "renewal" => false,
            "name" => ucwords(strtolower($resident->bname)),
            "address1" => $resident->baddresss,
            "address2" => $resident->raddress,
            "operator" => ucwords(strtolower($resident->operator)),
            "img_a" => $img_a,
            "img_b" => $img_b
        ];

        view()->share('data', $data);

        $html = view('pages.certificate.business', $data)->render();

        if (!$pdf) {
            return $html;
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
