@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            User Account List
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
                            <th>Role</th>
                            <th>Status</th>
                            <th style="width: 160px;">Date Registered</th>
                            <th style="width: 50px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < COUNT($data); $i++) <tr>
                            <td>
                                <?php
                                $fullname =  $data[$i]["lastname"] . ", " . $data[$i]["firstname"];
                                $fullname = ucwords(strtolower($fullname))
                                ?>
                                {{ $fullname }}
                            </td>
                            <td>{{ $data[$i]["role"] == 1 ? "Admin" : "Other" }}</td>
                            <td>{{ $data[$i]["status"] == 1 ? "Active" : "Deactive" }}</td>
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
<div id="myModal1" class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User Account</h5>
                <button type="button" id="btnCloseModal2" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
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
            $('#myModal1').modal($('#myModal1').modal({
                backdrop: 'static',
                keyboard: false
            }));
        })

        $("#btnCancel").on("click", function() {})

        $("#btnSubmit1").on("click", function() {

        })

        $("#btnSubmit").on("click", function() {

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
            });
        }

    })
</script>
@endsection
