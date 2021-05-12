@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            Blotter History
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>complainant</th>
                            <th>suspect</th>
                            <th>description</th>
                            <th>Status</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @for($i = 0; $i < COUNT($blotters); $i++) <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $blotters[$i]["subject"] }}</td>
                            <td>{{ $blotters[$i]["complainant_name"] }}</td>
                            <td>{{ $blotters[$i]["suspect_name"] }}</td>
                            <td>{{ $blotters[$i]["description"] }}</td>
                            <td>
                                @if($blotters[$i]["status"] == 2)
                                On-going
                                @elseif($blotters[$i]["status"] == 3)
                                Resolved
                                @else
                                Pending
                                @endif
                            </td>
                            <td>{{ $blotters[$i]["created_at"] }}</td>
                            </tr>
                            <?php $count++; ?>
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

</script>
@endsection
