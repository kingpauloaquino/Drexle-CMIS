@extends('layouts.cert')

@section('content')
<center>
    <table border="0" style="width: 730px;">
        <tr>
            <td class="text-center">
                <h3 style="margin: 0; padding: 0;">
                    BARANGAY CERTIFICATION
                </h3>
                <p> (First Time Jobseekers Assistance Act-RA11261)</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b>{{ $data["title"] }} {{ $data["fullname"] }}</b>, <b>{{ $data["age"] }}</b> years old, a resident of <b>{{ $data["address"] }}</b>, East Bajac – Bajac, Olongapo City is a qualified availed of <b>RA 11261</b> or the <b>First Time Jobseekers Act of 2019</b>.
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I further certify that the holder/bearer was informed of his/her rights, including the duties and responsibilities accorded by <b>RA 11261</b> through the <b>Oath of Undertaking</b> he/she has assigned and executed in the presence of our Barangay Official.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="padding: 0 0 0 50px; margin: 0;">
                    Signed this <b>{{ $data["day"] }}</b> day of <b>{{ $data["month"] }}</b>, <b>{{ $data["year"] }}</b> in the City/Municipality of Barangay East Bajac - Bajac.
                </p>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <p style="padding: 0; margin: 0;">
                    This certification is valid only for one (1) year from the issuance.
                </p>
            </td>
        </tr>
    </table>
</center>
@endsection
