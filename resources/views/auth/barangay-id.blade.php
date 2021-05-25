@extends('layouts.login')

@section('content')

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-4 col-md-3">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Forgot Barangay ID</h1>
                            </div>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            @if(Session::has('message'))
                            <div class="alert alert-success">
                                <i class="fa fa-check" aria-hidden="true"></i> {{ Session::get('message')}}
                            </div>
                            @endif

                            @if(Session::has('error'))
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ Session::get('error')}}
                            </div>
                            @endif

                            <form class="user" method="POST" action="/forgot/password-brgy-id/post">
                                @csrf

                                <input type="hidden" name="method" value="1" />

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="mobile" name="mobile" aria-describedby="emailHelp" placeholder="Enter Mobile Number..." required autofocus>
                                </div>

                                <button class="btn btn-primary btn-user btn-block">
                                    Submit
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/forgot/password">Forgot Password?</a>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/">Back to home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection
