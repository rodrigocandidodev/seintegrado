<?php

namespace App\Presenters;

use App\Transformers\InstitutionSchoolYearDivisionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstitutionSchoolYearDivisionPresenter.
 *
 * @package namespace App\Presenters;
 */
class InstitutionSchoolYearDivisionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstitutionSchoolYearDivisionTransformer();
    }
}
