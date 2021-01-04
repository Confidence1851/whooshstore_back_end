<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Orders = Order::paginate(10);
        if(count($Orders)){
            foreach ($Orders as $value) {
                $value->user = User::where('id', $value->user_id)->firstOrFail();
            }
        }
        return view('Admin\order\index', compact('Orders'));
    }

    public function unapproved_orders(){
        $orders = Order::where('status','Pending')->orderBy('id' , 'desc')->paginate(6);
        
    }

    public function approved_orders(){
        $approval = Order::where('status', 'Approved')->orderBy('id' , 'desc')->paginate(6);
        
    }

    public function order_info($id)
    {
        $order = Order::findorfail($id);
        return view('admin.orders.unapproved.info',compact('verification'));
    }

    public function verify_order(Request $request, $id)
    {
        
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
        $OrderItem = OrderItem::where('order_id', $id)->get();
        if (count($OrderItem)) {
            foreach ($OrderItem as $value) {
                $value->product = Product::where('id', $value->product_id)->firstOrFail();
            }
        }
        $order = Order::findorfail($id);
        $order->user = User::where('id', $order->user_id)->firstOrFail();
        return view('Admin\order\show',compact('order','OrderItem'));
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
