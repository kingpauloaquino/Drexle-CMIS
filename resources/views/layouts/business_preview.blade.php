<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" media="screen" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link media="screen" rel="preconnect" href="https://fonts.gstatic.com">
    <link media="screen" href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link media="screen" href="{{ asset('/css/print.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

    <script>
        var uid = "{{ $data['uid'] }}";
        var cid = "{{ $data['cid'] }}";

        function do_save_print(element) {
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (method == "businessclosure") {

                    var buid = "{{ $data['buid'] }}";

                    data = {
                        buid: buid
                    };

                    $.ajax({
                        dataType: 'json',
                        type: "GET",
                        url: "/brgy/clearance/closure/print",
                        data: data,
                        beforeSend: function() {
                            $(".btnPrint").empty().prepend("<span class='spinner-border spinner-border-sm'></span> Please wait...");
                        }
                    }).done(function(res) {
                        if (res.status == 200) {
                            printdiv(element);
                        } else {
                            alert("Something went wrong.");
                        }
                        $(".btnPrint").empty().prepend("Print");
                    });

                    return false;
                }

                data = {
                    uid: uid,
                    cid: cid,
                };

                $.ajax({
                    dataType: 'json',
                    type: "GET",
                    url: "/brgy/clearance/save/print",
                    data: data,
                    beforeSend: function() {
                        $(".btnPrint").empty().prepend("<span class='spinner-border spinner-border-sm'></span> Please wait...");
                    }
                }).done(function(res) {
                    if (res.status == 200) {
                        printdiv(element);
                    } else {
                        alert("Something went wrong.");
                    }
                    $(".btnPrint").empty().prepend("Print");
                });
            });
        }

        function printdiv(printpage) {
            var headstr = "<html><head><meta charset='UTF-8'>";
            headstr += "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            headstr += "<meta http-equiv='X-UA-Compatible' content='ie=edge'>";
            headstr += "<link rel='stylesheet' media='screen' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css'>";
            headstr += "<link media='screen' rel='preconnect' href='https://fonts.gstatic.com'>";
            headstr += "<link media='screen' href='https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap' rel='stylesheet'>";
            headstr += "<link media='screen' href='{{ asset('css/print.css') }}' rel='stylesheet'>";
            headstr += "<title></title><style>body { -webkit-print-color-adjust: exact !important; }</style></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
        }
    </script>
</head>

<body>

    @if(!IsSet($_GET["show"]))
    <div style="margin: 0 auto; width: 949px;">
        <div style="padding: 10px 0 10px 0;">
            <button class="btnPrint btn btn-danger" onclick="do_save_print('cert');">Print</button>
        </div>
    </div>
    @else
    <div style="margin: 0 auto; width: 949px;">
        <div style="padding: 10px 0 10px 0;">

        </div>
    </div>
    @endif

    <center>
        <div id="cert" class="container1">
            <div>

                <center>
                    <table border="0" style="width: 850px;">
                        <tr>
                            <td style="width: 150px;">
                                <center>
                                    <img src="{{ $data['img_a'] }}" style="width: 128px; margin-top: 15px" />
                                </center>
                            </td>
                            <td>
                                <h4 style="text-align: center; margin: 22px 0 0 0; font-weight: 400;">REPUBLIC OF THE PHILIPPINES</h4>
                                <h4 style="text-align: center; margin: 0 0 0 0; font-weight: 400;">CITY OF OLONGAPO</h4>
                                <h4 style="text-align: center; margin: 0 0 0 0; font-weight: 400;">BARANGAY EAST BAJAC-BAJAC</h4>
                                <h4 style="text-align: center; margin: 24px  0 0 0; font-weight: 700;">OFFICE OF THE PUNONG BARANGAY</h4>
                            </td>
                            <td style="width: 150px;">
                                <center>
                                    <img src="{{ $data['img_b'] }}" style="width: 128px; margin-top: 15px" />
                                </center>
                            </td>
                        </tr>
                    </table>
                </center>

                <table border="0" style="width: 100%;">
                    <tr>
                        <td valign="top" style="width: 250px; height: 100%;">
                            <center>
                                <table border="0" bgcolor="#06E8D7" style="width: 250px; background-color: #06E8D7; margin-top: 20px;">
                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 18px; padding: 0; margin: 5px 0 0 0; font-weight: 600;">Barangay Officials<br /><small style="font-size: 10px; padding: 0; margin: 0;">2018-2021</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. GILBERT G. PIÑERO</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">PUNONG BARANGAY</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. ERICK JAYSON Y. CANO</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. RYAN KRISTOFER P. ALBAY</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. REYNALYN E. TABLAN</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. ROMEO G. MANALANG</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. NELSON B. YCO</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. OLIVER P. GUERRERO</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. BILLY G. SARNE</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">KAGAWAD</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. BERGEL A. LAGMAN</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">SK CHAIRPERSON</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. JUANITO R. FABABIER</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">SECRETARY</small></h3>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center; height: 57px;" valign="top">
                                            <h3 style="font-size: 14px; padding: 0; margin: 5px 0 0 0;"><b>HON. ARIS C. BANIQUED</b><br /><small style="font-size: 10px; padding: 0; margin: 0;">TREASURER</small></h3>
                                        </td>
                                    </tr>

                                </table>
                                <table border="0" style="width: 250px;">
                                    <tr>
                                        <td>
                                            <p style="font-size: 14px; padding: 0; margin: 10px 0 0 0;"><b>Control#:</b></p>
                                        </td>
                                        <td>
                                            <p style="font-size: 14px; padding: 0; margin: 10px 0 0 0; text-align: right;"><b>{{ $data["control_number"] }}</b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="font-size: 14px; padding: 0; margin: 10px 0 0 0;"><b>Date Issued:</b></p>
                                        </td>
                                        <td>
                                            <p style="font-size: 14px; padding: 0; margin: 10px 0 0 0; text-align: right;"><b>{{ $data["issued"] }}</b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="font-size: 14px; padding: 0; margin: 10px 0 0 0;"><b>Valid Until:</b></p>
                                        </td>
                                        <td>
                                            <p style="font-size: 14px; padding: 0; margin: 10px 0 0 0; text-align: right;"><b>{{ $data["valid"] }}</b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p style="font-size: 16px; padding: 0; margin: 10px 0 0 0; text-align:center;"><b>VOID IF NO SEAL</b></p>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                        <td valign="top">
                            <div class="p-2">
                                @yield('content')
                            </div>

                            <center>
                                <table border="0" style="width: 100%; margin-top: 10px">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left; width: 250px;">
                                            &nbsp;
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: left; width: 250px;">
                                            <p style="padding: 0; margin: 0;">
                                                Approved by:
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; width: 250px;">
                                            &nbsp;
                                        </td>
                                        <td>&nbsp;</td>
                                        <td style="text-align: center; width: 250px;">
                                            <p style="padding: 0; margin: 0;">
                                                <b>GILBERT G. PIÑERO</b>
                                            </p>
                                            <p style="padding: 0; margin: -7px 0 0 0;">
                                                Punong Barangay
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </center>

                            <center>
                                <table border="0" style="width: 100%; margin-top: 75px;">
                                    <tr>
                                        <td style="text-align: center;">
                                            “ANGAT EAST BAJAC-BAJAC” <br />
                                            GOD BLESS OLONGAPO
                                        </td>
                                    </tr>
                                </table>
                            </center>

                        </td>
                    </tr>
                </table>


                <center>
                    <table border="0" style="width: 850px;">
                        <tr>
                            <td style="width: 150px; font-size: 12px;">
                                <center>
                                    <p>18th Street Cor. Johnson Street, East Bajac-Bajac, Olongapo City, Philippines<br />
                                        Tel No. Barangay Hall (047) 222-5035<br />
                                        <i>©Barangay East Bajac-Bajac Utility System</i>
                                    </p>
                                </center>
                            </td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
    </center>

    @if(!IsSet($_GET["show"]))
    <div style="margin: 0 auto; width: 949px;">
        <div style="padding: 10px 0 10px 0;">
            <button class="btnPrint btn btn-danger" onclick="do_save_print('cert');">Print</button>
        </div>
    </div>
    @else
    <div style="margin: 0 auto; width: 949px;">
        <div style="padding: 10px 0 10px 0;">

        </div>
    </div>
    @endif
</body>

</html>
