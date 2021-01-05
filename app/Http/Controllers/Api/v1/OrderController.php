<?php

namespace App\Http\Controllers\Api\V1;

use App\Entities\BillingAddress;
use App\Helpers\ApiConstants;
use App\Helpers\QueryExtractor;
use App\Http\Controllers\Controller;
use App\Repositories\BillingAddressRepository;
use App\Repositories\OrderRepository;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    private $orderRepo;
    private $billingAddRepo;
    public function __construct(OrderRepository $orderRepository , BillingAddressRepository $billingAddressRepository)
    {
        $this->orderRepo = $orderRepository;
        $this->billingAddRepo = $billingAddressRepository;
    }

    /**
     * @OA\Get(
     ** path="/v1/orders/history",
     *   tags={"Orders"},
     *   summary="Show order history",
     *   operationId="order_history",
     *
     *  @OA\Parameter(
     *      name="search_keywords",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     *  @OA\Parameter(
     *      name="fromDate",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     *  @OA\Parameter(
     *      name="toDate",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
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
    public function history(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'search_keywords' => 'bail|nullable|string',
                'fromDate' => 'bail|nullable|string',
                'toDate' => 'bail|nullable|string',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $builder = QueryExtractor::orderHistoryQuery($request);
            $orders = $builder->paginate(ApiConstants::PAGINATION_SIZE_API);
            return validResponse("Order history retrieved", collect_pagination(new OrderTransformer, $orders), $request);
        } catch (ValidationException $e) {
            $message = "Input validation errors";
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }

    /**
     * @OA\Post(
     ** path="/v1/orders/billing-address",
     *   tags={"Orders"},
     *   summary="Create , update or delete billing address",
     *   operationId="billing_address",
     *
     *  @OA\Parameter(
     *      name="action",
     *      in="query",
     *      description="create , update or delete. Provide an id when updating or deleting an address"
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     *  @OA\Parameter(
     *      name="address_id",
     *      in="query",
     *      description="bail|Required|string for update or delete actions"
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Name of address"
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="apartment_no",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="address",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="zip_code",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="town",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="city",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="state",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="country",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="phone",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="phone_2",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
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
    public function saveBillingAddress(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'address_id' => 'bail|nullable|string|exists:billing_addresses,id',
                'action' => 'bail|required|string',
                'name' => 'bail|required|string',
                'apartment_no' => 'bail|nullable|string',
                'address' => 'bail|required|string',
                'zip_code' => 'bail|nullable|string',
                'town' => 'bail|nullable|string',
                'city' => 'bail|nullable|string',
                'state' => 'bail|required|string',
                'country' => 'bail|required|string',
                'phone' => 'bail|required|string',
                'phone_2' => 'bail|nullable|string',
            ]);

            if ($validator->fails()) {
                session()->flash('errors', $validator->errors());
                throw new ValidationException($validator);
            }


            if(in_array(strtolower($request["action"]) , ["create" , "update"])){
                $data = $validator->validated();
                unset($data["action"]);
                unset($data["address_id"]);
                $this->billingAddRepo->updateOrCreate(
                    ["id" => $request["address_id"]] ,
                    $data
                );
                $message = "Billing address saved successfully";
            }
            else{
                $this->billingAddRepo->delete($request["address_id"]);
                $message = "Billing address deleted successfully";
            }
            return validResponse($message);
        } catch (ValidationException $e) {
            $message = "Input validation errors";
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }


    /**
     * @OA\Get(
     ** path="/v1/orders/invoice",
     *   tags={"Orders"},
     *   summary="Show order invoice",
     *   operationId="order_invoice",
     *
     *  @OA\Parameter(
     *      name="order_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
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
    public function invoice(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'order_id' => 'bail|required|string|exists:orders,id',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $order = $this->orderRepo->find($request["order_id"]);
            $transformer = new OrderTransformer(true);
            return validResponse("Order invoice retrieved", $transformer->transform($order), $request);
        } catch (ValidationException $e) {
            $message = "Input validation errors";
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }
}
