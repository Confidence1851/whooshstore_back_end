<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ApiConstants;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\Notifications;
use App\Traits\Profile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends ApiController
{
    use Notifications, Profile;


    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @OA\Post(
     ** path="/v1/register",
     *   tags={"Authentication"},
     *   summary="Register",
     *   operationId="register",
     *
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
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
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|max:50',
                'email' => 'bail|required|string|email|max:50|unique:users',
                'password' => 'bail|required|string|min:6',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = $this->userRepo->create([
                'name' => ucwords($request['name']),
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $this->sendVerifcationNotification($user);

            $token = $user->createToken('PersonalAccessToken')->accessToken;
            $returnData = $this->verifiedData($user, $token);

            DB::commit();
            return validResponse('Register successful', $returnData, $request);
        } catch (ValidationException $e) {
            DB::rollback();
            $message = "" . (implode(' ', Arr::flatten($e->errors())));
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, $request, $e);
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, $request, $e);
        }
    }
}
