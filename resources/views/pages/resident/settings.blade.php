@extends('layouts.resident')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Profile
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
                                    <form action="/personal/user/settings/execute" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        <div class="form-row mt-3">
                                            <div class="form-group col-md-12">
                                                <label for="lastname">New password:</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="New password" required>
                                            </div>
                                        </div>

                                        <div class="form-row mt-3">
                                            <div class="form-group col-md-12">
                                                <label for="lastname">Re-type new password:</label>
                                                <input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Re-type new password" required>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block"><i class="fas fa-paper-plane"></i> Update</button>
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
