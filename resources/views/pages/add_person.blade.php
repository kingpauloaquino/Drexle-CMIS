@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Add Personal Information
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-10">
                <!-- Default Bootstrap Form Controls-->
                @if(Session::has('error'))
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ Session::get('error')}}
                </div>
                @endif

                @if(Session::has('message'))
                <div class="alert alert-success">
                    <i class="fa fa-check" aria-hidden="true"></i> {{ Session::get('message')}}
                </div>
                @endif

                <div id="default">
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Component Preview-->
                            <div class="sbp-preview">
                                <div class="sbp-preview-content">
                                    <form action="/personal/add-person/store" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        <center>
                                            <table border="0">
                                                <tr>
                                                    <td style="height: 230px;">
                                                        <center>
                                                            <img src="https://icons.iconarchive.com/icons/hopstarter/sleek-xp-basic/128/Administrator-icon.png" style="border: 2px solid gray; width: 192px; height: 192px;" />
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlFile1">Upload 2x2 Photo</label>
                                                            <input type="file" name="file" class="form-control-file" id="file" accept="image/png, image/jpeg">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="firstname">First Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Juan" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="middlename">Middle Name: <span class="required">*</span> <input type="checkbox" id="noMiddlename" name="noMiddlename" /> <small style="font-size: 11px;">Check If no middlename</small></label>
                                                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Dela" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="lastname">Last Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Cruz" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="stay">House#: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="address1" name="address1" placeholder="I.e.: 123" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="household">Street: <span class="required">*</span></label>
                                                <select id="address2" name="address2" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="17th Street">17th Street</option>
                                                    <option value="18th Street">18th Street</option>
                                                    <option value="20th Street">20th Street</option>
                                                    <option value="21st Street">21st Street</option>
                                                    <option value="23rd Street">23rd Street</option>
                                                    <option value="24th Street">24th Street</option>
                                                    <option value="25th Street">25th Street</option>
                                                    <option value="26th Street">26th Street</option>
                                                    <option value="27th Street">27th Street</option>
                                                    <option value="Afable">Afable</option>
                                                    <option value="Ardoin">Ardoin</option>
                                                    <option value="Barretto">Barretto</option>
                                                    <option value="Canda">Canda</option>
                                                    <option value="Dahl">Dahl</option>
                                                    <option value="Elecaño">Elecaño</option>
                                                    <option value="Fontaine">Fontaine</option>
                                                    <option value="Graham">Graham</option>
                                                    <option value="Harris">Harris</option>
                                                    <option value="Ibarra">Ibarra</option>
                                                    <option value="Johnson">Johnson</option>
                                                    <option value="Johnson Ext.">Johnson Ext.</option>
                                                    <option value="Katipunan">Katipunan</option>
                                                    <option value="Lapu-Lapu">Lapu-Lapu</option>
                                                    <option value="Little Baguio 1">Little Baguio 1</option>
                                                    <option value="Little Baguio 2">Little Baguio 2</option>
                                                    <option value="Mabini">Mabini</option>
                                                    <option value="Rizal Avenue">Rizal Avenue</option>
                                                    <option value="Upper Sibul 1">Upper Sibul 1</option>
                                                    <option value="Upper Sibul 2">Upper Sibul 2</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="household">Purok: </label>
                                                <input type="text" class="form-control" id="address3" name="address3" placeholder="Optional">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="stay">Total Years Stay:</label>
                                                <input type="number" class="form-control" id="stay" name="stay" placeholder="I.e.: 1 year" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="household">Total Household Member/s:</label>
                                                <input type="number" class="form-control" id="household" name="household" placeholder="I.e.: 5">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="birthdate">Birthdate: <span class="required">*</span></label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Email" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="birhtplace">Place of Birth:</label>
                                                <input type="text" class="form-control" id="birhtplace" name="birhtplace" placeholder="I.e.: Quezon City" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="gender">Gender:</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="civil">Civil Status:</label>
                                                <select id="civil" name="civil" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1">Single</option>
                                                    <option value="2">Married</option>
                                                    <option value="3">Seperated</option>
                                                    <option value="4">Widowed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nationality">Nationality: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="I.e.: Filipino" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="blood">Blood Type:</label>
                                                <select id="blood" name="blood" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="AB">AB</option>
                                                    <option value="O">O</option>
                                                    <option value="A+">A+</option>
                                                    <option value="B+">B+</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email Address (Optional):</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="I.e.: yourname@gmail.com">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mobile">Mobile Number: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="I.e.: 09171234567" onkeypress="return isNumberKey(event)" required>
                                            </div>
                                        </div>

                                        <input type="hidden" id="verified" name="verified" />

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="work">Occupation/Work:</label>
                                                <input type="text" class="form-control" id="work" name="work" placeholder="I.e.: Software Engineer">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="skill">Skill:</label>
                                                <input type="text" class="form-control" id="skill" name="skill" placeholder="I.e.: Driving, Welding, Computer Repair">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
@endsection

@section('script')
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
@endsection
