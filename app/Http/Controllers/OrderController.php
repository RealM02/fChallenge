<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function edit(Order $order)
    {
        if ($order->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('orders.edit', compact('order'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        // Other validation rules...
        'delivered_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('delivered_image')) {
        $image = $request->file('delivered_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $filename);
        $validatedData['delivered_image'] = $filename;
    }

    $order = auth()->user()->orders()->create($validatedData);
}

public function show(Order $order)
{
    $imagePath = $order->delivered_image ? asset('storage/images/' . $order->delivered_image) : null;
    return view('orders.show', compact('order', 'imagePath'));
}

public function index(Request $request)
{
    $query = auth()->user()->orders();

    if ($request->filled('invoice_number')) {
        $query->where('invoice_number', $request->invoice_number);
    }

    if ($request->filled('customer_number')) {
        $query->where('customer_number', $request->customer_number);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $orders = $query->paginate(10);

    return view('orders.index', compact('orders'));

    $query = auth()->user()->orders()->withTrashed();

    // Search and filtering code...

    $orders = $query->paginate(10);

    return view('orders.index', compact('orders'));
}

public function deleted()
{
    $orders = auth()->user()->orders()->onlyTrashed()->paginate(10);

    return view('orders.deleted', compact('orders'));
}

public function restore(Order $order)
{
    $order->restore();

    return redirect()->route('orders.index')->with('success', 'Order restored successfully.');
}

}