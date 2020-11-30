<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ProductCategories = ProductCategory::paginate(10);
        return view('Admin\product-category\index', compact('ProductCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin\product-category\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        $productCategory = new ProductCategory;

        $productCategoryImage = $request->image;
        $productCategoryImageNewName = time() . $productCategoryImage->getClientOriginalName();
        $productCategoryImage->move('uploads/product-category', $productCategoryImageNewName);

        $productCategory->name = $request->name;
        $productCategory->slug = $request->slug;
        $productCategory->image = 'uploads/product-category/' . $productCategoryImageNewName;

        $productCategory->save();
        toastr()->success('Data has been saved successfully!');
        return redirect()->route('index.productcategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($productCategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);
        return view('Admin\product-category\edit', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productCategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);
        return view('Admin\product-category\edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productCategoryId)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        $productCategory = ProductCategory::findOrFail($productCategoryId);

        if ($request->hasFile('image')) {
            $productCategoryImage = $request->image;

            $productCategoryImageNewName = time() . $productCategoryImage->getClientOriginalName();

            $productCategoryImage->move('uploads/product-category', $productCategoryImageNewName);

            $productCategoryImage->image = 'uploads/product-category/' . $productCategoryImageNewName;

            $productCategory->save();
        }

        $productCategory->name = $request->name;
        $productCategory->slug = $request->slug;
        $productCategory->image = 'uploads/product-category/' . $productCategoryImageNewName;

        $productCategory->update();
        toastr()->success('Data has been updated successfully!');
        return redirect()->route('index.productcategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCategoryId)
    {
        $productCategory = ProductCategory::findOrFail($productCategoryId);

        if(file_exists($productCategory->image))
        {
            unlink($productCategory->image);
        }

        $productCategory->delete();

        toastr()->success('Data has been Deleted successfully!');
        return redirect()->back();
    }
}
