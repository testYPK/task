@extends('layouts.app')

@include('admin.navigation')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Awards</h1>
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
                        <tbody>
                        @foreach($awards as $award)
                            <tr>
                                <td>{{ $award->name }}</td>
                                <td>{{ $award->year }}</td>
                                <td>{{ $award->age }}</td>
                                <td>{{ $award->movie }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
