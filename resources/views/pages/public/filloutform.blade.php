@extends('layouts.public')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Add Personal Information
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg">
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
                                    <form action="/personal/add-person/store" method="POST">

                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="age">ID number: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="id_number" name="id_number" placeholder="I.e.: Driver's License ID#" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="firstname">First Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Juan" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="middlename">Middle Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Dela" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="lastname">Last Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Cruz" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="stay">House#: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="address1" name="address1" placeholder="I.e.: 123" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="household">Street: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="address2" name="address2" placeholder="I.e.: Murphy" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="stay">Total Years Stay:</label>
                                                <input type="number" class="form-control" id="stay" name="stay" placeholder="I.e.: 1 year">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="household">Total Household Member/s:</label>
                                                <input type="number" class="form-control" id="household" name="household" placeholder="I.e.: 5">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="birthdate">Birhdate: <span class="required">*</span></label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Email" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="birhtplace">Place of Birth:</label>
                                                <input type="text" class="form-control" id="birhtplace" name="birhtplace" placeholder="I.e.: Quezon City" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="gender">Gender:</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="civil">Civil Status:</label>
                                                <select id="civil" name="civil" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1">Single</option>
                                                    <option value="2">Married</option>
                                                    <option value="3">Seperated</option>
                                                    <option value="4">Widowed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nationality">Nationality: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="I.e.: Filipino" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="blood">Blood Type:</label>
                                                <input type="text" class="form-control" id="blood" name="blood" placeholder="I.e.: AB+">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email Address (Optional):</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="I.e.: yourname@gmail.com">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mobile">Mobile Number: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="I.e.: 09171234567" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="work">Occupation/Work:</label>
                                                <input type="text" class="form-control" id="work" name="work" placeholder="I.e.: Software Engineer">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="skill">Skill:</label>
                                                <input type="text" class="form-control" id="skill" name="skill" placeholder="I.e.: Driving, Welding, Computer Repair">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">Submit</button>
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
