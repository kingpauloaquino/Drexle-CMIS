<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .required {
            color: red;
        }
    </style>

</head>

<body>
    <div id="app">

        <div id="wrapper">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Brgy Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#myModal2" data-backdrop="static" data-keyboard="false" href="#">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Request Clearance</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/personal/clearance/trans/request">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>View Ceritificates</span>
                    </a>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>List of Certificates</span>
                    </a>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">List of Clearances:</h6>
                            <a class="collapse-item" href="/personal/clearance/bgryclearance">Barangay Clearance</a>
                            <a class="collapse-item" href="/personal/clearance/residency">Residency</a>
                            <a class="collapse-item" href="/personal/clearance/soloparent">Solo Parent</a>
                            <a class="collapse-item" href="/personal/clearance/indigency">Indigency</a>
                            <a class="collapse-item" href="/personal/clearance/jobseeker">First Time JobSeeker</a>

                            <h6 class="collapse-header">List of Businesses:</h6>
                            <a class="collapse-item" href="/business/clearance/businesspermit">Business Permit</a>
                            <a class="collapse-item" href="/business/clearance/businessclosure">Business Closure</a>
                        </div>
                    </div>
                </li> -->

            </ul>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        <?php
                                        $fullname =  Auth::user()->lastname . ", " .  Auth::user()->firstname;
                                        $fullname = ucwords(strtolower($fullname))
                                        ?>
                                        {{ $fullname }}
                                    </span>
                                    <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="/personal/user/profile">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="/personal/user/settings">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    @yield('content')
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

    </div>

    </div>

    <div id="myModal2" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request form</h5>
                    <button type="button" id="btnCloseModal2" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table table-hover step1">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Action</th>
                                <th style="width: 250px;">Certificate</th>
                                <th>Requirements</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><input type="checkbox" id="checklist-soloparent" class="checklist" value="soloparent" /> </td>
                                <td id="soloparent">Solo Parent</td>
                                <td id="soloparent-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" id="checklist-jobseeker" class="checklist" value="jobseeker" /> </td>
                                <td id="jobseeker">First Time Job Seeker</td>
                                <td id="jobseeker-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" id="checklist-bgryclearance" class="checklist" value="bgryclearance" /> </td>
                                <td id="bgryclearance">Barangay Clearance</td>
                                <td id="bgryclearance-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" id="checklist-residency" class="checklist" value="residency" /> </td>
                                <td id="residency">Barangay Residency</td>
                                <td id="residency-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" id="checklist-indigency" class="checklist" value="indigency" /> </td>
                                <td id="indigency">Barangay Indigency</td>
                                <td id="indigency-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" id="checklist-businesspermit" class="checklist" value="businesspermit" /> </td>
                                <td id="businesspermit">Barangay Business Permit</td>
                                <td id="businesspermit-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" id="checklist-businessclosure" class="checklist" value="businessclosure" /> </td>
                                <td id="businessclosure">Barangay Business Closure</td>
                                <td id="businessclosure-requirement"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="display: none;" class="step2">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="age">Requestor Name: <span class="required">(Optional)</span></label>
                                <input type="text" class="form-control" id="requestor_name" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="age">Purpose: <span class="required">*</span></label>
                                <input type="text" class="form-control" id="purpose" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="age">Remark: <span class="required">(Optional)</span></label>
                                <input type="text" class="form-control" id="remark" />
                            </div>
                        </div>
                    </div>

                    <div style="display: none;" class="step3">
                        <h3>For Business Permit</h3>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="age">Business Code: <span class="required">*</span></label>
                                <input type="text" class="form-control" id="bcode" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="age">Business Name: <span class="required">*</span></label>
                                <input type="text" class="form-control" id="bname" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="age">Business Address: <span class="required">*</span></label>
                                <input type="text" class="form-control" id="baddresss" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="age">Operator / Manager: <span class="required">*</span></label>
                                <input type="text" class="form-control" id="operator" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="age">Residence Address: <span class="required">*</span></label>
                                <input type="text" class="form-control" id="raddress" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="btype">Type:</label>
                                <select id="btype" name="btype" class="form-control">
                                    <option value="0">New Business</option>
                                    <option value="1">Renewal</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" onclick="location.reload();">Cancel</button>
                    <button id="btnSubmitCertificate1" class="btn btn-danger" type="button">Next</button>
                    <button id="btnSubmitCertificate2" class="btn btn-danger" type="button" style="display: none;">Next</button>
                    <button id="btnSubmitCertificate3" class="btn btn-primary" type="button" style="display: none;">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.all.min.js" integrity="sha256-VkcwHXtZS2ZHfHSFSP8r1AzueZi37jGMPeHv4OfV1Cg=" crossorigin="anonymous"></script>

    <script>
        var selected_certificates = [];
        var business_info = [];
        var other_info = [];
        var active_checkbox;
        $(document).ready(function() {
            $(".checklist").on("click", function() {
                var d = $(this).val();
                active_checkbox = d;
                if ($(this).prop('checked')) {
                    $("#" + d).attr("style", "background-color: #A5E81B; color: #000;");
                    $("#" + d + "-requirement").attr("style", "background-color: #A5E81B; color: #000;");
                    $("#" + d + "-requirement").empty().prepend("Valid ID, 2x2 Photo, <a href='#'>more details</a>");
                    selected_certificates.push(d);

                    var r = check_point(d);
                    console.log(r);
                } else {
                    for (var i = 0; i < selected_certificates.length; i++) {
                        if (selected_certificates[i] == d) {
                            selected_certificates.splice(i, 1);
                        }
                    }
                    $("#" + d).removeAttr("style");
                    $("#" + d + "-requirement").removeAttr("style");
                    $("#" + d + "-requirement").empty();
                }
            })

            $("#btnSubmitCertificate1").on("click", function() {
                if (selected_certificates.length == 0) {
                    Swal.fire(
                        'Hmmm!',
                        'Please select one of the certificates',
                        'error'
                    )
                    return false;
                }

                $(".step1").hide();
                $("#btnSubmitCertificate1").hide();

                var notONE = 0;
                var isBusiness = false;
                for (var i = 0; i < selected_certificates.length; i++) {
                    if (selected_certificates[i] == "businesspermit") {
                        notONE++;
                        isBusiness = true;
                    } else {
                        notONE++;
                    }
                }

                if (notONE > 1) {
                    if (isBusiness) {
                        $(".step2").show();
                        $("#btnSubmitCertificate2").show();
                    } else {
                        $(".step2").show();
                        $("#btnSubmitCertificate2").show();
                        $("#btnSubmitCertificate2").removeAttr("class");
                        $("#btnSubmitCertificate2").attr("class", "btn btn-primary");
                        $("#btnSubmitCertificate2").empty().prepend("Save");
                    }
                } else {
                    if (isBusiness) {
                        $(".step3").show();
                        $("#btnSubmitCertificate3").show();
                    } else {
                        $(".step2").show();
                        $("#btnSubmitCertificate2").show();
                        $("#btnSubmitCertificate2").removeAttr("class");
                        $("#btnSubmitCertificate2").attr("class", "btn btn-primary");
                        $("#btnSubmitCertificate2").empty().prepend("Save");
                    }
                }
            })

            $("#btnSubmitCertificate2").on("click", function() {
                var requestor = $("#requestor_name").val();
                var purpose = $("#purpose").val();
                var remark = $("#remark").val();

                other_info = {
                    requestor: requestor,
                    purpose: purpose,
                    remark: remark
                }

                if (purpose.length == 0) {
                    Swal.fire(
                        'Hmmm!',
                        'Please enter your purpose.',
                        'error'
                    )
                    return false;
                }

                $(".step1").hide();

                var isBusiness = false;
                for (var i = 0; i < selected_certificates.length; i++) {
                    if (selected_certificates[i] == "businesspermit") {
                        isBusiness = true;
                        break;
                    }
                }

                if (isBusiness) {
                    $(".step2").hide();
                    $("#btnSubmitCertificate2").hide();
                    $(".step3").show();
                    $("#btnSubmitCertificate3").show();
                } else {
                    submit();
                }
            })

            $("#btnSubmitCertificate3").on("click", function() {

                var bname = $("#bname").val();
                var baddresss = $("#baddresss").val();
                var operator = $("#operator").val();
                var raddress = $("#raddress").val();
                var bcode = $("#bcode").val();
                var btype = $("#btype").val();

                if (bcode.length == 0) {
                    Swal.fire(
                        'Hmmm!',
                        'Please enter your business code.',
                        'error'
                    )
                    return false;
                }

                if (bname.length == 0) {
                    Swal.fire(
                        'Hmmm!',
                        'Please enter your business name.',
                        'error'
                    )
                    return false;
                }

                if (baddresss.length == 0) {
                    Swal.fire(
                        'Hmmm!',
                        'Please enter your business address.',
                        'error'
                    )
                    return false;
                }

                if (operator.length == 0) {
                    Swal.fire(
                        'Hmmm!',
                        'Please enter your operator name.',
                        'error'
                    )
                    return false;
                }

                if (raddress.length == 0) {
                    Swal.fire(
                        'Hmmm!',
                        'Please enter your resident address.',
                        'error'
                    )
                    return false;
                }


                business_info = {
                    bname: bname,
                    baddresss: baddresss,
                    operator: operator,
                    raddress: raddress,
                    bcode: bcode,
                    btype: btype,
                }
                submit();
            })

            function check_point(method) {
                var sendInfo = {
                    method: method
                };

                $.ajax({
                    type: "GET",
                    url: "/personal/clearance/request/check-point",
                    dataType: "json",
                    beforeSend: function() {},
                    data: sendInfo
                }).done(function(msg) {
                    console.log(msg);
                    if (msg.status == 200) {
                        Swal.fire(
                            'Oops',
                            'You have still pending request.',
                            'error'
                        )

                        setInterval(() => {
                            location.reload();
                        }, 2000);

                        // var d = msg.method;
                        // for (var i = 0; i < selected_certificates.length; i++) {
                        //     if (selected_certificates[i] == d) {
                        //         selected_certificates.splice(i, 1);
                        //     }
                        // }
                        // $("#checklist-" + d).prop("checked", false);
                        // $("#checklist-" + d).attr("disabled", true);
                        // $("#" + d).removeAttr("style");
                        // $("#" + d + "-requirement").removeAttr("style");
                        // $("#" + d + "-requirement").empty();
                    }
                });

            }

            function submit() {

                var sendInfo = {
                    certificates: selected_certificates,
                    other_info: other_info,
                    business_info: business_info
                };

                console.log(sendInfo);

                $.ajax({
                    type: "GET",
                    url: "/personal/clearance/request/post",
                    dataType: "json",
                    beforeSend: function() {
                        $("#btnSubmitCertificate3").attr("disabled", true);
                        var btnText = "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Please wait...";
                        $("#btnSubmitCertificate3").empty().prepend(btnText);
                    },
                    success: function(msg) {
                        console.log(msg);
                        if (msg.status == 200) {
                            Swal.fire(
                                'Good Job!',
                                'Your request is being processed.',
                                'success'
                            )

                            setInterval(() => {
                                location.reload();
                            }, 2000);

                        } else {
                            Swal.fire(
                                'Oops!',
                                'Something went wront...',
                                'error'
                            )
                            $("#btnSubmitCertificate3").empty().prepend("Save");
                            $("#btnSubmitCertificate3").attr("disabled", false);
                        }
                    },

                    data: sendInfo
                });
            }
        })
    </script>
    @yield('script')
</body>

</html>
