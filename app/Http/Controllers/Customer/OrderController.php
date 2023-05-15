<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display the main screen for customer to check order status.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('customer.orders.index');
    }

    /**
     * Show the order status to the customer.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $customerNumber = $request->input('customer_number');
        $invoiceNumber = $request->input('invoice_number');

        $order = Order::where('customer_number', $customerNumber)
            ->where('invoice_number', $invoiceNumber)
            ->first();

        return view('customer.orders.show', compact('order'));
    }
}
