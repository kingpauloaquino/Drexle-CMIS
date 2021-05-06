@extends('layouts.cert_preview')

@section('content')
<center>
    <table border="0" style="width: 100%; margin-top: 30px; height: 552px;">
        <tr>
            <td style="text-align: center; margin: 0; font-weight: 400;">
                <h3 style="margin: 0; padding: 0;">
                    CERTIFICATION
                </h3>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    To Whom it may concern:<br /><br />

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b>{{ $data["title"] }} {{ $data["fullname"] }}</b>, <b>{{ $data["age"] }}</b> years old, residing at <b>{{ $data["address"] }}, East Bajac – Bajac, Olongapo</b> is a bonafide resident and law-abiding citizen of this Community.
                </p>
            </td>
        </tr>

        <tr>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This certification is being issued upon the request of the above said person for <b>{{ $data["purpose"] }}</b> purposes.
                </p>
            </td>
        </tr>

        <tr>
            <td class="text-center">
                <table border="0" style="width: 100%; margin: 10px 0 0 0;">
                    <tr>
                        <td style="width: 228px;">
                            <center>
                                <img src="https://icons.iconarchive.com/icons/hopstarter/soft-scraps/128/User-Administrator-Blue-icon.png" style="border: 2px solid gray;" />
                                <br />
                                <br />
                                <p>Signature</p>
                            </center>
                        </td>

                        <td>
                            <h3 style="font-size: 12pt; font-weight: 700;">Barangay ID:</h3>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</center>
@endsection
