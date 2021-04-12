<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
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

        <div class="mt-5 p-2">
            @yield('content')
        </div>

        <table border="0" style="width: 730px; margin-top: 30px">
            <tr>
                <td style="text-align: right;">
                    <p style="padding: 0; margin: 0;">
                        <b>GILBERT G. PIÑERO</b> <br /> Punong Barangay
                    </p>
                </td>
            </tr>
            <tr>
                <td class="text-center">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    <p style="padding: 0; margin: 0;">
                        Date
                    </p>
                </td>
            </tr>
            <tr>
                <td class="text-center">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    <p style="padding: 0; margin: 0; ">
                        Witnessed by:
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
