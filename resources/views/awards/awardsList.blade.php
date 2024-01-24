@extends('layouts.app')

@include('admin.navigation')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>Awards</h4>
                <div class="container text-center">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Year</th>
                            <th scope="col">Age</th>
                            <th scope="col">Movie</th>
                        </tr>
                        </thead>
                        @foreach($awards as $award)
                            <tbody>
                            <tr>
                                <td>{{ $award->name }}</td>
                                <td>{{ $award->year }}</td>
                                <td>{{ $award->age }}</td>
                                <td>{{ $award->movie }}</td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
