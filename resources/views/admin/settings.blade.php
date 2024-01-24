@extends('layouts.app')
@include('admin.navigation')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('admin.updateSettings') }}" method="post">
        @csrf
        <label for="file_name_template">Enter template for file:</label>
        <input type="text" id="file_name_template" name="file_name_template" value="{{ $template }}">
        <button type="submit">Save</button>
    </form>
@endsection
