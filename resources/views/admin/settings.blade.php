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
            @foreach($settings as $setting)
                <div class="mb-3 mt-4">
                    @if($setting->type === 'checkbox')
                        <div class="mb-3 mt-4 form-check">
                            <label class="form-label">{{ $setting->label }}</label>
                            <input type="{{ $setting->type }}" class="form-check-input" name="{{ $setting->key }}"
                                {{ $setting->value ? 'checked' : '' }}>
                        </div>
                    @else
                        <label class="form-label">{{ $setting->label }}</label>
                        <input type="{{ $setting->type }}" class="form-control" name="{{ $setting->key }}"
                               value="{{ $setting->value }}">
                    @endif
                </div>
            @endforeach
            <button type="submit" class="btn btn-danger">Save</button>
        </form>
    </div>
@endsection
