@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Blotter
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
                                    <form action="/blotter/create/store" method="POST">

                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="subject">Subject:</label>
                                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject here..." require>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="subject">Complainant Name:</label>
                                                <input type="text" class="form-control" id="complainant" name="complainant" placeholder="Complainant Name here..." require>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="subject">Suspect Name:</label>
                                                <input type="text" class="form-control" id="suspect" name="suspect" placeholder="Suspect Name here..." require>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="message">Description:</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description here..." require></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="recipients">Status:</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">On-going</option>
                                                    <option value="3">Resolved</option>
                                                </select>
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

    })
</script>
@endsection
