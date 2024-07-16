<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\Redirect;
use Toastr;
class WishlistController extends Controller
{
    public function toggleWishlist(Request $request)
    {
//        if (!Auth::check()) {
//            return response()->json(['redirect' => route('user.login')]);
//        }

        $productId = $request->input('product_id');
        $userId = Auth::id();

        $wishlist = Wishlist::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed', 'message' => 'Product removed from wishlist successfully.']);
        } else {
            Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);
            return response()->json(['status' => 'added', 'message' => 'Product added to wishlist successfully.']);
        }
    }

       public function wishlist()
       {
           if (!Auth::check()) {
               return Redirect::route('user.login');
           }
           $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->latest()->get();
           return view('user.pages.wishlist.wishlist', compact('wishlists'));
       }

       public function removeWishlist($id)
       {
           Wishlist::find($id)->delete();
           Toastr::success('Product removed from wishlist successfully', 'Success');
           return redirect()->back();
       }

}
