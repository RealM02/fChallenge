@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Deleted Orders</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Deleted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->deleted_at }}</td>
                                <td>
                                    <a href="{{ route('orders.restore', $order->id) }}" class="btn btn-primary btn-sm">Restore</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No deleted orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $orders->links() }}

                <form method="post" action="{{ route('orders.restore', $order) }}" class="d-inline">
                    @csrf
                    @method('patch')
                    <button type="submit" class="btn btn-sm btn-success">Restore</button>
                </form>
            </div>
        </div>
    </div>
@endsection
