<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $Products = Product::paginate(20);
        foreach ($Products as $value) {
            $value->Category = ProductCategory::where('id', $value->category_id)->firstOrFail();
        }
        return view('Admin\product\index', compact('Products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $size = ['XXS','XS','S','M','L','XL','XXL','XXXL'];
        $types = ['New','Featured'];
        $status = ['Inactive','Active'];
        $categories = ProductCategory::get();
        return view('Admin\product\create', compact('categories','size','types','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct  $request)
    {
        try {
            $product = new Product;

            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->details = $request->details;
            $product->tags = $request->tags;
            $product->percent_off = $request->percent_off;
            $product->weight = $request->weight;
            $product->color = $request->color;
            $product->size = $request->size;
            $product->type = $request->type;
            $product->status = $request->status;

            $product->save();
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('index.products');
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
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('Admin\product\edit', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('Admin\product\edit', compact('product'));
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
