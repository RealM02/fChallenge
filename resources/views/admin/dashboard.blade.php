@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            {{ __('You are logged in as an administrator!') }}
        </div>
    </div>
@endsection
