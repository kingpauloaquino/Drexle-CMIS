@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Released List
                        </h1>
                        <div class="page-header-subtitle">As of {{ date("Y-m-d") }}</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-body">

                <form action="/personal/released-list/search" method="POST">

                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Firstname, lastname">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary">Search</button>
                        </div>
                    </div>
                </form>

                <h4>{{ COUNT($data) }} Total Request Today:</h4>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th style="width: 260px; text-align: center;">Method</th>
                            <th style="width: 160px; text-align: center;">Date Released</th>
                            <th style="width: 160px; text-align: center;">Expiration Date</th>
                            <th style="width: 50px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < COUNT($data); $i++) <tr>
                            <?php
                            $fullname = $data[$i]->firstname . " " . $data[$i]->middlename . " " . $data[$i]->lastname;
                            ?>
                            <td>{{ ucwords(strtolower($fullname)) }}</td>
                            <td style="text-align: center;">
                                <?php
                                switch ($data[$i]->method) {
                                    case "residency":
                                        $record_method = "Residency";
                                        break;
                                    case "soloparent":
                                        $record_method = "Solo Parent";
                                        break;
                                    case "indigency":
                                        $record_method = "Indigency";
                                        break;
                                    case "bgryclearance":
                                        $record_method = "Barangay Clearance";
                                        break;
                                    case "jobseeker":
                                        $record_method = "First Time Job Seeker";
                                        break;
                                    case "businesspermit":
                                        $record_method = "Business Permit";
                                        break;
                                    case "businessclosure":
                                        $record_method = "Business Closure";
                                        break;
                                }
                                ?>
                                {{ $record_method }}
                            </td>
                            <td style="text-align: center;">{{ \Carbon\Carbon::parse($data[$i]->updated_at)->format('M d, Y') }}</td>
                            <td style="text-align: center;">{{ \Carbon\Carbon::parse($data[$i]->updated_at)->addDay(1)->format('M d, Y') }}</td>
                            <td style="text-align: center;"><button class="btn btn-block btn-sm btn-primary" data-fullname="{{ $fullname }}" data-method="{{ $data[$i]->method }}" data-uid="{{ $data[$i]->id }}" data-cid="{{ $data[$i]->cid }}"><i class="fa fa-print" aria-hidden="true"></i></button></td>
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
                <h5 class="modal-title">Transaction Details</h5>
                <button type="button" id="btnCloseModal1" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <h3 id="fullname"></h3>
                <table border="0" id="record_list" style="width: 100%;">
                    <tr>
                        <td>Date Issued</td>
                    </tr>
                </table>

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
            $('#fullname').text(data.fullname);
            var url = "/brgy/residency/issue/preview/" + data.uid + "/" + data.cid + "/" + data.method + "?show=preview";
            var myWindow = window.open(url, "Preview Certificate", "width=990,height=950,top=10,left=360");
        })
    })
</script>
@endsection
