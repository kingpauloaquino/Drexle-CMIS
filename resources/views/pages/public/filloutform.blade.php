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
                                    <form action="/personal/registration/store" method="POST">

                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="firstname">First Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Juan" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="middlename">Middle Name: <span class="required">*</span> <input type="checkbox" id="noMiddlename" name="noMiddlename" /> <small style="font-size: 11px;">Check If no middlename</small></label>
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
                                                <select id="address2" name="address2" class="form-control">
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

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="stay">Total Years Stay <span class="required">*</span>:</label>
                                                <input type="number" class="form-control" id="stay" name="stay" placeholder="I.e.: 1 year" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="household">Total Household Member/s <span class="required">*</span>:</label>
                                                <input type="number" class="form-control" id="household" name="household" placeholder="I.e.: 5" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="birthdate">Birthdate: <span class="required">*</span></label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Email" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="birhtplace">Place of Birth <span class="required">*</span>:</label>
                                                <input type="text" class="form-control" id="birhtplace" name="birhtplace" placeholder="I.e.: Quezon City" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="gender">Gender <span class="required">*</span>:</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="civil">Civil Status <span class="required">*</span>:</label>
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
                                                <label for="blood">Blood Type <span class="required">*</span>:</label>
                                                <select id="blood" name="blood" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="AB">AB</option>
                                                    <option value="O">O</option>
                                                    <option value="A+">A+</option>
                                                    <option value="B+">B+</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email Address <span class="required">*</span>:</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="I.e.: yourname@gmail.com" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mobile">Mobile Number: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="I.e.: 09171234567" onkeypress="return isNumberKey(event)" required>
                                            </div>
                                        </div>

                                        <input type="hidden" id="verified" name="verified" />

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="work">Occupation/Work <span class="required">*</span>:</label>
                                                <input type="text" class="form-control" id="work" name="work" placeholder="I.e.: Software Engineer" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="skill">Skill <span class="required">*</span>:</label>
                                                <input type="text" class="form-control" id="skill" name="skill" placeholder="I.e.: Driving, Welding, Computer Repair" required>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block"><i class="fas fa-paper-plane"></i> Submit</button>
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
