<?php

namespace App\Presenters;

use App\Transformers\RecentlyViewedProductTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RecentlyViewedProductPresenter.
 *
 * @package namespace App\Presenters;
 */
class RecentlyViewedProductPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RecentlyViewedProductTransformer();
    }
}
