<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;use App\Models\Size;
use App\Models\SubCategory;use Illuminate\Http\Request;
use Toastr;

class ProductController extends Controller
{
        public function index()
        {
            $products = Product::latest()->get();
            $categories = Category::where('status', 1)->latest()->get();
            $sizes = Size::where('status', 1)->latest()->get();

            foreach ($products as $product) {
                // Fetch sizes
                $sizeIds = json_decode($product->size_id);
                if (is_array($sizeIds)) {
                    $selectedSizes = Size::whereIn('id', $sizeIds)->pluck('size')->toArray();
                    $product->sizes = $selectedSizes;
                } else {
                    $product->sizes = [];
                }

                // Fetch sub-categories
                $subCategories = SubCategory::where('category_id', $product->category_id)->get();
                $product->subCategories = $subCategories;
            }

            return view('admin.pages.product.index', compact('products', 'categories', 'sizes'));
        }


    public function store(Request $request)
    {

        try {
            $request->validate([
                'category_id' => 'required',
                'name' => 'required',
                'amount' => 'required',
                'size_id' => 'required',
                'stock' => 'required',
                'image' => 'required',
                'tags' => 'nullable|string',
            ]);
            $imagePaths = [];
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $imageFile) {
                    $imageName = time() . '_' . uniqid() . '.' . $imageFile->extension();
                    $imageFile->move(public_path('images/product'), $imageName);
                    $imagePaths[] = $imageName;
                }
            }
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->name = $request->name;
            $product->amount = $request->amount;
            $product->discount_amount =$request->discount_amount;
            $product->size_id = json_encode($request->size_id);
            $product->stock = $request->stock;
            $product->available_stock =$request->stock;
            $product->details = $request->details;
            $product->is_related =$request->is_related;
            $product->is_new_arrival = $request->is_new_arrival;
            $product->is_popular =$request->is_popular;
            $product->is_customized = $request->is_customized;
            $product->image = json_encode($imagePaths);

            if ($request->tags) {
             $tagsArray = explode(',', $request->tags);
             $product->tags = json_encode($tagsArray);
            }

            $product->save();
            Toastr::success('Project File Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



    public function update(Request $request, $id)
    {
       // dd($request->all());
        try {
            $request->validate([
                'category_id' => 'required',
                'name' => 'required',
                'amount' => 'required',
                'size_id' => 'required',
                'stock' => 'required',
                'image' => 'sometimes|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'tags' => 'nullable|string',
            ]);
            $product = Product::findOrFail($id);
            $imagePaths = json_decode($product->image, true) ?? [];

            // Update images
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $imageFile) {
                    $imageName = time() . '_' . uniqid() . '.' . $imageFile->extension();
                    $imageFile->move(public_path('images/product'), $imageName);
                    $imagePaths[] = $imageName;
                }
            }

            // Remove deleted images
            if ($request->has('deleted_images')) {
                $deletedImages = json_decode($request->deleted_images, true);
                $imagePaths = array_diff($imagePaths, $deletedImages);
                foreach ($deletedImages as $deletedImage) {
                    $imagePath = public_path('images/product/' . $deletedImage);
                    if (!empty($deletedImage) && file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
            $product->update([
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'name' => $request->name,
                'amount' => $request->amount,
                'discount_amount' => $request->discount_amount,
                'size_id' => json_encode($request->size_id),
                'stock' => $request->stock,
                'available_stock' => $request->stock,
                'details' => $request->details,
                'is_related' => $request->is_related,
                'is_new_arrival' => $request->is_new_arrival,
                'is_popular' => $request->is_popular,
                'is_customized' => $request->is_customized,
                //'image' => json_encode($imagePaths),
                'image' => json_encode(array_values($imagePaths)),
                'tags' => $request->tags ? json_encode(explode(',', $request->tags)) : null,
            ]);
            Toastr::success('Product updated successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $images = json_decode($product->image, true);
            if ($images) {
                foreach ($images as $image) {
                    $imagePath = public_path('images/product/' . $image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
            $product->delete();
            Toastr::success('Product deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function reviewList()
    {
        $review = ProductReview::with('product','user')->latest()->get();
        $product = Product::latest()->get();
        return view('admin.pages.product.review', compact('review','product'));
    }

    public function reviewStatusUpdate(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required',
            ]);
            $review = ProductReview::findOrFail($id);
            $review->update([
                'status' => $request->status,
            ]);
            Toastr::success('Review updated successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
