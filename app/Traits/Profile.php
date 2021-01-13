<?php

namespace App\Traits;

use App\Transformers\UserTransformer;

trait Profile
{

    /** Steps include referral_code , upload_document , complete_profile , transaction_settings  */
    public function account_status_check($user = null){
        if(empty($user)){
            $user = auth()->user();
        }

        $steps = [];

        if(empty($user->email_verified_at)){
            array_push($steps ,[
                'title' => 'Verify Email Address',
                'message' => 'Log into your email and find the OTP sent to your inbox or spam folder to verify your email address.',
                'type' => 'email_verification',
            ]);
        }

        if(empty($user->referral)){
            array_push($steps ,[
                'title' => 'Reward your referrer',
                'message' => 'Enter your referral code so they can feel the joy of sharing. Skip this if you dont have one.',
                'type' => 'referral_code',
            ]);
        }

        if(empty($user->gender) || empty($user->country) || empty($user->state)){
            array_push($steps ,[
                'title' => 'Complete your profile',
                'message' => 'Some important details are missing from your profile. Kindly complete your profile.',
                'type' => 'complete_profile',
            ]);
        }

        $status = true;
        $user->status = 1;
        if(count($steps) > 0){
            $status = false;
            $user->status = 0;
        }
        $user->save();

        return [
            'pass' =>  $status,
            'header' => 'Finishing touches..',
            'title' => 'Your account is almost ready!',
            'steps' => $steps,
        ];
    }


    public function verifiedData($user , $token = null){
        $userTrans = new UserTransformer();
        if(!empty($token)){
            $returnData['token'] = $token ;
        }
        $returnData['user'] = $userTrans->transform($user);
        $returnData['status_check'] = $this->account_status_check($user);
        $returnData['app_info'] = [
            'build_no' => 1,
            'version_no' => 1,
            'playStore_url' => 'https://play.google.com/store/apps/details?id=com.stakeguard.stake_guard',
            'appleStore_url' => '',
        ];
        return $returnData;
    }

}
