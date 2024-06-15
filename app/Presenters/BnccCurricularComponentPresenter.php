<?php

namespace App\Presenters;

use App\Transformers\BnccCurricularComponentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BnccCurricularComponentPresenter.
 *
 * @package namespace App\Presenters;
 */
class BnccCurricularComponentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BnccCurricularComponentTransformer();
    }
}
