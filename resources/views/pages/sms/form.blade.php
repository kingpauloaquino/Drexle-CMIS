@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            SMS Advisory
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
                                    <form action="/sms-advisory/execute" method="POST">

                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="subject">Subject:</label>
                                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject here..." require>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="message">Message:</label>
                                                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Message here..." require></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="recipients">Recipients:</label>
                                                <select id="recipients" name="recipients" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1">All Residencies</option>
                                                    <option value="2">Custom</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="divCustomNumbers" class="form-row" style="display: none;">
                                            <div class="form-group col-md-12">
                                                <label for="custom">Custom Numbers:</label>
                                                <input type="text" class="form-control" id="custom" name="custom" placeholder="I.e.: 09171234567, 09184321876">
                                            </div>
                                        </div>
                                        <button id="btnSubmit" class="btn btn-primary btn-user btn-block">Submit</button>
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#recipients').on('change', function() {
            var selected = $(this).find(":selected").val();

            if (parseInt(selected) == 0) {
                alert("Please select recipients.");
                return false;
            }

            if (parseInt(selected) > 1) {
                $("#divCustomNumbers").show();
            } else {
                $("#divCustomNumbers").hide();
            }
        });

        // $('btnSubmit').on('click', function() {

        //     var recipients = $("#recipients").val();

        //     if (parseInt(recipients) == 0) {
        //         alert("Please select recipients.");
        //         return false;
        //     }

        //     var subject = $("#subject").val();
        //     var message = $("#message").val();
        //     var custom = $("#custom").val();
        // });
    })
</script>
@endsection
