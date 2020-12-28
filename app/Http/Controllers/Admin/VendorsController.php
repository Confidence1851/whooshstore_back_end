<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::where('role', 2)->paginate(10);
        
        foreach ($Users as $key => $value) {
            $value->product_no = Product::where('user_id',$value->id)->count();
        }

        return view('Admin\vendor\index', compact('Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Products = Product::where('user_id',$id)->get();
        foreach ($Products as $value) {
            $value->Category = ProductCategory::where('id', $value->category_id)->firstOrFail();
        }
        $user = User::findOrFail($id);
        return view('Admin\vendor\show', compact('user','Products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve()
    {
        $Products = Product::where('status','Inactive')->get();
        foreach ($Products as $value) {
            $value->Category = ProductCategory::where('id', $value->category_id)->firstOrFail();
            $value->Vendor = User::findOrFail($value->user_id);
        }
        return view('Admin\vendor\approve', compact('Products'));
    }
    
    /**
     * approve the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveProduct(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->status = $request->status;

            $product->update();

            toastr()->success('Product has been approved successfully!');
            return redirect()->route('vendors.approve');
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
