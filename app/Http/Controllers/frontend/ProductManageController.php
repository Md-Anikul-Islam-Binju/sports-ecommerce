<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\SiteSetting;
use App\Models\Wishlist;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use function Ramsey\Uuid\v1;

class ProductManageController extends Controller
{
    public function allProducts(Request $request, $categoryId = null, $subCategoryId = null)
    {
        $categories = Category::with('subCategories')->get();
        $query = Product::where('status', 1);

        // Handle search query
        $search = $request->query('search');
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Handle category and subcategory filters
        if ($categoryId) {
            $query->where('category_id', $categoryId);
            if ($subCategoryId) {
                $query->where('sub_category_id', $subCategoryId);
            }
        } else {
            $query->whereNotNull('available_stock')->where('available_stock', '>', 0);
        }

        $limit = $request->get('limit', 12);
        $products = $query->latest()->paginate($limit);

        $userWishlist = [];
        if (Auth::check()) {
            $userWishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        return view('user.pages.product.product', compact('categories', 'products', 'categoryId', 'subCategoryId', 'userWishlist', 'search'));
    }



    public function productDetails($id)
    {
        $product = Product::where('id',$id)->first();
        $relatedProducts = Product::where('is_related', 1)
            ->where('status', 1)
            ->whereNotNull('available_stock')
            ->where('available_stock', '>', 0)
            ->latest()
            ->get();

        $userWishlist = [];
        if (Auth::check()) {
            $userWishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }
        $productReviews = ProductReview::where('status', 1)->with('user')->get();
        $siteSetting = SiteSetting::first();
        return view('user.pages.product.productDetails',compact('product','relatedProducts','userWishlist','productReviews','siteSetting'));

    }

    public function bulkProduct()
    {
        $products = Product::where('status',1)->paginate(16);
        $userWishlist = [];
        if (Auth::check()) {
            $userWishlist = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }
        return view('user.pages.product.bulkProduct',compact('products','userWishlist'));
    }


}
