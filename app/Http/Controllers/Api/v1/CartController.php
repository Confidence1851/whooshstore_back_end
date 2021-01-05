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
use Illuminate\Validation\Rule;
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
            return validResponse("Cart retieved", $cartTransformer->transform($cart));
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }


    
    /**
     * @OA\Post(
     ** path="/v1/cart/checkout",
     *   tags={"Cart"},
     *   summary="Process cart checkout",
     *   operationId="cart_checkout",
     * 
     *  @OA\Parameter(
     *      name="method",
     *      in="query",
     *      description="Options: stripe",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="address_id",
     *      in="query",
     *      description="User billing address id",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="stripeToken",
     *      in="query",
     *      description="Required if method is stripe else leave empty",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
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
    public function processCheckout(Request $request)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'method' => 'bail|required|string',
                'address_id' => 'bail|required|string|exists:billing_addresses,id',
                'stripeToken' => Rule::requiredIf(strtolower($request["method"]) == "stripe"),
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $cart = getUserCart("api");
            $request['amount'] = $cart->total;
            $process = $this->processStripe($request);
            if ($process['success']) {

                $order = Order::create([
                    'user_id' => auth()->user()->id,
                    'reference' => time(),
                    'status' => ApiConstants::ACTIVE_STATUS,
                    'payment_id' => $process['payment']->id,
                    'billing_address_id' => $request->address_id,
                ]);

                foreach ($cart->cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'price' => $item->price,
                        'discount' => $item->discount,
                        'quantity' => $item->quantity,
                        'extra' => $item->extra,
                        'user_comment' => $item->comment,
                        'status' => ApiConstants::PENDING_STATUS,
                    ]);
                    $item->delete();

                    try {
                        // Send emails
                    } catch (Exception $e) {
                    }
                }

                refreshCart($cart->id);
                DB::commit();
                return validResponse("Payment successful");
            } else {
                // payment failed: display message to customer
                return problemResponse($process['msg'], ApiConstants::BAD_REQ_ERR_CODE, $request,);
            }
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
}
