@extends('layouts.app')
@section('auth')

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="display-5" style="margin-bottom: 50px">Registration</h2>
                <form action="{{ route('auth.register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Username : </label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Email : </label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Password : </label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary mt-2" style="background-color: #ef4444">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection
