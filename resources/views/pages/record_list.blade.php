@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            {{ $status }}
                        </h1>
                        <div class="page-header-subtitle"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-body">
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

                <form action="/personal/residence-list/search" method="POST">

                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Firstname, lastname, mobile#, or etc." aria-label="Recipient's username" aria-describedby="btnSearch">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary">Search</button>
                        </div>
                    </div>
                </form>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Work</th>
                            <th>Mobile</th>
                            <th style="width: 160px;">Date Registered</th>
                            <th style="width: 50px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < COUNT($data); $i++) <tr>
                            <td>
                                <?php
                                if ($data[$i]["middlename"] != "N/A") {
                                    $fullname =  $data[$i]["lastname"] . ", " . $data[$i]["firstname"] . " " . $data[$i]["middlename"];
                                } else {
                                    $fullname =  $data[$i]["lastname"] . ", " . $data[$i]["firstname"];
                                }
                                $fullname = ucwords(strtolower($fullname))
                                ?>
                                {{ $fullname }}
                            </td>
                            <td>{{ $data[$i]["gender"] == 1 ? "Male" : "Female" }}</td>
                            <td>{{ $data[$i]["work"] }}</td>
                            <td>{{ $data[$i]["mobile"] }}</td>
                            <td>{{ \Carbon\Carbon::parse($data[$i]->created_at)->format('M d, Y') }}</td>
                            <td><button class="btn btn-block btn-sm btn-secondary" data-value="{{ $data[$i]['id'] }}"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                            </tr>
                            @endfor
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</main>

<!-- Large modal -->
<div id="myModal" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Basic Information</h5>
                <button type="button" id="btnCloseModal1" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <a id="editbutton" type="button" class="btn btn-primary btn-sm pull-right">Edit</a>

                <table class="mt-3" style="width: 100%;">
                    <tr>
                        <td>Name:</td>
                        <td id="dtName" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Age:</td>
                        <td id="dtAge" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>House#:</td>
                        <td id="dtAddress1" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Street:</td>
                        <td id="dtAddress2" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Purok:</td>
                        <td id="dtAddress3" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Year of Stay:</td>
                        <td id="dtStay" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Household:</td>
                        <td id="dtHousehold" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Date of Birth:</td>
                        <td id="dtBirth" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Place of Birth:</td>
                        <td id="dtPlace" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td id="dtGender" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Civil Status:</td>
                        <td id="dtCivil" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Nationality:</td>
                        <td id="dtNationality" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Blood Type:</td>
                        <td id="dtBlood" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Email Address:</td>
                        <td id="dtEmail" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Mobile Number:</td>
                        <td id="dtMobile" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Occupation:</td>
                        <td id="dtOccupation" style="text-align: right;">***</td>
                    </tr>
                    <tr>
                        <td>Skill:</td>
                        <td id="dtSkill" style="text-align: right;">***</td>
                    </tr>
                </table>

                <div class="form-row mt-3">
                    <div class="form-group col-md-12">
                        <label for="civil">Issue for:</label>
                        <div class="input-group">
                            <select class="custom-select" id="ddlListOfIssues">
                                <option value="0" selected>Choose...</option>
                                <option value="Solo Parent">Solo Parent</option>
                                <option value="Residency">Residency</option>
                                <option value="Indigency">Indigency</option>
                                <option value="First Time JobSeeker">First Time JobSeeker</option>
                                <option value="Barangay Clearance">Barangay Clearance</option>
                                <!-- <option value="Lot Certication">Lot Certication</option> -->
                                <option value="Business Permit">Business Permit</option>
                                <option value="Business Closure">Business Closure</option>
                            </select>
                            <div class="input-group-append">
                                <button id="btnIssueNow" class="btn btn-danger" type="button">Issue Now</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal1" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Additional Information</h5>
                <button type="button" id="btnCloseModal2" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" class="form-control" id="buid" />
                <input type="hidden" class="form-control" id="bmethod" />

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
            <div class="modal-footer">
                <button id="btnCancel" class="btn btn-secondary" type="button">Cancel</button>
                <button id="btnSubmit1" class="btn btn-danger" type="button">Submit</button>
            </div>
        </div>
    </div>
</div>

<div id="myModal2" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Business Information</h5>
                <button type="button" id="btnCloseModal2" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" class="form-control" id="buid" />
                <input type="hidden" class="form-control" id="bmethod" />

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
                            <option value="-0" selected>Choose...</option>
                            <option value="0">New Business</option>
                            <option value="1">Renewal</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button id="btnCancel" class="btn btn-secondary" type="button">Cancel</button>
                <button id="btnSubmit" class="btn btn-danger" type="button">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("td button.btn").on("click", function() {
            var data = $(this).data();
            $('#myModal').modal($('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            }));
            $('#myModal').modal('show');

            get(data.value);
            $('#btnIssueNow').attr('data-uid', data.value);
        })

        $("#btnIssueNow").on("click", function() {
            var data = $(this).data();
            var uid = parseInt(data.uid);

            var issue = $("#ddlListOfIssues").val();

            if (issue == "0") {
                alert("Oops, please select issue for.");
                return false;
            }

            if (issue == "Business Permit") {
                $("#buid").val(uid);
                $("#bmethod").val(issue);

                $('#myModal2').modal($('#myModal2').modal({
                    backdrop: 'static',
                    keyboard: false
                }));
                $("#btnCloseModal1").click()
                $('#myModal2').modal('show');
                return false;
            } else {

                if (issue == "First Time JobSeeker") {
                    var myWindow = window.open("/brgy/jobseeker/issue/preview/" + uid, "Preview Certificate", "width=990,height=950,top=10,left=360");
                    return false;
                }
                $("#buid").val(uid);
                $("#bmethod").val(issue);

                $("#requestor_name").attr("disabled", true);
                switch (issue) {
                    case "Indigency":
                        $("#requestor_name").attr("disabled", false);
                        break;
                }

                $('#myModal1').modal($('#myModal1').modal({
                    backdrop: 'static',
                    keyboard: false
                }));
                $("#btnCloseModal1").click()
                $('#myModal1').modal('show');
            }
        })

        $("#btnCancel").on("click", function() {
            $("#btnCloseModal2").click()
        })

        $("#btnSubmit1").on("click", function() {
            var buid = $("#buid").val();
            var bmethod = $("#bmethod").val();
            var requestor = $("#requestor_name").val();
            var purpose = $("#purpose").val();
            var remark = $("#remark").val();

            var params = "?";

            if (requestor.length > 0) {
                params = "?requestor=" + requestor + "&purpose=" + purpose + "&remark=" + remark;
            } else {
                params = "?purpose=" + purpose + "&remark=" + remark;
            }

            switch (bmethod) {
                case "Residency":
                    var myWindow = window.open("/brgy/residency/issue/preview/" + buid + params, "Preview Certificate", "width=990,height=950,top=10,left=360");
                    break;
                case "Indigency":
                    var myWindow = window.open("/brgy/indigency/issue/preview/" + buid + params, "Preview Certificate", "width=990,height=950,top=10,left=360");
                    break;
                case "Solo Parent":
                    var myWindow = window.open("/brgy/soloparent/issue/preview/" + buid + params, "Preview Certificate", "width=990,height=950,top=10,left=360");
                    break;
                case "Barangay Clearance":
                    var myWindow = window.open("/brgy/clearance/issue/preview/" + buid + params, "Preview Certificate", "width=990,height=950,top=10,left=360");
                    break;
                case "First Time JobSeeker":
                    var myWindow = window.open("/brgy/jobseeker/issue/preview/" + buid, "Preview Certificate", "width=990,height=950,top=10,left=360");
                    break;
            }
            location.reload();
        })

        $("#btnSubmit").on("click", function() {
            var buid = $("#buid").val();
            var bmethod = $("#bmethod").val();
            var bname = $("#bname").val();
            var baddresss = $("#baddresss").val();
            var operator = $("#operator").val();
            var raddress = $("#raddress").val();
            var bcode = $("#bcode").val();
            var btype = $("#btype").val();

            var params = "?bname=" + bname + "&baddresss=" + baddresss + "&operator=" + operator + "&raddress=" + raddress + "&bcode=" + bcode + "&renewal=" + btype;

            var myWindow = window.open("/brgy/business/issue/preview/" + buid + params, "Preview Certificate", "width=990,height=950,top=10,left=360");
            location.reload();
        })

        function get(uid) {
            $.ajax({
                dataType: 'json',
                type: "GET",
                url: "/personal/resident/get/" + uid,
                beforeSend: function() {

                }
            }).done(function(res) {
                console.log(res);
                $("#editbutton").attr("href", "/personal/edit-person/" + uid);
                $("#dtIdNumber").empty().prepend(res.data.id_number);

                var middleName = res.data.middlename;
                if (res.data.middlename == null) {
                    middleName = "";
                }

                $("#dtName").empty().prepend(res.data.lastname + ", " + res.data.firstname + " " + middleName);
                $("#dtAge").empty().prepend(res.data.age);
                $("#dtAddress1").empty().prepend(res.data.address1);
                $("#dtAddress2").empty().prepend(res.data.address2);
                $("#dtAddress3").empty().prepend(res.data.address3);
                $("#dtStay").empty().prepend(res.data.year_stay);
                $("#dtHousehold").empty().prepend(res.data.household);
                $("#dtBirth").empty().prepend(res.data.birthdate);
                $("#dtPlace").empty().prepend(res.data.birthplace);

                var gender = parseInt(res.data.gender);
                if (gender == 1) {
                    $("#dtGender").empty().prepend("Male");
                } else {
                    $("#dtGender").empty().prepend("Female");
                }

                $("#dtCivil").empty().prepend(res.data.civil_status);


                var gender = parseInt(res.data.civil_status);
                if (gender == 1) {
                    $("#dtCivil").empty().prepend("Single");
                } else if (gender == 2) {
                    $("#dtCivil").empty().prepend("Married");
                } else if (gender == 3) {
                    $("#dtCivil").empty().prepend("Seperated");
                } else {
                    $("#dtGender").empty().prepend("Widowed");
                }

                $("#dtNationality").empty().prepend(res.data.nationality);
                $("#dtBlood").empty().prepend(res.data.blood);
                $("#dtEmail").empty().prepend(res.data.email);
                $("#dtMobile").empty().prepend(res.data.mobile);
                $("#dtOccupation").empty().prepend(res.data.work);
                $("#dtSkill").empty().prepend(res.data.skill);
            });
        }

        function store(data, isBusiness) {
            $.ajax({
                dataType: 'json',
                type: "GET",
                url: "/personal/resident/issue/summary",
                data: data,
                beforeSend: function() {
                    $("#btnIssueNow").empty().prepend("<span class='spinner-border spinner-border-sm'></span> Please wait...");
                }
            }).done(function(res) {
                if (res.status == 200) {
                    alert("Done!");

                    var value = res.uid + "/" + res.method;

                    var tags = "<div style='padding: 2px;'><form action='/personal/resident/issue/download/" + value + "' method='GET'><button>Download PDF</button></form></div>";

                    if (isBusiness) {
                        var hidden = "<input type='hidden' class='form-control' name='bname' value='" + res.busines.name + "'>";
                        hidden += "<input type='hidden' class='form-control' name='baddresss' value='" + res.busines.address1 + "'>";
                        hidden += "<input type='hidden' class='form-control' name='operator' value='" + res.busines.operator + "'>";
                        hidden += "<input type='hidden' class='form-control' name='raddress' value='" + res.busines.address2 + "'>";
                        tags = "<div style='padding: 2px;'><form action='/personal/resident/issue/download/" + value + "' method='GET'>" + hidden + "<button>Download PDF</button></form></div>";
                    }

                    // var myWindow = window.open("", "Preview Certificate", "width=750,height=950,top=10,left=560");
                    // myWindow.document.write(tags + res.html);


                    printdiv(res.html);
                } else if (res.status == 404) {
                    alert("No available certificate.");

                } else {
                    alert("Something went wrong.");
                }
                $("#btnIssueNow").empty().prepend("Issue Now");
            });
        }

        function PrintElem(html) {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write(html);

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }

        function printdiv(printpage) {
            var oldstr = printpage;
            document.body.innerHTML = printpage;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
        }
    })
</script>
@endsection
