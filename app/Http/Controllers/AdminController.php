<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function roles(Request $request)
    {
        $user = User::find($request->user_id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Role assigned successfully');
    }

    public function orders()
    {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function search(Request $request)
    {
        $query = Order::query();

        if ($request->has('invoice_number') && !empty($request->invoice_number)) {
            $query->where('invoice_number', $request->invoice_number);
        }

        if ($request->has('customer_number') && !empty($request->customer_number)) {
            $query->where('customer_number', $request->customer_number);
        }

        if ($request->has('date') && !empty($request->date)) {
            $query->where('created_at', 'like', '%' . $request->date . '%');
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        return view('admin.orders', compact('orders'));
    }

    public function edit(Order $order)
    {
        return view('admin.edit-order', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->notes = $request->notes;
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order updated successfully');
    }

    public function delete(Order $order)
    {
        $order->deleted = true;
        $order->save();

        return back()->with('success', 'Order deleted successfully');
    }

    public function deletedOrders()
    {
        $orders = Order::onlyTrashed()->get();
        return view('admin.deleted-orders', compact('orders'));
    }

    public function restore(Order $order)
    {
        $order->deleted = false;
        $order->save();

        return back()->with('success', 'Order restored successfully');
    }
}

