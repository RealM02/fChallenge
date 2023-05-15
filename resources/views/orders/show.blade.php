@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>
    <!-- Display order details like products, quantity, price, etc -->
    @if ($imagePath)
        <img src="{{ $imagePath }}" alt="Delivered Image">
    @endif
@endsection