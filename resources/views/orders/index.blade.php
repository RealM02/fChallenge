@extends('layouts.app')

@section('content')
    <h1>Orders Index</h1>
    <!-- Display orders table with actions like edit, delete, etc -->
    <form method="get" action="{{ route('orders.index') }}">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="invoice_number">Invoice Number</label>
            <input type="text" name="invoice_number" id="invoice_number" class="form-control" value="{{ request('invoice_number') }}">
        </div>
        <div class="form-group col-md-3">
            <label for="customer_number">Customer Number</label>
            <input type="text" name="customer_number" id="customer_number" class="form-control" value="{{ request('customer_number') }}">
        </div>
        <div class="form-group col-md-3">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
        </div>
        <div class="form-group col-md-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                @foreach (\App\Models\Order::STATUS_OPTIONS as $key => $value)
                    <option value="{{ $key }}" @if(request('status') == $key) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>

   </form>
@endsection