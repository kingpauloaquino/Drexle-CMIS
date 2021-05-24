@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Blotter History
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
                            <th>#</th>
                            <th>Subject</th>
                            <th>complainant</th>
                            <th>suspect</th>
                            <th>description</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @for($i = 0; $i < COUNT($blotters); $i++) <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $blotters[$i]["subject"] }}</td>
                            <td>{{ $blotters[$i]["complainant_name"] }}</td>
                            <td>{{ $blotters[$i]["suspect_name"] }}</td>
                            <td>{{ $blotters[$i]["description"] }}</td>
                            <td>
                                @if($blotters[$i]["status"] == 2)
                                On-going
                                @elseif($blotters[$i]["status"] == 3)
                                Resolved
                                @else
                                Pending
                                @endif
                            </td>
                            <td>{{ $blotters[$i]["created_at"] }}</td>
                            <td><button class="btn btn-block btn-sm btn-secondary" data-uid="{{ $blotters[$i]['id'] }}" data-status="{{ $blotters[$i]['status'] }}"><i class="fa fa-eye" aria-hidden="true"></i></button></td>
                            </tr>
                            <?php $count++; ?>
                            @endfor
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<div id="myModal1" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Action Form</h5>
                <button type="button" id="btnCloseModal2" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <h5>Please select the status:</h5>
                <div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="bstatus" class="custom-control-input" id="customRadio" value="1" data-value="1">
                        <label class="custom-control-label" for="customRadio">Pending</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="bstatus" class="custom-control-input" id="customRadio2" value="2" data-value="2">
                        <label class="custom-control-label" for="customRadio2">On-going</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="bstatus" class="custom-control-input" id="customRadio3" value="3" data-value="3">
                        <label class="custom-control-label" for="customRadio3">Resolved</label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                <button id="btnSubmit1" class="btn btn-danger" type="button">Submit</button>
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
            $("#customRadio").attr("data-uid", data.uid);
            $("#customRadio2").attr("data-uid", data.uid);
            $("#customRadio3").attr("data-uid", data.uid);

            if (parseInt(data.status) == 2) {
                $("#customRadio2").attr("checked", true);
            } else if (parseInt(data.status) == 3) {
                $("#customRadio3").attr("checked", true);
            } else {
                $("#customRadio").attr("checked", true);
            }

            $('#myModal1').modal($('#myModal1').modal({
                backdrop: 'static',
                keyboard: false
            }));

        })

        $("#btnSubmit1").on("click", function() {
            var val = $('input[name="bstatus"]:checked').val();
            var data = $('input[name="bstatus"]:checked').data();

            data = {
                uid: data.uid,
                status: parseInt(data.value),
            };

            console.log(data);

            submit(data);
        })

        function submit(data) {
            $.ajax({
                dataType: 'json',
                type: "GET",
                url: "/blotter/status/update",
                data: data,
                beforeSend: function() {
                    $("#btnSubmit1").empty().prepend("<span class='spinner-border spinner-border-sm'></span> Please wait...");
                }
            }).done(function(res) {
                if (res.status == 200) {
                    alert("Done!");

                    location.reload();
                } else {
                    alert("Something went wrong.");
                }
                $("#btnSubmit1").empty().prepend("Submit");
            });
        }
    })
</script>
@endsection
