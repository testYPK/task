@extends('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-5">
            <h2 class="display-5" style="margin-bottom: 50px">Exertis Task</h2>
            <div class="col-sm">
                <a href="{{ route('auth.loginForm') }}" class="btn btn-primary">Login</a>
            </div>
            <div class="col-sm">
                <a href="{{ route('auth.registerForm') }}" class="btn btn-success">Register</a>
            </div>
        </div>
    </div>
</div>
