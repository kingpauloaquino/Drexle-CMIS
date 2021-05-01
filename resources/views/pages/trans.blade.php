@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            History List
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

                <!-- <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Firstname, lastname, work, mobile#" aria-label="Recipient's username" aria-describedby="btnSearch">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btnSearch">Search</button>
                    </div>
                </div> -->

                <h4>Total Issued: {{ $data_count[0]->totalCount }}</h4>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Cert. Type</th>
                            <th>Date Issued</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < COUNT($data); $i++) <tr>
                            <td>{{ $data[$i]->fullname  }}</td>
                            <td>{{ $data[$i]->typeName }}</td>
                            <td>{{ $data[$i]->date_issued }}</td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
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
