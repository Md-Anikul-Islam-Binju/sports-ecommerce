<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;use App\Models\ProductReview;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use Toastr;
class OrderInfoAndReviewController extends Controller
{
    public function orderInfoAndReview($id)
    {
        $orderItems = OrderItem::where('id', $id)->with('order','product')->first();
        return view('user.pages.profile.orderInfoAndReview', compact('orderItems'));
    }

    public function orderReviewStore(Request $request)
    {
        try {
            $request->validate([
                'ratting' => 'required',
            ]);
            $review = new ProductReview();
            $review->user_id = Auth::user()->id;
            $review->product_id = $request->product_id;
            $review->ratting = $request->ratting;
            $review->details = $request->details;
            $review->save();
            Toastr::success('Review Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
