<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Manufacture;use App\Models\OrderItem;use App\Models\Partner;use App\Models\Product;
use App\Models\ProductReview;use App\Models\Wishlist;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use function Ramsey\Uuid\v1;

class FrontendController extends Controller
{
    public function index()
    {
        $newArrivalProducts = Product::where('is_new_arrival', 1)
            ->where('status', 1)
            ->whereNotNull('available_stock')
            ->where('available_stock', '>', 0)
            ->latest()
            ->limit(16)
            ->get();
//        $mostPopularProducts = Product::where('is_popular', 1)
//            ->where('status', 1)
//            ->whereNotNull('available_stock')
//            ->where('available_stock', '>', 0)
//            ->latest()
//            ->get();

        $manufacture = Manufacture::Where('status', 1)->get();
        $partner = Partner::Where('status', 1)->get();
        $userWishlist = [];
        if (Auth::check()) {
            $userWishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }
        $productReviews = ProductReview::where('status', 1)->with('user')->get();
        $mostPurchasedProducts = OrderItem::select('product_id')
                ->selectRaw('SUM(quantity) as total_quantity')
                ->groupBy('product_id')
                ->orderBy('total_quantity', 'desc')
                ->get();
        $mostPopularProducts = Product::whereIn('id', $mostPurchasedProducts->pluck('product_id'))
             ->where('status', 1)
             ->whereNotNull('available_stock')
             ->where('available_stock', '>', 0)
             ->latest()
             ->limit(8)
             ->get();
        return view('user.dashboard',compact('newArrivalProducts','mostPopularProducts','manufacture','partner','userWishlist','productReviews'));
    }
}
