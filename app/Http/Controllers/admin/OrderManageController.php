<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    public function orderPending()
    {
        $orders = Order::where('status','pending')->orderBy('id', 'DESC')->get();
        return view('admin.pages.order.orderPending', compact('orders'));
    }

    public function orderProcessing()
    {
        $orders = Order::where('status','processing')->orderBy('id', 'DESC')->get();
        return view('admin.pages.order.orderProcessing', compact('orders'));
    }

    public function orderCompleted()
    {
        $orders = Order::where('status','completed')->orderBy('id', 'DESC')->get();
        return view('admin.pages.order.orderCompleted', compact('orders'));
    }

    public function orderDecline()
    {
        $orders = Order::where('status','declined')->orderBy('id', 'DESC')->get();
        return view('admin.pages.order.orderDecline', compact('orders'));
    }

    public function orderDetails(Request $request, $id)
    {
        $order = Order::where('id', $id)->with('user','orderItem','payment')->first();
        return view('admin.pages.order.orderDetails', compact('order'));
    }

    public function orderStatusUpdate(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;

        if ($request->status === 'declined') {
            $request->validate([
                'remark' => 'required|string|max:255',
            ]);
            $order->remark = $request->remark;
        } else {
            $order->remark = null;
        }
        $order->save();
        return redirect()->back()->with('success', 'Order Status Updated Successfully');
    }

    public function invoice($id)
    {
         $order = Order::where('id', $id)->with('user','orderItem','payment')->first();
         return view('admin.pages.order.invoice', compact('order'));
    }
}
