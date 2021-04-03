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
                            <td>{{ $data[$i]["gender"] }}</td>
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
<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Year of Stay:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Household:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Date of Birth:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Place of Birth:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Civil Status:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Nationality:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Blood Type:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Email Address:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Mobile Number:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Occupation:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                    <tr>
                        <td>Skill:</td>
                        <td style="text-align: right;">King Paulo Aquino</td>
                    </tr>
                </table>

                <div class="form-row mt-3">
                    <div class="form-group col-md-12">
                        <label for="civil">Issue for:</label>
                        <div class="input-group">
                            <select class="custom-select" id="ddlListOfIssues">
                                <option value="0" selected>Choose...</option>
                                <option value="Residency">Residency</option>
                                <option value="Solo Parent">Solo Parent</option>
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

        $(".btn").on("click", function() {
            var data = $(this).data();
            $('#myModal').modal($('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            }));
            $('#myModal').modal('show');
            $('#btnIssueNow').attr('data-uid', data.value);
        })

        $("#btnIssueNow").on("click", function() {
            var data = $(this).data();
            var uid = parseInt(data.uid);
            var issue = $("#ddlListOfIssues").val();

            if (issue == "0") {
                alert("Oops, please select issue for.");
            }

            console.log(uid);
            var data = {
                method: issue,
                uid: uid,
                details: "N/A",
            };

            $("ddlListOfIssues").attr("disabled", true);
            $("#btnIssueNow").attr("disabled", true);
            store(data);

        })

        function store(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                dataType: 'json',
                type: "GET",
                url: "/personal/resident/issue/store",
                data: data,
                beforeSend: function() {
                    $("#btnIssueNow").empty().prepend("<span class='spinner-border spinner-border-sm'></span> Please wait...");
                }
            }).done(function(res) {

                console.log(res);

                if (res.status == 200) {
                    alert("Done!");
                    location.reload();
                } else {
                    alert("Something went wrong.");
                }

            });
        }
    })
</script>
@endsection
