@extends('layouts.app')

@include('admin.navigation')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Log history</h4>
                <div class="container text-center">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">File path</th>
                            <th scope="col">Status</th>
                            <th scope="col">Records added</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->file_path }}</td>
                                <td>{{ $log->status }}</td>
                                <td>{{ $log->records_added }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
