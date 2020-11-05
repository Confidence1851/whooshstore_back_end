<?php

namespace App\Traits;

use App\Mail\NewInvestment;
use App\Mail\NewNotification;
use App\Mail\NewStakeCard;
use App\Mail\NewTransaction;
use App\Mail\NewWithdrawal;
use App\Models\User;
use App\Notifications\Auth\SendVerificationPinNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

trait Notifications
{

    public function sendVerifcationNotification(User $user = null){
        if(is_null($user)){
            $user = auth()->user();
        }
        $pin = generate_verification_pin($user->id);
        if($pin != false){
            $mail = [
                'subject' => 'New Verification Pin',
                'pin' => $pin,
            ];
            $user->notify(new SendVerificationPinNotification($mail));
        }
        
    }


    public function notificationTemplate($id, $title, $type, $url = null , $image = null){
        return [
            'id' => $id,
            'title' => $title,
            'type' => $type,
            'url' => $url,
            'image' => $image,
        ];
    }

}
