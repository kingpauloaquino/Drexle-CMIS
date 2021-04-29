@extends('layouts.cert2')

@section('content')
<center>
    <table border="0" style="width: 510px; margin-top: 30px;">
        <tr>
            <td class="text-center">
                <h3 style="margin: 0; padding: 0;">
                    CERTIFICATION OF INDIGENCY
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This further certifies that the above-named person belongs to the <b>INDIGENT</b> families of this barangay.
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This certification is being issued upon the request of the above-named person, intended for
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
