<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;use Illuminate\Http\Request;

class PaymentController extends Controller
{
        public function showPaymentPage($orderId)
        {
           $order = Order::find($orderId);
           if (!$order) {
               return redirect()->route('home')->with('error', 'Order not found.');
           }
           return view('user.pages.checkout.payment', compact('order'));
        }
}
