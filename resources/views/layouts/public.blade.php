<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js', config('app.ssl', false)) }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/fontawesome.min.js" integrity="sha256-7zqZLiBDNbfN3W/5aEI1OX/5uvck9V0yhwKOA9Oe49M=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

    <style>
        @media (min-width: 1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 890px;
            }
        }

        .spinner-border {
            width: 1rem;
            height: 1rem;
        }

        .required {
            color: red;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mobile Verification</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter OTP Code:</label>
                            <input type="text" class="form-control" id="txtCode" aria-describedby="emailHelp" placeholder="I.e.: 123456" onkeypress="return isNumberKey(event)">
                            <small id="txtCode" class="form-text text-muted">We'll never share your mobile# with anyone else.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-envelope-open-text"></i> Resend OTP Code</button>
                        <button id="btnVerifyNow" type="submit" class="btn btn-primary" style="float: right;"><i class="fas fa-paper-plane"></i> Verify Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.all.min.js" integrity="sha256-VkcwHXtZS2ZHfHSFSP8r1AzueZi37jGMPeHv4OfV1Cg=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#noMiddlename").change(function() {
                if ($(this).prop('checked')) {
                    $("#middlename").removeAttr("required");
                } else {
                    $("#middlename").attr("required", true);
                }
            });

            $('#mobile').keypress(function() {
                if (this.value.length >= 11) {
                    return false;
                }
            });

            $('#mobile').focusout(function() {
                var mobile = $(this).val();
                Swal.fire({
                    title: 'Mobile Verfication!',
                    text: "You should enter your valid mobile number. We will verify it via sending an OTP.",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK, send it!'
                }).then((result) => {
                    console.log(result);
                    if (result) {

                        data = {
                            mobile: mobile
                        };

                        processing(data);
                    }
                })
            })

            $("#btnVerifyNow").on("click", function() {

                var otp = $("#txtCode").val();
                var code = getCookie("otp");

                if (code != otp) {
                    Swal.fire(
                        'Invalid',
                        'Oops, you entered an invalid OTP Code.',
                        'error'
                    )
                    return false;
                }

                $("#verified").val("1");
                console.log(otp);
                console.log(code);

                Swal.fire(
                    'Good Job!',
                    'You entered a valid OTP Code',
                    'success'
                )

                // $("#mobile").attr("disabled", true);

                $('#exampleModal').modal("hide");
            })
        })

        function processing(data) {
            $.ajax({
                dataType: 'json',
                type: "GET",
                url: "/personal/mobile-verify",
                data: data
            }).done(function(res) {
                if (res.status == 200) {
                    setCookie("otp", res.otp, 1);
                    $('#exampleModal').modal($('#exampleModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    }));
                } else if (res.status == 404) {
                    Swal.fire(
                        'Oops',
                        'Invalid mobile prefix number.',
                        'error'
                    )
                } else {
                    Swal.fire(
                        'Oops',
                        'Something went wrong.',
                        'error'
                    )
                }
            });
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    </script>
</body>

</html>
