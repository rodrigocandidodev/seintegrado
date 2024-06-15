<?php

namespace App\Presenters;

use App\Transformers\PlanAftuTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PlanAftuPresenter.
 *
 * @package namespace App\Presenters;
 */
class PlanAftuPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PlanAftuTransformer();
    }
}
