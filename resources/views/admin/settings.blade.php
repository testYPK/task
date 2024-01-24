@extends('layouts.app')
@include('admin.navigation')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="m-4" style="width: 400px;">
        <h1>Settings</h1>
        <form action="{{ route('admin.update') }}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3 mt-4">
                <label for="file_path_template" class="form-label">Path for saving the file:</label>
                <input type="text" class="form-control" id="file_path_template" name="file_path_template"
                       value="{{ $settings->path ?? null }}">
            </div>
            <div class="mb-3">
                <label for="file_name_template" class="form-label">Pattern for file name:</label>
                <input type="text" class="form-control" id="file_name_template" name="file_name_template"
                       value="{{ $settings->file_name_pattern ?? null }}">
            </div>
            <div class="mb-3">
                <label for="load_schedule_template" class="form-label">Load schedule time:</label>
                <input type="text" class="form-control" id="load_schedule_template" name="load_schedule_template"
                       value="{{ $settings->load_schedule ?? null }}">
            </div>
            <div class="mb-3 form-check">
                <label for="load_enabled">
                    <input type="checkbox" class="form-check-input" name="load_enabled"
                        {{ $settings->load_enabled ? 'checked' : '' }}>
                    Enable load
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
