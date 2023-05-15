<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display all orders.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('invoice_number')) {
            $query->where('invoice_number', 'like', '%' . $request->input('invoice_number') . '%');
        }

        if ($request->has('customer_number')) {
            $query->where('customer_number', 'like', '%' . $request->input('customer_number') . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
            }
            $orders = $query->paginate(10);

            return view('orders.index', compact('orders'));
        }
        
        /**
         * Show the form for creating a new order.
         *
         * @return \Illuminate\View\View
         */
        public function create()
        {
            return view('orders.create');
        }
        
        /**
         * Store a newly created order in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(Request $request)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'invoice_number' => 'required|unique:orders',
                'customer_number' => 'required',
                'status' => 'required',
                // Add any other validation rules for the order fields
            ]);
        
            // Create a new order
            $order = new Order();
            $order->invoice_number = $request->input('invoice_number');
            $order->customer_number = $request->input('customer_number');
            $order->status = $request->input('status');
            // Set other order properties
        
            // Save the order
            $order->save();
        
            // Redirect to the index page with a success message
            return redirect()->route('orders.index')->with('success', 'Order created successfully.');
        }
        
        /**
         * Show the form for editing the specified order.
         *
         * @param \App\Models\Order $order
         * @return \Illuminate\View\View
         */
        public function edit(Order $order)
        {
            return view('orders.edit', compact('order'));
        }
        
        /**
         * Update the specified order in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Order $order
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(Request $request, Order $order)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'invoice_number' => 'required|unique:orders,invoice_number,' . $order->id,
                'customer_number' => 'required',
                'status' => 'required',
                // Add any other validation rules for the order fields
            ]);
        
            // Update the order
            $order->invoice_number = $request->input('invoice_number');
            $order->customer_number = $request->input('customer_number');
            $order->status = $request->input('status');
            // Update other order properties
        
            // Save the updated order
            $order->save();
        
            // Redirect to the index page with a success message
            return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
        }
        
        /**
         * Remove the specified order from storage.
         *
         * @param \App\Models\Order $order
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy(Order $order)
        {
            // Delete the order
            $order->delete();
        
            // Redirect to the index page with a success message
            return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
        }
    }
            


