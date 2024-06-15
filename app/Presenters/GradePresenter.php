<?php

namespace App\Presenters;

use App\Transformers\GradeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GradePresenter.
 *
 * @package namespace App\Presenters;
 */
class GradePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GradeTransformer();
    }
}
