@extends('layouts.app')

@include('admin.navigation')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>Log history</h4>
                <div class="container text-center">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">File path</th>
                            <th scope="col">Status</th>
                            <th scope="col">Records added</th>
                        </tr>
                        </thead>
                        @foreach($logs as $log)
                            <tbody>
                            <tr>
                                <td>{{ $log->file_path }}</td>
                                <td>{{ $log->status }}</td>
                                <td>{{ $log->records_added }}</td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
