<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Toastr;

class SizeController extends Controller
{
    public function index()
    {
        $size = Size::all();
        return view('admin.pages.size.index', compact('size'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'size' => 'required',
                'chest' => 'required',
                'length' => 'required',
            ]);
            $size = new Size();
            $size->size = $request->size;
            $size->chest = $request->chest;
            $size->length = $request->length;
            $size->save();
            Toastr::success('Size Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'size' => 'required',
                'chest' => 'required',
                'length' => 'required',
            ]);
            $size = Size::find($id);
            $size->size = $request->size;
            $size->chest = $request->chest;
            $size->length = $request->length;
            $size->status = $request->status;
            $size->save();
            Toastr::success('Size Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $size = Size::find($id);
            $size->delete();
            Toastr::success('Size Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
