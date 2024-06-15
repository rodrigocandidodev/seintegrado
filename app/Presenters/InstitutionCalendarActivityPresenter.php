<?php

namespace App\Presenters;

use App\Transformers\InstitutionCalendarActivityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstitutionCalendarActivityPresenter.
 *
 * @package namespace App\Presenters;
 */
class InstitutionCalendarActivityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstitutionCalendarActivityTransformer();
    }
}
