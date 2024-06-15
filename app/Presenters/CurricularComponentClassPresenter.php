<?php

namespace App\Presenters;

use App\Transformers\CurricularComponentClassTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CurricularComponentClassPresenter.
 *
 * @package namespace App\Presenters;
 */
class CurricularComponentClassPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CurricularComponentClassTransformer();
    }
}
