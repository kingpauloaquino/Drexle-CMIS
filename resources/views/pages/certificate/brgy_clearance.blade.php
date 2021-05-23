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

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that the person whose name, picture and signature print appear hereon has requested a certification from this office and the result are listed below.
                    <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b>{{ $data["title"] }} {{ $data["fullname"] }}</b>, <b>{{ $data["age"] }}</b> years old, residing at <b>{{ $data["address"] }}, East Bajac – Bajac, Olongapo</b> is a bonafide resident and law-abiding citizen of this Community. -->
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 10px;">
                <table border="0" style="width: 100%; margin: 10px 0 0 0;" cellpadding="5">
                    <tr>
                        <td>Name:</td>
                        <td><b>{{ $data["title"] }} {{ $data["fullname"] }}</b></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><b>{{ $data["address"] }}, East Bajac – Bajac, Olongapo</b></td>
                    </tr>
                    <tr>
                        <td>Purpose:</td>
                        <td><b>{{ $data["purpose"] }}</b></td>
                    </tr>
                    <tr>
                        <td>Remark:</td>
                        <td><b>{{ $data["remark"] }}</b></b></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td class="text-center">
                <table border="0" style="width: 100%; margin: 10px 0 0 0;">
                    <tr>
                        <td style="width: 228px;">
                            <center>
                                <img src="{{ asset($data['image']) }}" style="border: 2px solid gray; margin: 10px 0 0 0;  width: 128px; height: 128px;" />
                                <br />
                                <br />
                                <p>Signature</p>
                            </center>
                        </td>

                        <td valign=" top">
                            <center>
                                <table border="0" style="width: 300px; margin: 10px 0 0 0;">
                                    <tr>
                                        <td>
                                            <p style="text-align: center;">Left Thumb</p>
                                            <div style="margin: 0 auto; width: 110px; height: 110px; background-color: #F8FDD0; border: 2px solid gray;"></div>
                                        </td>
                                        <td>
                                            <p style="text-align: center;">Right Thumb</p>
                                            <div style="margin: 0 auto; width: 110px; height: 110px; background-color: #F8FDD0; border: 2px solid gray;"></div>

                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</center>
@endsection
