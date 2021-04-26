@extends('layouts.cert2')

@section('content')
<center>
    <table border="0" style="width: 730px;">
        <tr>
            <td class="text-center">
                <h3 style="margin: 0; padding: 0;">
                    CERTIFICATION
                </h3>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    To Whom it may concern:<br /><br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b>{{ $data["title"] }} {{ $data["fullname"] }}</b>, legal age, presently residing at <b>{{ $data["address"] }}</b>, East Bajac – Bajac, Olongapo is is a bonafide resident of this Barangay.
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This further certify that the above-named person has no record of complaints filed against him/her at the Katarungang Pambarangay of this office as of this date.
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="padding: 0 0 0 50px; margin: 0;">
                    Signed this <b>{{ $data["day"] }}</b> day of <b>{{ $data["month"] }}</b>, <b>{{ $data["year"] }}</b> at the Barangay Hall of East Bajac – Bajac, Olongapo City.
                </p>
            </td>
        </tr>
        <tr>
            <td class="text-center">
                &nbsp;
            </td>
        </tr>
    </table>
</center>
@endsection