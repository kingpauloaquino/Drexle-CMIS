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
                    <a class="nav-link" data-toggle="modal" data-target="#myModal2" href="#">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Request Clearance</span>
                    </a>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
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
                </li>

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
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
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

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Action</th>
                                <th style="width: 250px;">Certificate</th>
                                <th>Requirements</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"><input type="checkbox" class="checklist" value="soloparent" /> </td>
                                <td id="soloparent">Solo Parent</td>
                                <td id="soloparent-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" class="checklist" value="jobseeker" /> </td>
                                <td id="jobseeker">First Time Job Seeker</td>
                                <td id="jobseeker-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" class="checklist" value="bgryclearance" /> </td>
                                <td id="bgryclearance">Barangay Clearance</td>
                                <td id="bgryclearance-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" class="checklist" value="residency" /> </td>
                                <td id="residency">Barangay Residency</td>
                                <td id="residency-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" class="checklist" value="indigency" /> </td>
                                <td id="indigency">Barangay Indigency</td>
                                <td id="indigency-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" class="checklist" value="businesspermit" /> </td>
                                <td id="businesspermit">Barangay Business Permit</td>
                                <td id="businesspermit-requirement"></td>
                            </tr>
                            <tr>
                                <td align="center"><input type="checkbox" class="checklist" value="businessclosure" /> </td>
                                <td id="businessclosure">Barangay Business Closure</td>
                                <td id="businessclosure-requirement"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button id="btnCancel" class="btn btn-secondary" type="button">Cancel</button>
                    <button id="btnSubmitCertificate" class="btn btn-danger" type="button">Submit</button>
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

    <script>
        var selected_certificates = [];
        $(document).ready(function() {
            $(".checklist").on("click", function() {
                var d = $(this).val();
                if ($(this).prop('checked')) {
                    $("#" + d).attr("style", "background-color: #A5E81B; color: #000;");
                    $("#" + d + "-requirement").attr("style", "background-color: #A5E81B; color: #000;");
                    $("#" + d + "-requirement").empty().prepend("Valid ID, 2x2 Photo, <a href='#'>more details</a>");
                    selected_certificates.push(d);
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

            $("#btnSubmitCertificate").on("click", function() {
                console.log(selected_certificates);
            })
        })
    </script>
    @yield('script')
</body>

</html>
