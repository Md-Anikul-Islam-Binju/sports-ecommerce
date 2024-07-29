<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;use App\Models\Product;use App\Models\User;use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrder = Order::count();
        $totalOrderDelivered = Order::where('status', 'completed')->count();
        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalOrder', 'totalOrderDelivered'));
    }
}
