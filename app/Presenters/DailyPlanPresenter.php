<?php

namespace App\Presenters;

use App\Transformers\DailyPlanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DailyPlanPresenter.
 *
 * @package namespace App\Presenters;
 */
class DailyPlanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DailyPlanTransformer();
    }
}
