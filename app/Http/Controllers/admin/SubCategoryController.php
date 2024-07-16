<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;use App\Models\SubCategory;use Illuminate\Http\Request;
use Toastr;
class SubCategoryController extends Controller
{
        public function index()
        {
            $category = Category::all();
            $subCategories = SubCategory::with('category')->get();
            return view('admin.pages.subCategory.index', compact('category', 'subCategories'));
        }
        public function store(Request $request)
        {
            try {
                $request->validate([
                    'category_id' => 'required',
                    'name' => 'required',
                ]);
                $subCategories = new SubCategory();
                $subCategories->category_id = $request->category_id;
                $subCategories->name = $request->name;
                $subCategories->save();
                Toastr::success('Sub Category Added Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        public function update(Request $request, $id)
        {

            try {
                $request->validate([
                    'category_id' => 'required',
                    'name' => 'required',
                ]);
                $subCategories = SubCategory::find($id);
                $subCategories->category_id = $request->category_id;
                $subCategories->name = $request->name;
                $subCategories->status = $request->status;
                $subCategories->save();
                Toastr::success('Sub Category Updated Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        public function destroy($id)
        {
            try {
                $subCategories = SubCategory::find($id);
                $subCategories->delete();
                Toastr::success('Sub Category Deleted Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
}
