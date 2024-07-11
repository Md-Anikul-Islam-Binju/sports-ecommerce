<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;use Illuminate\Http\Request;

class UserMessageManageController extends Controller
{
    public function message()
    {
        $message = Message::latest()->get();
        return view('admin.pages.message.index',compact('message'));
    }
}
