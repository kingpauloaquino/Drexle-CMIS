@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Edit Personal Information
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
                                    <form action="/personal/edit-person/update/{{ $resident->id }}" method="POST">

                                        @csrf

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="age">ID number: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="id_number" name="id_number" placeholder="I.e.: Driver's License ID#" value="{{ $resident->id_number }}" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="firstname">First Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Juan" value="{{ $resident->firstname }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="middlename">Middle Name: <span class="required">*</span> <input type="checkbox" id="noMiddlename" name="noMiddlename" /> <small style="font-size: 11px;">Check If no middlename</small></label>
                                                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Dela" value="{{ $resident->middlename }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="lastname">Last Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Cruz" value="{{ $resident->lastname }}" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="stay">House#: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="address1" name="address1" placeholder="I.e.: 123" value="{{ $resident->address1 }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="household">Street: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="address2" name="address2" placeholder="I.e.: Murphy" value="{{ $resident->address2 }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="household">Purok: </label>
                                                <input type="text" class="form-control" id="address3" name="address3" placeholder="Optional" value="{{ $resident->address3 }}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="stay">Total Years Stay:</label>
                                                <input type="number" class="form-control" id="stay" name="stay" placeholder="I.e.: 1 year" value="{{ $resident->year_stay }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="household">Total Household Member/s:</label>
                                                <input type="number" class="form-control" id="household" name="household" placeholder="I.e.: 5" value="{{ $resident->household }}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="birthdate">Birthdate: <span class="required">*</span></label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Email" value="{{ $resident->birthdate }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="birhtplace">Place of Birth:</label>
                                                <input type="text" class="form-control" id="birhtplace" name="birhtplace" placeholder="I.e.: Quezon City" value="{{ $resident->birthplace }}" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="gender">Gender:</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1" {{ $resident->gender == 1 ? "selected=true" : "" }}>Male</option>
                                                    <option value="2" {{ $resident->gender == 2 ? "selected=true" : "" }}>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="civil">Civil Status:</label>
                                                <select id="civil" name="civil" class="form-control">
                                                    <option value="0" selected>Choose...</option>
                                                    <option value="1" {{ $resident->gender == 1 ? "selected=true" : "" }}>Single</option>
                                                    <option value="2" {{ $resident->gender == 2 ? "selected=true" : "" }}>Married</option>
                                                    <option value="3" {{ $resident->gender == 3 ? "selected=true" : "" }}>Seperated</option>
                                                    <option value="4" {{ $resident->gender == 4 ? "selected=true" : "" }}>Widowed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nationality">Nationality: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="I.e.: Filipino" value="{{ $resident->nationality }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="blood">Blood Type:</label>
                                                <input type="text" class="form-control" id="blood" name="blood" placeholder="I.e.: AB+" value="{{ $resident->blood }}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email Address (Optional):</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="I.e.: yourname@gmail.com" value="{{ $resident->email }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mobile">Mobile Number: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="I.e.: 09171234567" value="{{ $resident->mobile }}" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="work">Occupation/Work:</label>
                                                <input type="text" class="form-control" id="work" name="work" placeholder="I.e.: Software Engineer" value="{{ $resident->work }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="skill">Skill:</label>
                                                <input type="text" class="form-control" id="skill" name="skill" placeholder="I.e.: Driving, Welding, Computer Repair" value="{{ $resident->skill }}">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">Update</button>
                                        <a href="/personal/delete-person/{{ $resident->id }}" class="btn btn-danger btn-user btn-block">Delete</a>
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
        $("#noMiddlename").change(function() {
            if ($(this).prop('checked')) {
                $("#middlename").removeAttr("required");
            } else {
                $("#middlename").attr("required", true);
            }
        });
    })
</script>
@endsection
