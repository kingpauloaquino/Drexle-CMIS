@extends('layouts.cert')

@section('content')
<center>
    <table border="0" style="width: 100%; margin-top: 30px; height: 552px;">
        <tr>
            <td style="text-align: center; margin: 0; font-weight: 400; height: 72px;">
                <h3 style="margin: 0; padding: 0;">
                    BARANGAY CERTIFICATION
                </h3>
                <p style="margin: 0; padding: 0;">(First Time Jobseekers Assistance Act-RA11261)</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0; height: 168px;">
                <p style="padding: 0; margin: 0;">
                    To Whom it may concern:<br /><br />

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b>{{ $data["title"] }} {{ $data["fullname"] }}</b>, <b>{{ $data["age"] }}</b> years old, residing at <b>{{ $data["address"] }}, East Bajac – Bajac, Olongapo</b> is a qualified availed of RA 11261 or the First Time Jobseekers Act of 2019.
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 0; height: 139px;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I further certify that the holder/bearer was informed of his/her rights, including the duties and responsibilities accorded by RA 11261 through the Oath of Undertaking he/she has assigned and executed in the presence of our Barangay Official.
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0; height: 84px;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signed this <b>{{ $data["day"] }}</b> day of <b>{{ $data["month"] }}</b>, <b>{{ $data["year"] }}</b> in the City/Municipality of Barangay East Bajac - Bajac.
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </td>
        </tr>
    </table>
</center>
@endsection
