<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
        public function addToCart(Request $request)
        {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'size_id' => 'required|exists:sizes,id',
                'qty' => 'required|integer|min:1',
                'price' => 'required|numeric',
            ]);
            $product = $this->getProductDetails($request->product_id);
            $size = $this->getSizeDetails($request->size_id);
            $cart = Session::get('cart', []);
            // Check if the product with the same size already exists in the cart
            foreach ($cart as $item) {
                if ($item['product_id'] == $request->product_id && $item['size_id'] == $request->size_id) {
                    return redirect()->back()->with('error', 'This product is already in your cart.');
                }
            }
            // Add the item to the cart
            $cartItemId = count($cart) + 1; // Using a sequential index for cart items
            $cart[$cartItemId] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'image' => $product->image,
                'size_id' => $size->id,
                'size_name' => $size->size,
                'qty' => $request->qty,
                'price' => $request->price,
            ];
            // Save the updated cart back to the session
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully.');
        }

        // Method to fetch product details based on product id
        private function getProductDetails($productId)
        {
            return Product::findOrFail($productId);
        }

        // Method to fetch size details based on size id
        private function getSizeDetails($sizeId)
        {
            return Size::findOrFail($sizeId);
        }

        // Method to display the cart
        public function showCart()
        {
            $cart = Session::get('cart', []);
            //dd($cart);
            return view('user.pages.cart.cart', compact('cart'));
        }

        public function updateCart(Request $request)
        {
            $cart = Session::get('cart', []);
            $productId = $request->input('product_id');
            $action = $request->input('action'); // 'plus' or 'minus'
            $quantities = $request->input('qty'); // Get the updated quantities
            if (!is_array($quantities)) {
                return response()->json(['error' => 'Invalid input'], 400);
            }
            if (array_key_exists($productId, $cart)) {
                if ($action === 'plus') {
                    $cart[$productId]['qty']++;
                } elseif ($action === 'minus' && $cart[$productId]['qty'] > 1) {
                    $cart[$productId]['qty']--;
                }
            }
            Session::put('cart', $cart);
            // Recalculate subtotal
            $subTotal = 0;
            foreach ($cart as $item) {
                $subTotal += $item['price'] * $item['qty'];
            }
            return redirect()->back()->with('success', 'Cart updated successfully.');
        }

        public function removeItem($productId)
        {
            $cart = Session::get('cart', []);
            if (array_key_exists($productId, $cart)) {
                unset($cart[$productId]);
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart successfully.');
        }

       public function checkout(Request $request)
       {
//           if (!Auth::check()) {
//               return redirect()->route('user.login');
//           }
           $cart = Session::get('cart', []);
           $authUser = Auth::user();
           return view('user.pages.checkout.checkout', compact('cart', 'authUser'));
       }
}
