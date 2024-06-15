<?php

namespace App\Presenters;

use App\Transformers\InstitutionClassTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstitutionClassPresenter.
 *
 * @package namespace App\Presenters;
 */
class InstitutionClassPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClassTransformer();
    }
}
