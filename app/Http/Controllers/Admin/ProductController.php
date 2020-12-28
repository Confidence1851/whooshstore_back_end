<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('Admin\product\create', compact('categories', 'size', 'types', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct  $request)
    {

        // dd($request->all());
        try {
            $product = new Product;

            $product->product_name = $request->product_name;
            $product->slug = Str::slug($request->product_name);
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->details = $request->details;
            $product->tags = $request->tags;
            $product->percent_off = $request->percent_off;
            $product->weight = $request->weight;
            $product->video = $request->video;
            $product->color = $request->color;
            $product->size = $request->size;
            $product->type = $request->type;
            $product->status = $request->status;
            $product->category_id = $request->category_id;
       
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
        $categories = ProductCategory::get();
        $size = ['XXS','XS','S','M','L','XL','XXL','XXXL'];
        $types = ['New','Featured'];
        $status = ['Inactive','Active'];
        return view('Admin\product\edit', compact('product', 'categories', 'size', 'types', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, $productId)
    {
        // dd($request->all());

        try {
            $product = Product::findOrFail($productId);

            $product->product_name = $request->product_name;
            $product->slug = Str::slug($request->product_name);
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->details = $request->details;
            $product->tags = $request->tags;
            $product->percent_off = $request->percent_off;
            $product->weight = $request->weight;
            $product->video = $request->video;
            $product->color = $request->color;
            $product->size = $request->size;
            $product->type = $request->type;
            $product->status = $request->status;
            $product->category_id = $request->category_id;
            
            $product->update();

            toastr()->success('Data has been updated successfully!');
            return redirect()->route('index.products');
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
    public function destroy($productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $product->delete();

            toastr()->success('Data has been Deleted successfully!');
            return redirect()->back();
            
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }
}
