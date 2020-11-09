<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }
    public function add()
    {
        return view('admin.products.add');
    }
    public function edit()
    {
        return view('admin.products.edit');
    }
}
