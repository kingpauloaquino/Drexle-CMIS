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
                                    <form action="/personal/user/profile/execute" method="POST" enctype="multipart/form-data">

                                        @csrf


                                        <center>
                                            <table border="0">
                                                <tr>
                                                    <td style="height: 230px;">
                                                        <center>
                                                            <img src="{{ asset($res->image) }}" style="border: 2px solid gray; width: 192px; height: 192px;" />
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlFile1">Upload your 2x2 Photo</label>
                                                            <input type="file" name="file" class="form-control-file" id="file" accept="image/png, image/jpeg">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>

                                        <div class="form-row mt-3">
                                            <div class="form-group col-md-4">
                                                <label for="firstname">First Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Juan" value="{{ $res->firstname }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="middlename">Middle Name: <span class="required">*</span> <input type="checkbox" id="noMiddlename" name="noMiddlename" /> <small style="font-size: 11px;">Check If no middlename</small></label>
                                                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Dela" value="{{ $res->middlename }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="lastname">Last Name: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Cruz" value="{{ $res->lastname }}" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="stay">House#: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="address1" name="address1" placeholder="I.e.: 123" value="{{ $res->address1 }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="household">Street: <span class="required">*</span></label>
                                                <select id="address2" name="address2" class="form-control">
                                                    <option value="17th Street" {{ $res->address2 == "17th Street" ? "selected=true" : ""  }}>17th Street</option>
                                                    <option value="18th Street" {{ $res->address2 == "18th Street" ? "selected=true" : ""  }}>18th Street</option>
                                                    <option value="20th Street" {{ $res->address2 == "20th Street" ? "selected=true" : ""  }}>20th Street</option>
                                                    <option value="21st Street" {{ $res->address2 == "21st Street" ? "selected=true" : ""  }}>21st Street</option>
                                                    <option value="23rd Street" {{ $res->address2 == "23rd Street" ? "selected=true" : ""  }}>23rd Street</option>
                                                    <option value="24th Street" {{ $res->address2 == "24th Street" ? "selected=true" : ""  }}>24th Street</option>
                                                    <option value="25th Street" {{ $res->address2 == "25th Street" ? "selected=true" : ""  }}>25th Street</option>
                                                    <option value="26th Street" {{ $res->address2 == "26th Street" ? "selected=true" : ""  }}>26th Street</option>
                                                    <option value="27th Street" {{ $res->address2 == "27th Street" ? "selected=true" : ""  }}>27th Street</option>
                                                    <option value="Afable" {{ $res->address2 == "Afable" ? "selected=true" : ""  }}>Afable</option>
                                                    <option value="Ardoin" {{ $res->address2 == "Ardoin" ? "selected=true" : ""  }}>Ardoin</option>
                                                    <option value="Barretto" {{ $res->address2 == "Barretto" ? "selected=true" : ""  }}>Barretto</option>
                                                    <option value="Canda" {{ $res->address2 == "Canda" ? "selected=true" : ""  }}>Canda</option>
                                                    <option value="Dahl" {{ $res->address2 == "Dahl" ? "selected=true" : ""  }}>Dahl</option>
                                                    <option value="Elecaño" {{ $res->address2 == "Elecaño" ? "selected=true" : ""  }}>Elecaño</option>
                                                    <option value="Fontaine" {{ $res->address2 == "Fontaine" ? "selected=true" : ""  }}>Fontaine</option>
                                                    <option value="Graham" {{ $res->address2 == "Graham" ? "selected=true" : ""  }}>Graham</option>
                                                    <option value="Harris" {{ $res->address2 == "Harris" ? "selected=true" : ""  }}>Harris</option>
                                                    <option value="Ibarra" {{ $res->address2 == "Ibarra" ? "selected=true" : ""  }}>Ibarra</option>
                                                    <option value="Johnson" {{ $res->address2 == "Johnson" ? "selected=true" : ""  }}>Johnson</option>
                                                    <option value="Johnson Ext." {{ $res->address2 == "Johnson Ext." ? "selected=true" : ""  }}>Johnson Ext.</option>
                                                    <option value="Katipunan" {{ $res->address2 == "Katipunan" ? "selected=true" : ""  }}>Katipunan</option>
                                                    <option value="Lapu-Lapu" {{ $res->address2 == "Lapu-Lapu" ? "selected=true" : ""  }}>Lapu-Lapu</option>
                                                    <option value="Little Baguio 1" {{ $res->address2 == "Little Baguio 1" ? "selected=true" : ""  }}>Little Baguio 1</option>
                                                    <option value="Little Baguio 2" {{ $res->address2 == "Little Baguio 2" ? "selected=true" : ""  }}>Little Baguio 2</option>
                                                    <option value="Mabini" {{ $res->address2 == "Mabini" ? "selected=true" : ""  }}>Mabini</option>
                                                    <option value="Rizal Avenue" {{ $res->address2 == "Rizal Avenue" ? "selected=true" : ""  }}>Rizal Avenue</option>
                                                    <option value="Upper Sibul 1" {{ $res->address2 == "Upper Sibul 1" ? "selected=true" : ""  }}>Upper Sibul 1</option>
                                                    <option value="Upper Sibul 2" {{ $res->address2 == "Upper Sibul 2" ? "selected=true" : ""  }}>Upper Sibul 2</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="stay">Total Years Stay <span class="required">*</span>:</label>
                                                <input type="number" class="form-control" id="stay" name="stay" placeholder="I.e.: 1 year" value="{{ $res->year_stay }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="household">Total Household Member/s <span class="required">*</span>:</label>
                                                <input type="number" class="form-control" id="household" name="household" placeholder="I.e.: 5" value="{{ $res->household }}" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="birthdate">Birthdate: <span class="required">*</span></label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $res->birthdate }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="birhtplace">Place of Birth <span class="required">*</span>:</label>
                                                <input type="text" class="form-control" id="birhtplace" name="birhtplace" placeholder="I.e.: Quezon City" value="{{ $res->birthplace }}" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="gender">Gender <span class="required">*</span>:</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option value="1" {{ $res->gender == 1 ? "selected=true" : ""  }}>Male</option>
                                                    <option value="2" {{ $res->gender == 2 ? "selected=true" : ""  }}>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="civil">Civil Status <span class="required">*</span>:</label>
                                                <select id="civil" name="civil" class="form-control">
                                                    <option value="1" {{ $res->civil_status == 1 ? "selected=true" : ""  }}>Single</option>
                                                    <option value="2" {{ $res->civil_status == 2 ? "selected=true" : ""  }}>Married</option>
                                                    <option value="3" {{ $res->civil_status == 3 ? "selected=true" : ""  }}>Seperated</option>
                                                    <option value="4" {{ $res->civil_status == 4 ? "selected=true" : ""  }}>Widowed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nationality">Nationality: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="I.e.: Filipino" value="{{ $res->nationality }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="blood">Blood Type <span class="required">*</span>:</label>
                                                <select id="blood" name="blood" class="form-control">
                                                    <option value="A" {{ $res->blood == "A" ? "selected=true" : ""  }}>A</option>
                                                    <option value="B" {{ $res->blood == "B" ? "selected=true" : ""  }}>B</option>
                                                    <option value="AB" {{ $res->blood == "AB" ? "selected=true" : ""  }}>AB</option>
                                                    <option value="O" {{ $res->blood == "O" ? "selected=true" : ""  }}>O</option>
                                                    <option value="A+" {{ $res->blood == "A+" ? "selected=true" : ""  }}>A+</option>
                                                    <option value="B+" {{ $res->blood == "B+" ? "selected=true" : ""  }}>B+</option>
                                                    <option value="AB+" {{ $res->blood == "AB+" ? "selected=true" : ""  }}>AB+</option>
                                                    <option value="O+" {{ $res->blood == "O+" ? "selected=true" : ""  }}>O+</option>
                                                    <option value="A-" {{ $res->blood == "A-" ? "selected=true" : ""  }}>A-</option>
                                                    <option value="B-" {{ $res->blood == "B-" ? "selected=true" : ""  }}>B-</option>
                                                    <option value="AB-" {{ $res->blood == "AB-" ? "selected=true" : ""  }}>AB-</option>
                                                    <option value="O-" {{ $res->blood == "O-" ? "selected=true" : ""  }}>O-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="email">Email Address <span class="required">*</span>:</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="I.e.: yourname@gmail.com" value="{{ $res->email }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mobile">Mobile Number: <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="I.e.: 09171234567" value="{{ str_replace('+63', '0', $res->mobile) }}" onkeypress="return isNumberKey(event)" required>
                                            </div>
                                        </div>

                                        <input type="hidden" id="verified" name="verified" />

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="work">Occupation/Work <span class="required">*</span>:</label>
                                                <input type="text" class="form-control" id="work" name="work" placeholder="I.e.: Software Engineer" value="{{ $res->work }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="skill">Skill <span class="required">*</span>:</label>
                                                <input type="text" class="form-control" id="skill" name="skill" placeholder="I.e.: Driving, Welding, Computer Repair" value="{{ $res->skill }}" required>
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
