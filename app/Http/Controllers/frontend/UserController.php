<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        Session(['link' => url()->previous()]);
        return view('user.pages.auth.login');
    }
     public function userRegister()
    {
        return view('user.pages.auth.register');
    }

    public function userRegisterPost(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',

        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => 'user',
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect()->route('user.my.profile')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registration failed! Please try again.');
        }
    }

    public function userLoginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            //return redirect(Session('link'));
            return redirect()->back();
        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function userLoginAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('user.my.profile');
        }
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function userLogout()
    {
        Auth::logout();
       return redirect()->to('/');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'old-password' => 'nullable|string|min:8',
            'new-password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;

        if ($request->hasFile('profile')) {
            $file = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images/profile'), $file);
            $user->profile = $file;
        }

        if ($request->filled('old-password') && $request->filled('new-password')) {
            if (Hash::check($request->input('old-password'), $user->password)) {
                $user->password = Hash::make($request->input('new-password'));
            } else {
                return redirect()->back()->withErrors(['old-password' => 'Old password is incorrect']);
            }
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }


    public function myProfile()
    {
        $user = Auth::user();
        $orders = Order::where('user_id',auth()->user()->id)->with('orderItem.product')->get();
        //dd($order);
        return view('user.pages.profile.profile', compact('user','orders'));
    }

    public function userInvoice($id)
    {
        $order = Order::where('id',$id)->with('orderItem.product')->first();
        return view('user.pages.profile.invoice', compact('order'));
    }
}
