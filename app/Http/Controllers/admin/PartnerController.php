<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;use Illuminate\Http\Request;
use Toastr;
class PartnerController extends Controller
{
           public function index()
           {
               $partner = Partner::all();
               return view('admin.pages.partner.index', compact('partner'));
           }
           public function store(Request $request)
           {
               try {
                   $request->validate([
                       'title' => 'required',
                       'image' => 'required',
                   ]);
                   $file = time().'.'.$request->image->extension();
                   $request->image->move(public_path('images/partner'), $file);

                   $partner = new Partner();
                   $partner->title = $request->title;
                   $partner->image = $file;
                   $partner->save();
                   Toastr::success('Partner Added Successfully', 'Success');
                   return redirect()->back();
               } catch (\Exception $e) {
                   return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
               }
           }

           public function update(Request $request, $id)
           {

               try {
                   $request->validate([
                       'title' => 'required',
                   ]);
                   $partner = Partner::find($id);
                   $partner->title = $request->title;
                   $partner->status = $request->status;
                   if ($request->image) {
                       $file = time() . '.' . $request->image->extension();
                       $request->image->move(public_path('images/partner'), $file);
                       $partner->image = $file;
                   }
                   $partner->save();
                   Toastr::success('Partner Updated Successfully', 'Success');
                   return redirect()->back();
               } catch (\Exception $e) {
                   return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
               }
           }

           public function destroy($id)
           {
               try {
                   $partner = Partner::find($id);
                   $filePath = public_path('images/partner/' . $partner->image);
                   if (file_exists($filePath)) {
                       unlink($filePath);
                   }
                   $partner->delete();
                   Toastr::success('Partner Deleted Successfully', 'Success');
                   return redirect()->back();
               } catch (\Exception $e) {
                   return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
               }
           }
}
