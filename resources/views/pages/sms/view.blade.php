@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-header-title">
                            SMS Message History
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
                            <th>To</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @for($i = 0; $i < COUNT($data); $i++) <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $data[$i]["subject"] }}</td>
                            <td>{{ $data[$i]["mobile"] }}</td>
                            <td>{{ $data[$i]["message"] }}</td>
                            <td>
                                @if($data[$i]["status"] == 1)
                                    Sent
                                @elseif($data[$i]["status"] == 2)
                                    Failed
                                @else
                                    Pending
                                @endif
                            </td>
                            <td>{{ $data[$i]["created_at"] }}</td>
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
