<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiConstants;
use App\Http\Controllers\Controller;
use App\Repositories\RecentlyViewedProductRepository;
use App\Transformers\RecentlyViewedProductTransformer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $recentlyViewedRepo;
    public function __construct(RecentlyViewedProductRepository $recentlyViewedProductRepo)
    {
        $this->recentlyViewedRepo = $recentlyViewedProductRepo;
    }


    
    /**
     * @OA\Get(
     ** path="/v1/home/recently-viewed-products",
     *   tags={"Home"},
     *   summary="List recently viewed products",
     *   operationId="recently-viewed-products",
     * 
     *  @OA\Parameter(
     *      name="session_key",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="token",
     *      in="query",
     *      required=false,
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
    public function recentlyViewed(Request $request)
    {
        try {
            $data = $this->recentlyViewedRepo->orderby("id", "desc")->paginate(ApiConstants::PAGINATION_SIZE_API);
            return validResponse("Recently viewed products retrieved" ,collect_pagination(new RecentlyViewedProductTransformer, $data));
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }



    /**
     * @OA\Get(
     ** path="/v1/home/product-categories",
     *   tags={"Home"},
     *   summary="List product categories",
     *   operationId="product-categories",
     * akip
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
    public function productCategories(Request $request)
    {
        try {
            $data = $this->recentlyViewedRepo->orderby("id", "desc")->paginate(ApiConstants::PAGINATION_SIZE_API);
            return validResponse("Product categories retrieved" ,collect_pagination(new RecentlyViewedProductTransformer, $data));
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }

    
    /**
     * @OA\Get(
     ** path="/v1/home/slider-and-images",
     *   tags={"Home"},
     *   summary="Show sliders and images",
     *   operationId="slider-and-images",
     * akip
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
    public function sliderAndImages(Request $request)
    {
    }

    /**
     * @OA\Get(
     ** path="/v1/home/trending",
     *   tags={"Home"},
     *   summary="Show trending products and categories",
     *   operationId="trending",
     * akip
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
    public function trending(Request $request)
    {
    }


     /**
     * @OA\Get(
     ** path="/v1/home/trending",
     *   tags={"Home"},
     *   summary="Show trending products and categories",
     *   operationId="trending",
     * akip
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
    public function dealOfDay(Request $request)
    {
    }
}
