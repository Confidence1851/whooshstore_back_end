<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $vendors = User::where('role','Vendor')->orderBy('id','desc')->get();
        $users = User::where('role','Customer')->orderBy('id','desc')->get();

        return view('admin.dashboard', compact('users','vendors'));
    }
}
