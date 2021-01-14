<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ApiConstants;
use App\Http\Controllers\Api\V1\ApiController;
use App\Repositories\UserRepository;
use App\Traits\Profile;
use App\Transformers\UserTransformer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends ApiController
{
    use Profile;

    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @OA\Post(
     ** path="/v1/login",
     *   tags={"Authentication"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
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
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'email' => 'bail|required|email|max:255',
                'password' => 'bail|required|string|max:255'
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $credentials = ['email' => $request->email, 'password' => $request->password];

            if (Auth::attempt($credentials)) {
                $user = $this->userRepo->user();

                // Delete exiting tokens
                $userTokens = $user->tokens;
                foreach ($userTokens as $token) {
                    // $token->revoke();
                    $token->delete();
                }
                // Create new token
                $token = $user->createToken('PersonalAccessToken')->accessToken;
                $returnData = $this->verifiedData($user, $token);
                return validResponse('Login successful', $returnData, $request);
            } else {
                return problemResponse('Incorrect details, try again!', ApiConstants::AUTH_ERR_CODE, $request);
            }
        } catch (ValidationException $e) {
            $message = "Input validation errors";
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }
}
