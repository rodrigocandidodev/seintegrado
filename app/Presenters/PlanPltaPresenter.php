<?php

namespace App\Presenters;

use App\Transformers\PlanPltaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PlanPltaPresenter.
 *
 * @package namespace App\Presenters;
 */
class PlanPltaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PlanPltaTransformer();
    }
}
