<?php

namespace App\Presenters;

use App\Transformers\PlanBnccEfTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PlanBnccEfPresenter.
 *
 * @package namespace App\Presenters;
 */
class PlanBnccEfPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PlanBnccEfTransformer();
    }
}
