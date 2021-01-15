<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiConstants;
use App\Helpers\QueryExtractor;
use App\Http\Controllers\Controller;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductSearchRepository;
use App\Repositories\RecentlyViewedProductRepository;
use App\Transformers\ProductCategoryTransformer;
use App\Transformers\ProductSearchTransformer;
use App\Transformers\ProductTransformer;
use App\Transformers\RecentlyViewedProductTransformer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $recentlyViewedRepo;
    private $productCategoryRepo;
    private $productSearchRepo;
    public function __construct(
        RecentlyViewedProductRepository $recentlyViewedProductRepo,
        ProductCategoryRepository $productCategoryRepository,
        ProductSearchRepository $productSearchRepository
    ) {
        $this->recentlyViewedRepo = $recentlyViewedProductRepo;
        $this->productCategoryRepo = $productCategoryRepository;
        $this->productSearchRepo = $productSearchRepository;
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
            $data = $this->recentlyViewedRepo->whereHas("product", null)->orderby("updated_at", "desc")->paginate(ApiConstants::PAGINATION_SIZE_API);
            return validResponse("Recently viewed products retrieved", collect_pagination(new RecentlyViewedProductTransformer, $data));
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
     *
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
            $data = $this->productCategoryRepo->whereHas("products", null)->orderby("id", "desc")->paginate(ApiConstants::PAGINATION_SIZE_API);
            return validResponse("Product categories retrieved", collect_pagination(new ProductCategoryTransformer(true), $data));
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
     * 
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
        try {
            $builder = QueryExtractor::productQuery($request);
            $products = $builder->inRandomOrder()->limit(10)->get();
            $transformer = new ProductTransformer(false,false);
            return validResponse("Product slider retrieved", $transformer->collect($products));
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }

    /**
     * @OA\Get(
     ** path="/v1/home/trending-searches",
     *   tags={"Home"},
     *   summary="Show trending searches for products and categories",
     *   operationId="trending",
     * 
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
    public function trendingSearches(Request $request)
    {
        try {
            $data = $this->productSearchRepo->where("results_count", ">", 0)
                ->orderby("id", "desc")->paginate(ApiConstants::PAGINATION_SIZE_API);
            $transformer = new ProductSearchTransformer;
            return validResponse("Product categories retrieved", $transformer->prepare($data));
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }
}
