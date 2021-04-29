<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BARANGAY CERTIFICATE PREVIEW</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.js" integrity="sha512-/fgTphwXa3lqAhN+I8gG8AvuaTErm1YxpUjbdCvwfTMyv8UZnFyId7ft5736xQ6CyQN4Nzr21lBuWWA9RTCXCw==" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style>
        html,
        body {
            background-color: #fff;
        }

        .container-1 {
            width: 760px;
            /* border: 1px solid gray; */
            background-color: #fff;
        }

        table tr td {
            text-align: justify;
        }
    </style>
</head>

<body>

    <div class="container-1">

        <table border="0" style="width: 730px;">
            <tr>
                <td style="width: 150px;">
                    <center>
                        <img src="{{ $data['img_a'] }}" style="width: 128px; margin-top: 15px" />
                    </center>
                </td>
                <td>
                    <h4 class="text-center mt-3">REPUBLIC OF THE PHILIPPINES</h4>
                    <h4 class="text-center mt-2">CITY OF OLONGAPO</h4>
                    <h4 class="text-center mt-2">BARANGAY EAST BAJAC-BAJAC</h4>
                </td>
                <td style="width: 150px;">
                    <center>
                        <img src="{{ $data['img_b'] }}" style="width: 128px; margin-top: 15px" />
                    </center>
                </td>
            </tr>
        </table>

        <table border="0" style="width: 730px;">
            <tr>
                <td valign="top" style="width: 200px;">
                    <table border="0" style="width: 200px; background-color:aquamarine; margin-top: 20px;">
                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 18px; padding: 0; margin: 0; font-weight: 600;">Barangay Officials<br /><small style="font-size: 10px; padding: 0; margin: 0;">2018-2021</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. GILBERT G. PIÑERO</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">PUNONG BARANGAY</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. ERICK JAYSON Y. CANO</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. RYAN KRISTOFER P. ALBAY</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. REYNALYN E. TABLAN</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. ROMEO G. MANALANG</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. NELSON B. YCO</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. OLIVER P. GUERRERO</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. BERGEL A. LAGMAN</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">SK CHAIRPERSON</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. JUANITO R. FABABIER</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">SECRETARY</small></h3>
                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;">
                                <h3 style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>HON. ARIS C. BANIQUED</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">TREASURER</small></h3>
                            </td>
                        </tr>

                    </table>
                    <table border="0" style="width: 200px;">
                        <tr>
                            <td class="text-center">
                                <p style="font-size: 12px; padding: 0; margin: 10px 0 0 0;"><b>{{ $data["control_number"] }}</b></p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="top">
                    <div class="p-2">
                        @yield('content')
                    </div>

                    <table border="0" style="width: 500px; margin-top: 30px">
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: center; width: 200px;">
                                <p style="padding: 0; margin: 0;">
                                    <b>GILBERT G. PIÑERO</b>
                                </p>
                                <p style="padding: 0; margin: -9px 0 0 0;">
                                    Punong Barangay
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: center; width: 200px;">
                                <p style="padding: 0; margin: 0;">
                                    Date
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: center; width: 200px;">
                                <p style="padding: 0; margin: 0;">
                                    Witnessed by:
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
