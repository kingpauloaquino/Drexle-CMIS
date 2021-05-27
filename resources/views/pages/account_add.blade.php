@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Add User Account
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
                                    <form action="/account/add-new/post" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="firstname">First Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Juan" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="lastname">Last Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Cruz" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email Address: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="I.e.: yourname@gmail.com" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mobile">Mobile Number: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="I.e.: 09171234567" onkeypress="return isNumberKey(event)" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="role">Role:</label>
                                                <select id="role" name="role" class="form-control">
                                                    <option value="2">Other</option>
                                                    <option value="1">Admin</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Status:</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="0">Pending</option>
                                                    <option value="1">Active</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button id="btnSubmit" class="btn btn-primary btn-user btn-block" disabled>Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</main>


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
            data = {
                mobile: mobile
            };
            processing(data);
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
                $("#btnSubmit").attr("disabled", false);
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
