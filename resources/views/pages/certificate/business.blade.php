@extends('layouts.cert2')

@section('content')
<center>
    <table border="0" style="width: 510px; margin-top: 30px; text-align: center;">
        <tr>
            <td class="text-center">
                <h3 style="margin: 0; padding: 0;">
                    BUSINESS PERMIT
                </h3>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    THIS IS TO ENDORSE
                </p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <p style="padding: 0; margin: 0;">
                    <b>{{ $data["name"] }}</b><br />
                    (Business Name of Trade Activity)
                </p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <p style="padding: 0; margin: 15px 0 0 0;">
                    <b>{{ $data["address1"] }}</b><br />
                    (Business Address)
                </p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <p style="padding: 0; margin: 15px 0 0 0;">
                    <b>{{ $data["operator"] }}</b><br />
                    (Operator / Manager)
                </p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <p style="padding: 0; margin: 15px 0 0 0;">
                    <b>{{ $data["address2"] }}</b><br />
                    (Residence Address)
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
