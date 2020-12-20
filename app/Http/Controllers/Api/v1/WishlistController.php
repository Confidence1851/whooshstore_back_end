<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiConstants;
use App\Models\Wishlist;
use App\Transformers\WishlistTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WishlistController extends ApiController
{
    /**
     * @OA\Post(
     ** path="/v1/wishlist/process",
     *   tags={"Wishlist"},
     *   summary="Add or remove from wishlist",
     *   operationId="wishlist_process",
     *
     *   @OA\Parameter(
     *      name="product_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
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
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = auth("api")->user();
            $query = ["user_id" => $user->id, "product_id" => $request["product_id"]];
            $wishlist = Wishlist::where($query)->whereHas("product")->first();
            if (empty($wishlist)) {
                $message = "Added to wishlist";
                Wishlist::create($query);
            } else {
                $message = "Removed from wishlist";
                Wishlist::where($query)->delete();
            }
            DB::commit();
            return validResponse($message, null, $request);
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
     ** path="/v1/wishlist/items",
     *   tags={"Wishlist"},
     *   summary="Items in wishlist",
     *   operationId="wishlist_items",
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
    public function wishlistItems(Request $request)
    {

        try {
            $user = auth("api")->user();
            $wishlist = Wishlist::where("user_id", $user->id)->whereHas("product")->orderby("id", "desc")->paginate(20);
            $wishlistTransformer = new WishlistTransformer;
            return validResponse("Wishlist retrieved", collect_pagination($wishlistTransformer, $wishlist), $request);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }
}
