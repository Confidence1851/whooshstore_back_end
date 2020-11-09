<?php
namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ApiConstants;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Traits\Notifications;
use App\Traits\Profile;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class VerificationController extends ApiController{
    use Notifications , Profile;

 /**
     * @OA\Post(
     ** path="/v1/auth/validate-token",
     *   tags={"Authentication"},
     *   summary="Verify oatuth token",
     *   operationId="validate_token",
     *
     *   @OA\Parameter(
     *      name="token",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
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
    public function validate_token(){
        $user = auth('api')->user();
        if(empty($user)){
            return problemResponse('Invalid token', ApiConstants::AUTH_ERR_CODE);
        }
        $returnData = $this->verifiedData($user);
        return validResponse('Token confirmed' , $returnData);
    }


    public function sendVerificationEmail($user = null){
        DB::beginTransaction();
        try{
            $this->sendVerifcationNotification($user);
            DB::commit();
            return validResponse('OTP re-sent successfully! Pin would expire in 60 minutes.');
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, null, $e);
        }
    }

    protected function confirmVerificationPin(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'pin' => ['required', 'string'],
            ]);

            if($validator->fails()){
                throw new ValidationException($validator);
            }

            $user = $this->User->user();
            $pin = $this->VerificationPin->model()->where('user_id' , $user->id)->orderby('created_at' , 'desc')->first();
            if(empty($pin)){
                return problemResponse('Could not verify pin!', ApiConstants::BAD_REQ_ERR_CODE, $request);
            }
            else{
                if(Carbon::parse($pin->created_at)->diffInMinutes(now() , false) > 60){
                    $pin->delete();
                    return problemResponse('Sorry, this pin has expired!', ApiConstants::BAD_REQ_ERR_CODE, $request);
                }
                else{
                    if(decrypt($pin->pin) != $request->pin){
                        return problemResponse('Incorrect pin entered!', ApiConstants::BAD_REQ_ERR_CODE, $request);
                    }
                }
            }

            $pin->delete();
            $this->verify_email();
           DB::commit();
            return validResponse('Confirmed!');
        } catch (ValidationException $e) {
            DB::rollback();
            $message = "" . (implode(' ', Arr::flatten($e->errors())));
            return inputErrorResponse($message, ApiConstants::VALIDATION_ERR_CODE, null, $e);
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong while processing your request.';
            return problemResponse($message, ApiConstants::SERVER_ERR_CODE, null, $e);
        }
    }


    /**
    * Mark the authenticated user’s email address as verified.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    protected function verify_email() {
        $user = $this->User->user();
        $date = date('Y-m-d g:i:s');
        $user->email_verified_at = $date; // to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
        $user->save();
    }

    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function resend_email(Request $request){
        if ($request->user()->hasVerifiedEmail()) {
            return problemResponse('User already verified email!', ApiConstants::BAD_REQ_ERR_CODE, $request);
        }

        $request->user()->sendEmailVerificationNotification();
        return validResponse('The notification has been resubmitted');
    }





}



