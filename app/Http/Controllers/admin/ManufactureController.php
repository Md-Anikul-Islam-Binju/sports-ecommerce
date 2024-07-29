<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacture;use Illuminate\Http\Request;
use Toastr;
class ManufactureController extends Controller
{
        public function index()
        {
            $manufacture = Manufacture::all();
            return view('admin.pages.manufacture.index', compact('manufacture'));
        }
        public function store(Request $request)
        {
            try {
                $request->validate([
                    'title' => 'required',
                    'image' => 'required',
                ]);
                $file = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/manufacture'), $file);

                $manufacture = new Manufacture();
                $manufacture->title = $request->title;
                $manufacture->image = $file;
                $manufacture->save();
                Toastr::success('Manufacture Added Successfully', 'Success');
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
                $manufacture = Manufacture::find($id);
                $manufacture->title = $request->title;
                $manufacture->status = $request->status;
                if ($request->image) {
                    $file = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('images/manufacture'), $file);
                    $manufacture->image = $file;
                }
                $manufacture->save();
                Toastr::success('Manufacture Updated Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        public function destroy($id)
        {
            try {
                $manufacture = Manufacture::find($id);
                $filePath = public_path('images/manufacture/' . $manufacture->image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $manufacture->delete();
                Toastr::success('Manufacture Deleted Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
}
