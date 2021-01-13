<?php

namespace App\Presenters;

use App\Transformers\BillingAddressTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BillingAddressPresenter.
 *
 * @package namespace App\Presenters;
 */
class BillingAddressPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BillingAddressTransformer();
    }
}
