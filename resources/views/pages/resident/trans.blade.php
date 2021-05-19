@extends('layouts.resident')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            List of Certificates
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

                <h4>{{ COUNT($trans)}} Total Certificates</h4>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type of Certificate</th>
                            <th style="width: 120px; text-align: center;">Status</th>
                            <th style="width: 210px; text-align: center;">Date Requested</th>
                            <th style="width: 210px; text-align: center;">Date Released</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < COUNT($trans); $i++) <tr>
                            <td>{{ ucwords(strtolower($trans[$i]->method)) }}</td>
                            <td style="text-align: center;">{{ $trans[$i]->status > 0 ? "Released" : "Pending" }}</td>
                            <td style="text-align: center;">
                                @if($trans[$i]->status > 0)
                                {{ $trans[$i]->updated_at }}
                                @else
                                N/A
                                @endif
                            </td>

                            <td style="text-align: center;">
                                {{ $trans[$i]->created_at }}
                            </td>
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
            $('#myModal').modal($('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            }));
            $('#myModal').modal('show');

            $('#fullname').text(data.fullname);
            get(data.value, data.method)

        })


    })

    function get(uid, method) {
        $.ajax({
            dataType: 'json',
            type: "GET",
            url: "/brgy/issue/list/" + uid + "/" + method,
            beforeSend: function() {
                $("#btnIssueNow").empty().prepend("<span class='spinner-border spinner-border-sm'></span> Please wait...");
            }
        }).done(function(res) {

            if (res.status == 200) {

                var column = "<tr>";
                column += "<td>#</td>";

                if (method == "businesspermit") {
                    column += "<td>Business Name</td>";
                }
                if (method == "businessclosure") {
                    column += "<td>Business Name</td>";
                }

                if (method == "businessclosure") {
                    column += "<td>Closed Issued</td>";
                } else {
                    column += "<td style='width:120px;'>Date Issued</td>";
                }

                if (method == "businesspermit") {
                    column += "<td style='width:50px;'>Action</td>";
                }

                column += "</tr>";
                var counter = 1;
                $(res.data).each(function(a, b) {
                    column += "<tr>";
                    column += "<td>" + counter + "</td>";

                    if (method == "businesspermit") {
                        column += "<td>" + b.business_name + "</td>";
                    }
                    if (method == "businessclosure") {
                        column += "<td>" + b.business_name + "</td>";
                    }



                    if (method == "businessclosure") {
                        column += "<td>" + b.updated_at + "</td>";
                    } else {
                        column += "<td>" + b.date_issued + "</td>";
                    }

                    if (method == "businesspermit") {

                        if (b.status == 2) {
                            column += "<td><button class='closed btn btn-secondary btn-block btn-sm'>Closed</button></td>";
                        } else {
                            column += "<td><button class='closure btn btn-danger btn-block btn-sm' data-id='" + b.id + "'>Closure</button></td>";
                        }

                    }

                    column += "</tr>";
                    counter++;
                })
                $("#record_list").empty().prepend(column);

                $(".closure").on("click", function() {
                    var data = $(this).data();
                    console.log(data);
                    var myWindow = window.open("/brgy/closure/issue/preview/" + data.id, "Preview Certificate", "width=990,height=950,top=10,left=360");
                    location.reload();
                })

                $(".closed").on("click", function() {
                    alert("Already closed!");
                })
            } else {
                alert("Something went wrong.");
            }
        });
    }
</script>
@endsection
