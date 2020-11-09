<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Repository constructor
     *
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Get's logged in user
     *
     * @return User
     */
    public function user()
    {
        return Auth::User();
    }


    public function generate_account_no(){
        $number = rand(1000000000,9999999999);
        $check = $this->model->where('account_no',$number)->count();
        if($check == 0){
            return $number;
        }
        return $this->generate_account_no();
    }

    public function verification_pin($id = null){
        if(is_null($id)){
            $user = $this->User->user();
        }
        else{
            $user = $this->User->find($id);
        }
        if(!empty($user)){
            $pin = rand(111111 , 999999);
            $this->VerificationPin->create([
                'user_id' => $user->id,
                'pin' => encrypt($pin),
            ]);
            return $pin;
        }
        else{
            return false;
        }
    }



}
