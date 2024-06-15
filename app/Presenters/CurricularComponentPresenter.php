<?php

namespace App\Presenters;

use App\Transformers\CurricularComponentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CurricularComponentPresenter.
 *
 * @package namespace App\Presenters;
 */
class CurricularComponentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CurricularComponentTransformer();
    }
}
