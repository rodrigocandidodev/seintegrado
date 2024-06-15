<?php

namespace App\Presenters;

use App\Transformers\AdminTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdminTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class AdminTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminTypeTransformer();
    }
}
