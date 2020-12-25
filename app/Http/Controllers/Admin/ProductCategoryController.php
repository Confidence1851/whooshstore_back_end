<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\StoreProductCategory;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
    public function store(StoreProductCategory  $request)
    {
        try {
            $productCategory = new ProductCategory;

            $productCategoryImage = $request->image;
            $productCategoryImageNewName = time() . $productCategoryImage->getClientOriginalName();
            $productCategoryImage->move('uploads/product-category', $productCategoryImageNewName);

            $productCategory->name = $request->name;
            $productCategory->slug = Str::slug($request->name);
            $productCategory->image = 'uploads/product-category/' . $productCategoryImageNewName;

            $productCategory->save();
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('index.productcategories');
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
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
        return view('Admin\product-category\show', compact('productCategory'));
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
    public function update(StoreProductCategory $request, $productCategoryId)
    {
        try {
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
    public function destroy($productCategoryId)
    {
        try {
            $productCategory = ProductCategory::findOrFail($productCategoryId);

            if (file_exists($productCategory->image)) {
                unlink($productCategory->image);
            }

            $productCategory->delete();

            toastr()->success('Data has been Deleted successfully!');
            return redirect()->back();
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }
}
