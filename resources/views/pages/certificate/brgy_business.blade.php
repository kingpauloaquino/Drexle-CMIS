@extends('layouts.business_preview')

@section('content')
<center>
    <table border="0" style="width: 100%; margin-top: 11px; height: 552px;">
        <tr>
            <td style="text-align: center; margin: 0;">
                <table border="0" style="width: 100%; margin: 0;" cellpadding="5">
                    <tr>
                        <td style="text-align: left;">
                            <p style="padding: 0; margin: 0; font-size: 14px;">
                                @if($data["renewal"] == 0)
                                <img src="https://icons.iconarchive.com/icons/graphicloads/100-flat-2/16/check-1-icon.png" />
                                @else
                                <img src="https://icons.iconarchive.com/icons/graphicloads/100-flat-2/16/multiply-icon.png" />
                                @endif New Business
                            </p>
                            <p style="padding: 0; margin: 0; font-size: 14px;">
                                @if($data["renewal"] == 1)
                                <img src="https://icons.iconarchive.com/icons/graphicloads/100-flat-2/16/check-1-icon.png" />
                                @else
                                <img src="https://icons.iconarchive.com/icons/graphicloads/100-flat-2/16/multiply-icon.png" />
                                @endif Renewal
                            </p>
                        </td>
                        <td style="width: 250px;">
                            <p style="padding: 10px; margin: 0; font-size: 14px; border: 1px solid gray; text-align:center;">EBB-BPI-{{ date("Y") }}-{{ $data["code"] }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; margin: 10px 0 0 0; font-weight: 400;">
                <h3 style="margin: 0; padding: 0;">
                    INDORSEMENT
                </h3>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px;">
                <p style="padding: 0; margin: 0;">
                    THIS IS TO INDORSE
                </p>
            </td>
        </tr>

        <tr>
            <td style="text-align: center;">
                <p style="padding: 10px; margin: 0;">
                    <b>{{ $data["name"] }}</b><br />
                    (Business Name of Trade Activity)
                </p>
            </td>
        </tr>

        <tr>
            <td style="text-align: center;">
                <p style="padding: 10px; margin: 0;">
                    <b>{{ $data["address1"] }}</b><br />
                    (Location)
                </p>
            </td>
        </tr>

        <tr>
            <td style="text-align: center;">
                <p style="padding: 10px; margin: 0;">
                    <b>{{ $data["operator"] }}</b><br />
                    (Operator/Manager)
                </p>
            </td>
        </tr>

        <tr>
            <td style="text-align: center;">
                <p style="padding: 10px; margin: 0;">
                    <b>{{ $data["address2"] }}</b><br />
                    (Address)
                </p>
            </td>
        </tr>

        <tr>
            <td style="text-align: center;">
                <p style="padding: 5px; margin: 0; font-size: 14px; text-align: left;">Applying for the corresponding BUSINESS PERMIT that has been found to be:</p>
                <table border="0" style="width: 100%; margin: 0;" cellpadding="5">
                    <tr>
                        <td style="text-align: center; width: 30px;">
                            <p style="padding: 0; margin: 0; font-size: 14px;"> <input type="checkbox" checked /></p>
                        </td>
                        <td>
                            <p style="padding: 0; margin: 0; font-size: 14px; text-align:left;">
                                <b>COMPLAINT</b> with the provisions of existing Barangay Ordinance, rules and regulations being enforced in the barangay;
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; width: 30px;">
                            <p style="padding: 0; margin: 0; font-size: 14px;"> <input type="checkbox" /></p>
                        </td>
                        <td>
                            <p style="padding: 0; margin: 0; font-size: 14px; text-align:left;">
                                <b>NON-COMPLAINT</b> with the provisions of existing Barangay Ordinance, rules and regulations being enforced in this barangay;
                            </p>
                        </td>
                    </tr>
                </table>

                <p style="padding: 0; margin: 0; font-size: 14px; text-align: left;">Applying for the corresponding BUSINESS PERMIT that has been found to be:</p>
                <table border="0" style="width: 100%; margin: 0;" cellpadding="5">
                    <tr>
                        <td style="text-align: center; width: 30px;">
                            <p style="padding: 0; margin: 0; font-size: 14px;"> <input type="checkbox" checked /></p>
                        </td>
                        <td>
                            <p style="padding: 0; margin: 0; font-size: 14px; text-align:left;">
                                <b>Interposes NO OBJECTION</b> for the issuance of the corresponding Mayor’s Permit being applied for.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; width: 30px;">
                            <p style="padding: 0; margin: 0; font-size: 14px;"> <input type="checkbox" /></p>
                        </td>
                        <td>
                            <p style="padding: 0; margin: 0; font-size: 14px; text-align:left;">
                                <b>Recommendation for the NON-ISSUANCE</b> of the corresponding Mayor’s Permit being applied for.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</center>
@endsection
