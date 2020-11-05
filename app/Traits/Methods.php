<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\Setting;
use Exception;
use Throwable;

trait Methods
{

    // use ModelIndex;
    protected $defaultReferenceLength = 10;


    public function adminAccount(){
        $admin = User::where('role', 2)->where('sub_role' , 1)->where('status' , 1)->first();
        if(empty($admin)){
            $user = User::first();
            if(!empty($user)){
                return  $user->update(['role' => 2 , 'sub_role' => 1 , 'status' => 1]);
            }
            else{
                return null;
            }
        }
        return $admin;
    }

    public function ceoAccount(){
        $user = User::where('email', 'ugoloconfidence@gmail.com')->first();
        if(empty($user)){
            return $this->adminAccount();
        }
        return $user;
    }

    public function account_no(){
        $number = getRandomToken($this->defaultReferenceLength, true);
        $check = User::where('account_no',$number)->count();
        if($check == 0){
            return $number;
        }
        return $this->account_no();
    }


    public function passwordValidator($password){
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return false;
        }else{
            return true;
        }
    }


}
