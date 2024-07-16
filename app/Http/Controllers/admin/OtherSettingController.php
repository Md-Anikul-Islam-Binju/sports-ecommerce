<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OtherSetting;use Illuminate\Http\Request;
use Toastr;
class OtherSettingController extends Controller
{
        public function index()
        {
            $otherSetting = OtherSetting::all();
            return view('admin.pages.otherSetting.index', compact('otherSetting'));
        }
        public function store(Request $request)
        {
            try {
                $request->validate([
                    'category' => 'required',
                    'details' => 'required',
                ]);
                $otherSetting = new OtherSetting();
                $otherSetting->category = $request->category;
                $otherSetting->details = $request->details;
                $otherSetting->save();
                Toastr::success('OtherSetting Added Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        public function update(Request $request, $id)
        {

            try {
                $request->validate([
                     'category' => 'required',
                     'details' => 'required',
                ]);
                $otherSetting = OtherSetting::find($id);
                $otherSetting->category = $request->category;
                $otherSetting->details = $request->details;
                $otherSetting->save();
                Toastr::success('Other Setting Updated Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        public function destroy($id)
        {
            try {
                $otherSetting = OtherSetting::find($id);
                $otherSetting->delete();
                Toastr::success('Other Setting Deleted Successfully', 'Success');
                return redirect()->back();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
}
