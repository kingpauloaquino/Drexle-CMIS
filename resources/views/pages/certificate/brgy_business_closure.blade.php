@extends('layouts.business_preview')

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

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that upon actual verification and inspection of this Office, it was found out that the business establishment registered as <br />

                    <b>{{ $data["name"] }}</b>, located at <b>{{ $data["address1"] }}</b> and under the management proprietorship of <b>{{ $data["operator"] }}</b> has ceased its business operation last <b>{{ $data["issued"] }}</b>.
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This certification is being issued upon the request of <b>{{ $data["requestor"] }}</b> for whatever legal intent this may serve.
                </p>
            </td>
        </tr>

    </table>
</center>
@endsection
