@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Record List
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Work</th>
                            <th>Mobile</th>
                            <th>Date Added</th>
                            <th style="width: 50px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @for($i = 0; $i < COUNT($data); $i++) <tr>
                            <td>{{ $data[$i]["lastname"] . ", " .$data[$i]["firstname"] . " " . $data[$i]["middlename"] }}</td>
                            <td>{{ $data[$i]["gender"] == 1 ? "Male" : "Female" }}</td>
                            <td>{{ $data[$i]["work"] }}</td>
                            <td>{{ $data[$i]["mobile"] }}</td>
                            <td>{{ $data[$i]["created_at"] }}</td>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <button type="button" class="btn btn-primary btn-sm pull-right">Edit</button>

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
                        <td>Address:</td>
                        <td id="dtAddress" style="text-align: right;">***</td>
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
                                <!-- <option value="Residency">Residency</option> -->
                                <!-- <option value="Solo Parent">Solo Parent</option> -->
                                <option value="Indigency">Indigency</option>
                                <option value="Solicitation">Solicitation</option>
                                <option value="First Time JobSeeker">First Time JobSeeker</option>
                                <option value="Barangay Clearance">Barangay Clearance</option>
                                <option value="Lot Certication">Lot Certication</option>
                                <option value="Application Cert. Form">Lot Application Cert. Form</option>
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
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn").on("click", function() {
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

            var data = {
                method: issue,
                uid: uid
            };
            store(data);
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
                $("#dtName").empty().prepend(res.data.lastname + ", " + res.data.firstname + " " + res.data.middlename);
                $("#dtAge").empty().prepend(res.data.age);
                $("#dtAddress").empty().prepend(res.data.address);
                $("#dtStay").empty().prepend(res.data.year_stay);
                $("#dtHousehold").empty().prepend(res.data.household);
                $("#dtBirth").empty().prepend(res.data.birthdate);
                $("#dtPlace").empty().prepend(res.data.birthplace);
                $("#dtGender").empty().prepend(res.data.gender);
                $("#dtCivil").empty().prepend(res.data.civil_status);
                $("#dtNationality").empty().prepend(res.data.nationality);
                $("#dtBlood").empty().prepend(res.data.blood);
                $("#dtEmail").empty().prepend(res.data.email);
                $("#dtMobile").empty().prepend(res.data.mobile);
                $("#dtOccupation").empty().prepend(res.data.work);
                $("#dtSkill").empty().prepend(res.data.skill);
            });
        }

        function store(data) {
            $.ajax({
                dataType: 'json',
                type: "GET",
                url: "/personal/resident/issue/store",
                data: data,
                beforeSend: function() {
                    $("#btnIssueNow").empty().prepend("<span class='spinner-border spinner-border-sm'></span> Please wait...");
                }
            }).done(function(res) {
                if (res.status == 200) {
                    alert("Done!");
                    window.location.href = res.url;
                } else if (res.status == 404) {
                    alert("No available certificate.");

                } else {
                    alert("Something went wrong.");
                }
                $("#btnIssueNow").empty().prepend("Issue Now");
            });
        }
    })
</script>
@endsection
