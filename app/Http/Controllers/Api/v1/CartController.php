<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\Cart;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Traits\Constants;
use App\Models\Payment;
use App\Traits\PaymentGateWays;
use Exception;
use Illuminate\Support\Facades\DB;

class CartController extends ApiController
{
    use Cart , Constants , PaymentGateWays;


    public function processCartActions(Request $request){

        if(empty($request['product_id'])){
            return response()->json(['success' => false, 'msg' => 'Could not validate request!']);
        }
        if(empty($request['quantity'])){
            $request['quantity'] = 1;
        }
        //dd($request->all());
        $processCart = $this->processCart($request['product_id'] , $request['quantity'], $request['plan_id']);
        return response()->json($processCart);
    }


    public function updateQuantity(Request $request){
        if(empty($request['product_id'])){
            return response()->json(['success' => false, 'msg' => 'Could not validate request!']);
        }
        if(empty($request['quantity'])){
            return response()->json(['success' => false, 'msg' => 'No quantity provided!']);
        }
        $processCart = $this->updateCartItemQuantity($request['product_id'] , $request['quantity']);

        return response()->json($processCart);
    }


    public function items(){
        $cart = getUserCart();
        $items = getUserCart()->cartItems;
        return view('web.cart', compact('cart', 'items'));
    }


    public function checkout(){
        $cart = getUserCart();
        $items = getUserCart()->cartItems;
        $user = auth('web')->user();
        $my_addresses = $user->addresses;
        return view('web.checkout', compact('cart','items' , 'my_addresses'));
    }

    public function checkoutm(Request $request){
        // dd($request->all());
        $data = $request->validate([
            'file' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,application/pdf',
            'comment' => 'nullable|string',
            'phone_no' => 'nullable|string',
            'reference' => 'required|string',
        ]);
        if(!empty( $file = $request->file('file'))){
            $data['file'] = putFileInPrivateStorage($file , $this->orderReceiptsFilePath);
        }

        // DB::beginTransaction();
        $cart = getUserCart();
        $data['user_id'] = auth('web')->id();
        $data['amount'] = $cart->total;
        $data['discount'] = $cart->discount;
        $data['reference'] = $cart->reference;
        $data['payment_type'] = 'Bank Transfer';

        $order = Order::create($data);

        foreach($cart->items as $item){
            $amount = 0;
            $discount = 0;
            if(!empty($item->product_id)){
                if(!empty($course = $item->course)){
                    $amount = $course->payableAmount();
                    $discount = $course->discount;
                }
            }
            else{
                if(!empty($plan = $item->plan)){
                    $amount = $plan->price;
                }
            }

            OrderItem::create([
                'order_id' => $order->id,
                'user_id' => auth('web')->id(),
                'product_id' => $item->product_id,
                'plan_id' => $item->plan_id,
                'amount' => $amount,
                'discount' => $discount,
            ]);

            if(!empty($item->product_id)){
                if(!empty($course = $item->course)){
                    $course->orders_count += 1;
                    $course->save();
                }
            }

            $item->delete();
        }

        refreshCart($cart->id , true);
        $return = [
            'msg' => 'Your order has been submitted and is awaiting approval!',
            'reference' => $order->reference,
        ];
        return redirect()->route('cart.checkout.success' , encrypt($return));
    }

    public function checkoutSuccess($data){
        $data = decrypt($data);
        $message = $data['msg'];
        $reference = $data['reference'];
        return view('web.checkout_complete' , compact('message' , 'reference'));
    }

    public function receipt(){
        $cart = getUserCart();
        $items = getUserCart()->cartItems;
        $user = auth('web')->user();
        return view('web.receipt',compact('cart','items','user'));
    }

    public function charge(Request $request){
        DB::beginTransaction();
        $cart = getUserCart();
        $request['amount'] = $cart->total;
        $process = $this->processStripe($request);
        if ($process['success']) {
            try{
            
                $order = Order::create([
                    'user_id'=> auth()->user()->id,
                    'order_ref_no' => time(),
                    'status' => $this->activeStatus,
                    'payment_id' => $process['payment']->id,
                    'delivery_address_id' => $request->address,
                ]);

                foreach($cart->cartItems as $item){
                    OrderItem::create([
                        'order_id' => $order->id,
                        'dish_id' => $item->dish_id,
                        'price' => $item->price,
                        'discount' => $item->discount,
                        'quantity' => $item->quantity,
                        'extra' => $item->extra,
                        'user_comment' => $item->comment,
                        'status' => $this->pendingStatus,
                    ]);
                    $item->delete();

                    try{
                        // Send emails
                    }
                    catch(Exception $e){}
                }

                refreshCart($cart->id);
                DB::commit();
                alert()->success('Payment is successful!');
                return redirect()->route('receipt');
            }
            catch(Exception $e){
                DB::rollback();
                dd($e->getMessage());
            }
        } else {
            // payment failed: display message to customer
            return $process['msg'];
        }
    }

}
