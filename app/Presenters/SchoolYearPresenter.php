<?php

namespace App\Presenters;

use App\Transformers\SchoolYearTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SchoolYearPresenter.
 *
 * @package namespace App\Presenters;
 */
class SchoolYearPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SchoolYearTransformer();
    }
}
