<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiConstants;
use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\Cart;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Traits\Constants;
use App\Models\Payment;
use App\Models\Product;
use App\Traits\PaymentGateWays;
use App\Transformers\CartTransformer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CartController extends ApiController
{
    use Cart, Constants, PaymentGateWays;


    /**
     * @OA\Post(
     ** path="/v1/cart/process",
     *   tags={"Cart"},
     *   summary="Add or remove from cart",
     *   operationId="cart_process",
     *
     *   @OA\Parameter(
     *      name="product_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="quantity",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function processActions(Request $request)
    {

        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'bail|required|string|exists:products,id',
                'quantity' => 'bail|required|string'
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $processCart = $this->processCart($request['product_id'], $request['quantity']);
            DB::commit();

            $message = $processCart["msg"];
            unset($processCart["msg"]);
            return validResponse($message, $processCart, $request);
        } catch (ValidationException $e) {
            DB::rollback();
            $message = "Input validation errors";
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }


    /**
     * @OA\Post(
     ** path="/v1/cart/update-item-quantity",
     *   tags={"Cart"},
     *   summary="Update product item quantity",
     *   operationId="update_item_quantity",
     *
     *   @OA\Parameter(
     *      name="product_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="quantity",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function updateQuantity(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'bail|required|string|exists:products,id',
                'quantity' => 'bail|required|string'
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $processCart = $this->updateCartItemQuantity($request['product_id'], $request['quantity']);

            DB::commit();
            $message = $processCart["msg"];
            unset($processCart["msg"]);
            return validResponse($message, $processCart, $request);
        } catch (ValidationException $e) {
            DB::rollback();
            $message = "Input validation errors";
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }


    /**
     * @OA\Get(
     ** path="/v1/cart/items",
     *   tags={"Cart"},
     *   summary="List cart items",
     *   operationId="cart_items",
     * 
     *  @OA\Parameter(
     *      name="token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="Not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function cartItems(Request $request)
    {
        try {
            $cart = getUserCart("api");
            $cartTransformer = new CartTransformer;
            return validResponse("Cart retieved", "", $cartTransformer->transform($cart));
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }


    public function checkoutm(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'file' => 'required|file|mimetypes:image/jpeg,image/png,image/jpg,application/pdf',
            'comment' => 'nullable|string',
            'phone_no' => 'nullable|string',
            'reference' => 'required|string',
        ]);
        if (!empty($file = $request->file('file'))) {
            $data['file'] = putFileInPrivateStorage($file, $this->orderReceiptsFilePath);
        }

        // DB::beginTransaction();
        $cart = getUserCart();
        $data['user_id'] = auth('web')->id();
        $data['amount'] = $cart->total;
        $data['discount'] = $cart->discount;
        $data['reference'] = $cart->reference;
        $data['payment_type'] = 'Bank Transfer';

        $order = Order::create($data);

        foreach ($cart->items as $item) {
            $amount = 0;
            $discount = 0;
            if (!empty($item->product_id)) {
                if (!empty($course = $item->course)) {
                    $amount = $course->payableAmount();
                    $discount = $course->discount;
                }
            } else {
                if (!empty($plan = $item->plan)) {
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

            if (!empty($item->product_id)) {
                if (!empty($course = $item->course)) {
                    $course->orders_count += 1;
                    $course->save();
                }
            }

            $item->delete();
        }

        refreshCart($cart->id, true);
        $return = [
            'msg' => 'Your order has been submitted and is awaiting approval!',
            'reference' => $order->reference,
        ];
        return redirect()->route('cart.checkout.success', encrypt($return));
    }

    public function checkoutSuccess($data)
    {
        $data = decrypt($data);
        $message = $data['msg'];
        $reference = $data['reference'];
        return view('web.checkout_complete', compact('message', 'reference'));
    }

    public function receipt()
    {
        $cart = getUserCart();
        $items = getUserCart()->cartItems;
        $user = auth('web')->user();
        return view('web.receipt', compact('cart', 'items', 'user'));
    }

    public function charge(Request $request)
    {
        DB::beginTransaction();
        $cart = getUserCart();
        $request['amount'] = $cart->total;
        $process = $this->processStripe($request);
        if ($process['success']) {
            try {

                $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'order_ref_no' => time(),
                    'status' => $this->activeStatus,
                    'payment_id' => $process['payment']->id,
                    'delivery_address_id' => $request->address,
                ]);

                foreach ($cart->cartItems as $item) {
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

                    try {
                        // Send emails
                    } catch (Exception $e) {
                    }
                }

                refreshCart($cart->id);
                DB::commit();
                return redirect()->route('receipt');
            } catch (Exception $e) {
                DB::rollback();
                dd($e->getMessage());
            }
        } else {
            // payment failed: display message to customer
            return $process['msg'];
        }
    }
}
