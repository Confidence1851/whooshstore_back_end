<?php

namespace App\Presenters;

use App\Transformers\UseruuTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UseruuPresenter.
 *
 * @package namespace App\Presenters;
 */
class UseruuPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UseruuTransformer();
    }
}
