<?php

namespace App\Repositories\Eloquent;
use App\Models\Coupon;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\CouponRepositoryInterface;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }

    protected function getCode(){
        $number = rand(100000000000000,999999999999999);
        $check = $this->model->where('card_no',$number)->count();
        if($check == 0){
            return $number;
        }
        return $this->getCode();
    }
}
