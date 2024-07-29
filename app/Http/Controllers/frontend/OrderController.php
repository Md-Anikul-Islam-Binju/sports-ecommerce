<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
       //dd($request->all());
       if (!Auth::check()) {
           return redirect()->route('user.login');
       }

       $authUser = Auth::user();
       $cart = Session::get('cart', []);
       $subTotal = array_sum(array_map(function($item) {
           return $item['price'] * $item['qty'];
       }, $cart));
       $deliveryCharge = $request->delivery_charge == '120' ? 120 : 60;
       $total = $subTotal + $deliveryCharge;

       // Save the order
       $order = Order::create([
           'invoice_no' => 'INV-'.time(),
           'order_tracking_id' => strtoupper(Str::random(10)), // Add this line
           'user_id' => $authUser->id,
           'payment_method' => $request->payment_method,
           'delivery_charge' => $request->delivery_charge,
           'total' => $total,
       ]);

       // Save order items
       foreach ($cart as $item) {
           OrderItem::create([
               'order_id' => $order->id,
               'product_id' => $item['product_id'],
               'product_name' => $item['product_name'],
               'quantity' => $item['qty'],
               'price' => $item['price'],
           ]);

           // Update product stock
          $product = Product::find($item['product_id']);
          if ($product) {
              $product->available_stock -= $item['qty'];
              $product->stock_sell += $item['qty'];
              $product->save();
          }
       }


       // Clear the cart
       Session::forget('cart');

       // Handle payment method
       if ($request->payment_method == 'online') {
           // Save payment information
           Payment::create([
               'order_id' => $order->id,
               'user_id' => $authUser->id,
               'amount' => $total,
               'status' => 'pending',
               'transaction_id' => '', // Add transaction ID if available
           ]);

           // Redirect to the payment page
           return redirect()->route('payment.page', ['order' => $order->id]);
       }
       // If COD, redirect to order success page
       return redirect()->route('order.success', ['order' => $order->id]);
       //return redirect()->route('order.success', ['order' => $order->id]);
   }

   public function success(Order $order)
   {
       return view('user.pages.checkout.success', compact('order'));
   }

   //Guest Order
    public function placeGuestOrder(Request $request)
    {
        $cart = Session::get('cart', []);

        $subTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['qty'];
        }, $cart));

        $deliveryCharge = $request->delivery_charge == '120' ? 120 : 60;
        $total = $subTotal + $deliveryCharge;

        // Generate a random password
        $generatedPassword = Str::random(8);

        // Check if the email is provided
        if ($request->email) {
            $user = User::updateOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'password' => Hash::make($generatedPassword), // Random password
                    'role' => 'user',
                ]
            );
        } else {
            $email = strtolower(str_replace(' ', '.', $request->name)) . '@gmail.com';
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $email,
                'password' => Hash::make($generatedPassword),
                'role' => 'user',
            ]);
        }

        // Save the order
        $order = Order::create([
            'invoice_no' => 'INV-'.time(),
            'order_tracking_id' => strtoupper(Str::random(10)),
            'user_id' => $user->id,
            'payment_method' => $request->payment_method,
            'delivery_charge' => $request->delivery_charge,
            'total' => $total,
        ]);

        // Save order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);

            // Update product stock
            $product = Product::find($item['product_id']);
            if ($product) {
                $product->available_stock -= $item['qty'];
                $product->stock_sell += $item['qty'];
                $product->save();
            }
        }

        // Clear the cart
        Session::forget('cart');

        // Handle payment method
        if ($request->payment_method == 'online') {
            // Save payment information
            Payment::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'amount' => $total,
                'status' => 'pending',
                'transaction_id' => '', // Add transaction ID if available
            ]);

            // Redirect to the payment page
            return redirect()->route('payment.page', ['order' => $order->id]);
        }

        // Redirect to the guest order success page
        return redirect()->route('order.success.as.gust', ['order' => $order->id,'password' => $generatedPassword]);
    }

    public function guestOrderSuccess(Order $order,$password)
    {
        $user = $order->user;
        return view('user.pages.checkout.guestSuccess', compact('order', 'user', 'password'));
    }
}
