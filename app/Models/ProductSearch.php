<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ProductSearch.
 *
 * @package namespace App\Models;
 */
class ProductSearch extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
