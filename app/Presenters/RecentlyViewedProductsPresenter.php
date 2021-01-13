<?php

namespace App\Presenters;

use App\Transformers\RecentlyViewedProductsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RecentlyViewedProductsPresenter.
 *
 * @package namespace App\Presenters;
 */
class RecentlyViewedProductsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RecentlyViewedProductsTransformer();
    }
}
