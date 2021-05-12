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
                                                    <option value="2">By Street</option>
                                                    <option value="3">Custom</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="divStreets" class="form-row" style="display: none;">
                                            <div class="form-group col-md-12">
                                                <label for="custom">Street:</label>
                                                <select id="street" name="street" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="17th Street">17th Street</option>
                                                    <option value="18th Street">18th Street</option>
                                                    <option value="20th Street">20th Street</option>
                                                    <option value="21st Street">21st Street</option>
                                                    <option value="23rd Street">23rd Street</option>
                                                    <option value="24th Street">24th Street</option>
                                                    <option value="25th Street">25th Street</option>
                                                    <option value="26th Street">26th Street</option>
                                                    <option value="27th Street">27th Street</option>
                                                    <option value="Afable">Afable</option>
                                                    <option value="Ardoin">Ardoin</option>
                                                    <option value="Barretto">Barretto</option>
                                                    <option value="Canda">Canda</option>
                                                    <option value="Dahl">Dahl</option>
                                                    <option value="Elecaño">Elecaño</option>
                                                    <option value="Fontaine">Fontaine</option>
                                                    <option value="Graham">Graham</option>
                                                    <option value="Harris">Harris</option>
                                                    <option value="Ibarra">Ibarra</option>
                                                    <option value="Johnson">Johnson</option>
                                                    <option value="Johnson Ext.">Johnson Ext.</option>
                                                    <option value="Katipunan">Katipunan</option>
                                                    <option value="Lapu-Lapu">Lapu-Lapu</option>
                                                    <option value="Little Baguio 1">Little Baguio 1</option>
                                                    <option value="Little Baguio 2">Little Baguio 2</option>
                                                    <option value="Mabini">Mabini</option>
                                                    <option value="Rizal Avenue">Rizal Avenue</option>
                                                    <option value="Upper Sibul 1">Upper Sibul 1</option>
                                                    <option value="Upper Sibul 2">Upper Sibul 2</option>
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

            $("#divStreets").hide();
            $("#divCustomNumbers").hide();

            if (parseInt(selected) == 2) {
                $("#divStreets").show();
            }
            if (parseInt(selected) == 3) {
                $("#divCustomNumbers").show();
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
