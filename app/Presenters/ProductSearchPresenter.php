<?php

namespace App\Presenters;

use App\Transformers\ProductSearchTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProductSearchPresenter.
 *
 * @package namespace App\Presenters;
 */
class ProductSearchPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductSearchTransformer();
    }
}
