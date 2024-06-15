<?php

namespace App\Presenters;

use App\Transformers\InstitutionClassScheduleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstitutionClassSchedulePresenter.
 *
 * @package namespace App\Presenters;
 */
class InstitutionClassSchedulePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstitutionClassScheduleTransformer();
    }
}
